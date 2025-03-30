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
