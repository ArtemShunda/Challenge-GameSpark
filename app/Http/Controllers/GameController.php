<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function edit(Game $game): View
    {
        return view('games.create', compact('game'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(imageRequired: true));

        $validated['image_path'] = $request->file('image')->store('game-covers', 'public');
        unset($validated['image']);

        Game::create($validated);

        return redirect()->route('games.index')->with('success', 'Game toegevoegd aan je collectie.');
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $validated = $request->validate($this->rules(imageRequired: false));
        $oldImagePath = $game->image_path;

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('game-covers', 'public');
        }

        unset($validated['image']);
        $game->update($validated);

        if (isset($validated['image_path'])) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()->route('games.index')->with('success', 'Game bijgewerkt.');
    }

    private function rules(bool $imageRequired): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:2048'],
            'platform' => ['required', 'in:PlayStation,PC,Xbox,Nintendo Switch'],
            'genre' => ['required', 'in:Actie,Avontuur,RPG,Indie,Strategie,Sport'],
            'release_year' => ['required', 'integer', 'between:1970,2035'],
            'status' => ['required', 'in:In bezit,Speelt nu,Uitgespeeld'],
            'rating' => ['required', 'numeric', 'between:1,10'],
        ];
    }
}
