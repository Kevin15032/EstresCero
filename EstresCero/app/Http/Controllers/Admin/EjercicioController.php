<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ejercicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EjercicioController extends Controller
{
    public function index(Request $request)
    {
        $query = Ejercicio::query();

        if ($request->has('categoria') && $request->categoria !== null) {
            $query->where('categoria', $request->categoria);
        }

        $ejercicios = $query->latest()->get();

        return view('adminejercicios', compact('ejercicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required',
            'descripcion' => 'required',
            'duracion'    => 'required|integer',
            'categoria'   => 'required',
            'icono'       => 'required',
            'video_url'   => 'nullable|url',
            'imagen'      => 'nullable|image|max:2048'
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('ejercicios', 'public');
        }

        Ejercicio::create([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'duracion'    => $request->duracion,
            'categoria'   => $request->categoria,
            'icono'       => $request->icono,
            'video_url'   => $request->video_url,
            'destacado'   => $request->has('destacado'),
            'imagen'      => $rutaImagen,
        ]);

        return redirect()->route('admin.ejercicios.index')->with('success', 'Ejercicio creado correctamente');
    }

    public function update(Request $request, Ejercicio $ejercicio)
    {
        $request->validate([
            'titulo'      => 'required',
            'descripcion' => 'required',
            'duracion'    => 'required|integer',
            'categoria'   => 'required',
            'icono'       => 'required',
            'video_url'   => 'nullable|url',
            'imagen'      => 'nullable|image|max:2048'
        ]);

        // Si hay una nueva imagen, la almacenamos
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($ejercicio->imagen && Storage::disk('public')->exists($ejercicio->imagen)) {
                Storage::disk('public')->delete($ejercicio->imagen);
            }
            $ejercicio->imagen = $request->file('imagen')->store('ejercicios', 'public');
        }

        $ejercicio->update([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'duracion'    => $request->duracion,
            'categoria'   => $request->categoria,
            'icono'       => $request->icono,
            'video_url'   => $request->video_url,
            'destacado'   => $request->has('destacado'),
            'imagen'      => $ejercicio->imagen, // aseguramos que se mantenga
        ]);

        return redirect()->route('admin.ejercicios.index')->with('success', 'Ejercicio actualizado correctamente');
    }

    public function destroy(Ejercicio $ejercicio)
    {
        if ($ejercicio->imagen && Storage::disk('public')->exists($ejercicio->imagen)) {
            Storage::disk('public')->delete($ejercicio->imagen);
        }

        $ejercicio->delete();
        return redirect()->route('admin.ejercicios.index')->with('success', 'Ejercicio eliminado correctamente');
    }
}
