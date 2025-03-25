<?php

namespace App\Http\Controllers;

use App\Models\EmotionalEntry;
use Illuminate\Http\Request;

class EmotionalEntryController extends Controller
{
    public function index()
    {
        $entries = auth()->user()->emotionalEntries()
                          ->orderBy('date', 'desc')
                          ->get();
        return view('seguimiento', compact('entries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'stress_level' => 'required|in:Bajo,Medio,Alto',
            'emotion' => 'required|string|max:255',
            'comment' => 'required|string'
        ]);

        auth()->user()->emotionalEntries()->create($request->all());

        return redirect()->route('seguimiento')
            ->with('success', '¡Entrada agregada correctamente!');
    }
}
