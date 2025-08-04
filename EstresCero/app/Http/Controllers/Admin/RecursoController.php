<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::latest()->get();
        return view('adminrecursos', compact('recursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('recursos', 'public');
        }

        Recurso::create($data);

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso creado correctamente');
    }

    public function show($id)
    {
        $recurso = Recurso::findOrFail($id);
        return response()->json($recurso);
    }

    public function update(Request $request, $id)
{
    $recurso = Recurso::findOrFail($id);

    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'contenido' => 'required|string',
        'categoria' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $recurso->titulo = $request->titulo;
    $recurso->descripcion = $request->descripcion;
    $recurso->contenido = $request->contenido;
    $recurso->categoria = $request->categoria; 

    if ($request->hasFile('imagen')) {
        if ($recurso->imagen) {
            Storage::disk('public')->delete($recurso->imagen);
        }
        $recurso->imagen = $request->file('imagen')->store('recursos', 'public');
    }

    $recurso->save();

    return redirect()->route('admin.recursos.index')->with('success', 'Recurso actualizado correctamente.');
}


    public function destroy(Recurso $recurso)
    {
        if ($recurso->imagen) {
            Storage::disk('public')->delete($recurso->imagen);
        }

        $recurso->delete();

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso eliminado correctamente');
    }
}
