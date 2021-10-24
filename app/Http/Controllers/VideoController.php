<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return Video::paginate(25);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'year_launched' => 'required|date_format:Y',
            'opened' => 'boolean',
            'rating' => 'required|in:' . implode(',', Video::RATING_LIST),
            'duration' => 'required|integer',
        ]);

        return Video::create($request->all());
    }

    public function show(Video $video)
    {
        return $video;
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'string|max:255',
            'year_launched' => 'date_format:Y',
            'opened' => 'boolean',
            'rating' => 'in:' . implode(',', Video::RATING_LIST),
            'duration' => 'integer',
        ]);

        return $video->update($request->all());
    }

    public function destroy(Video $video)
    {
        return $video->delete();
    }
}
