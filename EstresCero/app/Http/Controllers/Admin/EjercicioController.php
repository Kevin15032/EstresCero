<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::latest()->get();
        return view('adminejercicios', compact('ejercicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria' => 'required|string',
            'duracion' => 'required|integer|min:1',
            'icono' => 'required|string',
            'video_url' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destacado' => 'boolean'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('ejercicios', 'public');
        }

        Ejercicio::create($data);

        return redirect()->route('admin.ejercicios.index')
            ->with('success', 'Ejercicio creado correctamente');
    }

    public function destroy(Ejercicio $ejercicio)
    {
        $ejercicio->delete();
        return redirect()->route('admin.ejercicios.index')
            ->with('success', 'Ejercicio eliminado correctamente');
    }
}
