<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();

        return response()->json([
            'data' => $films
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filmArray = $request->all();
        $film = Film::create($filmArray);
        return response()->json([
            'data' => $film
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        return response()->json([
            'data' => $film
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $film->update($request->all());

        return response()->json([
            'data' => $film
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();

        return response()->json(null, 204);
    }
}
