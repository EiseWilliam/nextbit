<?php

namespace App\Http\Controllers;

use App\Jobs\TranscodeVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return Inertia::render('Videos/Index', ['videos' => $videos]);
    }

    public function create()
    {
        return Inertia::render('Videos/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,mov,avi|max:102400', // 100MB limit
        ]);

        $path = $request->file('video')->store('videos', 'public');

        $video = Video::create([
            'title' => $request->input('title'),
            'path' => $path,
            'user_id' => 1,
            'status' => 'pending',
        ]);

        // Dispatch a job for transcoding
        dispatch(new TranscodeVideo($video));

        return redirect()->route('videos.index');
    }

    public function show(Video $video)
    {
        return Inertia::render('Videos/Show', ['video' => $video]);
    }
}
