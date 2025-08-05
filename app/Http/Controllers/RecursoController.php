<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::latest()->get();
        return view('recursos', compact('recursos'));
    }

    public function show(Recurso $recurso)
    {
        return response()->json($recurso);
    }
}
