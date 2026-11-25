<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        $games = Game::query()->latest()->get();

        return view('welcome', compact('games'));
    }

    public function create(): View
    {
        return view('games.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'image' => ['required', 'image', 'max:2048'],
            'platform' => ['required', 'in:PlayStation,PC,Xbox,Nintendo Switch'],
            'genre' => ['required', 'in:Actie,Avontuur,RPG,Indie,Strategie,Sport'],
            'release_year' => ['required', 'integer', 'between:1970,2035'],
            'status' => ['required', 'in:In bezit,Speelt nu,Uitgespeeld'],
            'rating' => ['required', 'numeric', 'between:1,10'],
        ]);

        $validated['image_path'] = $request->file('image')->store('game-covers', 'public');
        unset($validated['image']);

        Game::create($validated);

        return redirect()->route('games.index')->with('success', 'Game toegevoegd aan je collectie.');
    }
}
