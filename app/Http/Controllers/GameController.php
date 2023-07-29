<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::orderBy('title')->get();

        return inertia('Games/Index', [
            'games' => $games
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Games/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'         => 'string|required',
            'date_release'  => 'date|required',
            'developer'     => 'string|required',
            'synopsis'      => 'string|required'
        ]);

        $fileName = null;

        if ($request->img) {
            $fileName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('uploads/img'), $fileName);
            $fields['img'] = $fileName;
        }

        Game::create($fields);

        return redirect()->route('games')->banner('Game added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return inertia('Games/Show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return inertia('Games/Edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title'         => 'string|required',
            'date_release'  => 'date|required',
            'developer'     => 'string|required',
            'synopsis'      => 'string|required'
        ]);

        $game->update($request->all());

        $request->session()->flash('flash.banner', 'Game details updated.');
        $request->session()->flash('flash.bannerStyle', 'success');

        return redirect('/games/' . $game->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games')->dangerBanner('Game removed.');
    }

    public function search($searchKey)
    {
        return inertia('Games/Index', [
            'games' => Game::where('title', 'like', "%$searchKey%")->
            orWhere('developer', 'like', "%$searchKey%")
            ->get()
        ]);
    }

    public function toggleActive(Game $game)
    {
        $game->available = !$game->available;
        $game->save();

        return back();
    }
}
