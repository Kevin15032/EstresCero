<?php

namespace App\Http\Controllers;

use App\Models\Ejercicio;
use Illuminate\Http\Request;

class EjercicioController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::latest()->get();
        return view('ejercicios', compact('ejercicios'));
    }

    public function show(Ejercicio $ejercicio)
    {
        try {
            // Antes de devolver la respuesta JSON, convertimos la URL de YouTube
            $video_url = $ejercicio->video_url;
            if (strpos($video_url, 'watch?v=') !== false) {
                $video_id = explode('v=', $video_url)[1];
                $video_url = "https://www.youtube.com/embed/" . $video_id;
            }

            return response()->json([
                'id' => $ejercicio->id,
                'titulo' => $ejercicio->titulo,
                'descripcion' => $ejercicio->descripcion,
                'categoria' => $ejercicio->categoria,
                'duracion' => $ejercicio->duracion,
                'video_url' => $video_url,
                'imagen' => $ejercicio->imagen ? asset('storage/' . $ejercicio->imagen) : null
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in EjercicioController@show: ' . $e->getMessage());
            return response()->json(['error' => 'Error al cargar el ejercicio'], 500);
        }
    }
}
