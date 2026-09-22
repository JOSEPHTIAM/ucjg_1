<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegister()
    {
        return view('authentification.register');
    }

    // Inscription avec validation
    public function register(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|in:Utilisateur,Administrateur',
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'membre' => 'required|in:Ancien,Nouveau,Partenaire',
            'voix' => 'required|in:Sopra,Alto,Ténor,Baryton,Bass',
            'genre' => 'required|in:Homme,Femme,Non-genré',
            'indicatif_pays' => 'required|string',
            'contact' => 'required|string',
            'profession' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:4',
            'premiere_annee_ucjg' => 'required|integer|digits:4',
            'anecdote' => 'nullable|string',
            'releve_assuree' => 'required|in:Oui,Non',
            'souhait_30_ans' => 'required|string',
        ]);

        // Gestion de la photo
        $photoPath = $request->file('photo')->store('photos_users', 'public');

        // Génération du code OTP de 4 chiffres valide 24 heures
        $otpCode = sprintf("%04d", mt_rand(0, 9999));

        $user = User::create([
            'photo' => $photoPath,
            'role' => $request->role ?? 'Utilisateur',
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'membre' => $request->membre,
            'voix' => $request->voix,
            'genre' => $request->genre,
            'indicatif_pays' => $request->indicatif_pays,
            'contact' => $request->contact,
            'profession' => $request->profession,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'premiere_annee_ucjg' => $request->premiere_annee_ucjg,
            'anecdote' => $request->anecdote ?? 'Aucune',
            'releve_assuree' => $request->releve_assuree,
            'souhait_30_ans' => $request->souhait_30_ans,
            'otp_code' => $otpCode,
            'otp_expires_at' => Carbon::now()->addHours(24),
        ]);

        return redirect()->route('login')->with('success', 'Compte créé avec succès. Veuillez vous connecter.');
    }

    // Traitement de la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    // Création d'un membre par un administrateur
    public function storeByAdmin(Request $request)
    {
        abort_unless(Auth::check() && Auth::user()->role === 'Administrateur', 403);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role' => 'required|in:Utilisateur,Administrateur',
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'membre' => 'required|in:Ancien,Nouveau,Partenaire',
            'voix' => 'required|in:Sopra,Alto,Ténor,Baryton,Bass',
            'genre' => 'required|in:Homme,Femme,Non-genré',
            'indicatif_pays' => 'required|string',
            'contact' => 'required|string',
            'profession' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:4',
            'premiere_annee_ucjg' => 'required|integer|digits:4',
            'anecdote' => 'nullable|string',
            'releve_assuree' => 'required|in:Oui,Non',
            'souhait_30_ans' => 'required|string',
        ]);

        $photoPath = $request->file('photo')->store('photos_users', 'public');

        User::create([
            'photo' => $photoPath,
            'role' => $request->role,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'membre' => $request->membre,
            'voix' => $request->voix,
            'genre' => $request->genre,
            'indicatif_pays' => $request->indicatif_pays,
            'contact' => $request->contact,
            'profession' => $request->profession,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'premiere_annee_ucjg' => $request->premiere_annee_ucjg,
            'anecdote' => $request->anecdote ?? 'Aucune',
            'releve_assuree' => $request->releve_assuree,
            'souhait_30_ans' => $request->souhait_30_ans,
        ]);

        return redirect()->route('membre_ucjg')->with('success', 'Le membre a bien été créé.');
    }

    // Mise à jour du profil de l'utilisateur connecté
    public function updateProfile(Request $request, User $user)
    {
        abort_unless(Auth::check() && (Auth::id() === $user->id || Auth::user()->role === 'Administrateur'), 403);

        $rules = [
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['nullable', 'string', 'max:255'],
            'membre' => ['required', 'in:Ancien,Nouveau,Partenaire'],
            'voix' => ['required', 'in:Sopra,Alto,Ténor,Baryton,Bass'],
            'genre' => ['required', 'in:Homme,Femme,Non-genré'],
            'indicatif_pays' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore($user->id)],
            'premiere_annee_ucjg' => ['required', 'integer', 'digits:4'],
            'anecdote' => ['nullable', 'string'],
            'releve_assuree' => ['required', 'in:Oui,Non'],
            'souhait_30_ans' => ['required', 'string'],
        ];

        if (Auth::user()->role === 'Administrateur') {
            $rules['role'] = ['required', 'in:Utilisateur,Administrateur'];
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos_users', 'public');
        }

        if (Auth::user()->role === 'Administrateur' && $request->filled('role')) {
            $validated['role'] = $request->role;
        }

        $user->fill($validated);
        $user->save();

        return redirect()->route('membre_ucjg')->with('success', 'Votre profil a bien été mis à jour.');
    }

    public function destroy(User $user)
    {
        $authUser = Auth::user();

        abort_unless($authUser && $authUser->role === 'Administrateur' && $authUser->id !== $user->id, 403);

        $user->delete();

        return redirect()->route('membre_ucjg')->with('success', 'Le profil a bien été supprimé.');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}