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
            'categories_id' => 'required|array|exists:categories,id',
            'genres_id' => 'required|array|exists:genres,id',
        ]);

        $data = Video::create($request->all());
        $data->categories()->sync($request->get('categories_id'));
        $data->genres()->sync($request->get('genres_id'));
        $data->refresh();
        return $data;
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
            'categories_id' => 'required|array|exists:categories,id',
            'genres_id' => 'required|array|exists:genres,id',
        ]);


        $video->update($request->all());
        $video->categories()->sync($request->get('categories_id'));
        $video->genres()->sync($request->get('genres_id'));
        $video->refresh();
        return $video;
    }

    public function destroy(Video $video)
    {
        return $video->delete();
    }
}
