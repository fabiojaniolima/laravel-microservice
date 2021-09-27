<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return Genre::paginate(25);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        return Genre::create($request->all());
    }

    public function show(Genre $genre)
    {
        return $genre;
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'string|max:255',
            'is_active' => 'boolean',
        ]);

        return $genre->update($request->all());
    }

    public function destroy(Genre $genre)
    {
        return $genre->delete();
    }
}
