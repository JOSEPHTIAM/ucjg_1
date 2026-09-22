<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('user')->orderBy('created_at', 'desc')->get();

        return view('video_ucjg', [
            'videos' => $videos,
        ]);
    }

    public function store(Request $request)
    {
        abort_unless(Auth::check(), 403);

        $validated = $request->validate([
            'identite' => ['required', 'string', 'max:255'],
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/quicktime,video/webm,video/x-msvideo', 'max:51200'],
        ]);

        $path = $request->file('video')->store('videos_ucjg', 'public');

        Video::create([
            'video' => $path,
            'identite' => $validated['identite'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('video_ucjg')->with('success', 'Votre vidéo a bien été enregistrée.');
    }

    public function update(Request $request, Video $video)
    {
        abort_unless(Auth::check() && (Auth::id() === $video->user_id || Auth::user()->role === 'Administrateur'), 403);

        $validated = $request->validate([
            'identite' => ['required', 'string', 'max:255'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/webm,video/x-msvideo', 'max:51200'],
        ]);

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('videos_ucjg', 'public');
        }

        $video->update($validated);

        return redirect()->route('video_ucjg')->with('success', 'Votre vidéo a bien été mise à jour.');
    }

    public function destroy(Video $video)
    {
        $authUser = Auth::user();

        abort_unless($authUser && ($authUser->role === 'Administrateur' || $authUser->id === $video->user_id), 403);

        $video->delete();

        return redirect()->route('video_ucjg')->with('success', 'La vidéo a bien été supprimée.');
    }
}
