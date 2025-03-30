<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\Ejercicio;
use App\Models\EmotionalEntry;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener recursos recientes
        $recursosRecientes = Recurso::latest()
            ->take(2)
            ->get();

        // Obtener ejercicios destacados
        $ejerciciosDestacados = Ejercicio::where('destacado', true)
            ->take(2)
            ->get();

        // Obtener el último registro emocional
        $ultimoRegistro = auth()->user()->emotionalEntries()
            ->latest()
            ->first();

        // Obtener nivel de estrés promedio semanal
        $nivelEstres = auth()->user()->emotionalEntries()
            ->where('date', '>=', now()->subDays(7))
            ->get()
            ->avg(function($entry) {
                return [
                    'Bajo' => 33,
                    'Medio' => 66,
                    'Alto' => 100
                ][$entry->stress_level] ?? 0;
            }) ?? 0;

        // Obtener posts recientes del foro
        $postsRecientes = Post::with('user', 'comments')
            ->latest()
            ->take(2)
            ->get();

        return view('dashboard', compact(
            'recursosRecientes',
            'ejerciciosDestacados',
            'ultimoRegistro',
            'nivelEstres',
            'postsRecientes'
        ));
    }
}
