<?php

namespace App\Http\Controllers;

use App\Models\CastMember;
use Illuminate\Http\Request;

class CastMemberController extends Controller
{
    public function index()
    {
        return CastMember::paginate(25);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer|in:' . implode(',', [CastMember::TYPE_ACTOR, CastMember::TYPE_DIRECTOR]),
        ]);

        return CastMember::create($request->all());
    }

    public function show(CastMember $castMember)
    {
        return $castMember;
    }

    public function update(Request $request, CastMember $castMember)
    {
        $request->validate([
            'name' => 'string|max:255',
            'type' => 'integer|in:' . implode(',', [CastMember::TYPE_ACTOR, CastMember::TYPE_DIRECTOR]),
        ]);

        return $castMember->update($request->all());
    }

    public function destroy(CastMember $castMember)
    {
        return $castMember->delete();
    }
}
