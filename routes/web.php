<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

////////////////////////////////////// Routes Publiques /////////////////////////////

// Route pour la page d'accueil
Route::get('/', function () { return view('welcome'); })->name('home');
// Route pour la page À Propos
Route::get('/a-propos', function () { return view('about'); })->name('about');
// Retraite Spirituelle 2026
Route::get('/retraite-spirituelle', function () { return view('retraite'); })->name('retraite');
// Membres UCJG
Route::get('/membres-ucjg', function () {
    return view('membre_ucjg', [
        'users' => User::orderBy('created_at', 'desc')->get(),
    ]);
})->name('membre_ucjg');

// Vidéos UCJG
Route::get('/videos-ucjg', [VideoController::class, 'index'])->name('video_ucjg');

// Authentification
//Route::get('/connexion', function () { return view('authentification.connexion'); })->name('login');

// Routes d'authentification (Protégées contre les utilisateurs déjà connectés)
Route::middleware('guest')->group(function () {
    Route::get('/connexion', function () { return view('authentification.connexion'); })->name('login');
    Route::post('/connexion', [UserController::class, 'login'])->name('login.post');
    
    // Le lien "Nouveau mot de passe" redirige vers la création de compte (Register)
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/membres-ucjg/creer', [UserController::class, 'storeByAdmin'])->name('member.store');
    Route::post('/membres-ucjg/{user}/modifier', [UserController::class, 'updateProfile'])->name('member.update');
    Route::delete('/membres-ucjg/{user}', [UserController::class, 'destroy'])->name('member.destroy');
    Route::post('/videos-ucjg/creer', [VideoController::class, 'store'])->name('video.store');
    Route::post('/videos-ucjg/{video}/modifier', [VideoController::class, 'update'])->name('video.update');
    Route::delete('/videos-ucjg/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
    Route::post('/deconnexion', [UserController::class, 'logout'])->name('logout');
});

