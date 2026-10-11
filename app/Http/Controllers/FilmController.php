<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;

class FilmController extends Controller
{
    public function index(Request $request): View
{
    $search = $request->query('search');

    $films = Film::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('director', 'like', "%{$search}%")
                    ->orWhere('genre', 'like', "%{$search}%");
            });
        })
        ->orderBy('title')
        ->paginate(10)
        ->withQueryString();

    return view('films.index', compact('films', 'search'));
}

    public function create(): View
    {
        return view('films.create');
    }

    public function store(StoreFilmRequest $request): RedirectResponse
{
    Film::create($request->validated());

    return redirect()
        ->route('films.index')
        ->with('success', 'Film berhasil ditambahkan.');
}

    public function show(Film $film): View
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film): View
    {
        return view('films.edit', compact('film'));
    }

    public function update(
    UpdateFilmRequest $request,
    Film $film
): RedirectResponse {
    $film->update($request->validated());

    return redirect()
        ->route('films.index')
        ->with('success', 'Film berhasil diperbarui.');
}

    public function destroy(Film $film): RedirectResponse
    {
        $film->delete();

        return redirect()
            ->route('films.index')
            ->with('success', 'Film berhasil dihapus.');
    }
}