<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ejercicio;

class EjercicioSeeder extends Seeder
{
    public function run(): void
    {
        Ejercicio::create([
            'titulo' => 'Meditación guiada para estudiantes (10 minutos)',
            'descripcion' => 'Un ejercicio perfecto para relajar la mente después de clases o antes de dormir.',
            'categoria' => 'Meditación',
            'imagen' => 'ejercicios/meditacion.jpg',
            'video_url' => 'https://www.youtube.com/watch?v=ZToicYcHIOU',
            'duracion' => 10,
            'icono' => 'fas fa-spa',
        ]);

        Ejercicio::create([
            'titulo' => 'Ejercicio de respiración profunda controlada',
            'descripcion' => 'Ideal para momentos de ansiedad o estrés antes de un examen.',
            'categoria' => 'Respiración',
            'imagen' => 'ejercicios/respiracion.png',
            'video_url' => 'https://www.youtube.com/watch?v=kgTL5G1ibIo',
            'duracion' => 6,
            'icono' => 'fas fa-wind',
        ]);

        Ejercicio::create([
            'titulo' => 'Yoga suave para estiramiento y enfoque',
            'descripcion' => 'Estiramientos suaves ideales para comenzar tu día con energía positiva.',
            'categoria' => 'Yoga',
            'imagen' => 'ejercicios/yoga.jpg',
            'video_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE',
            'duracion' => 15,
            'icono' => 'fas fa-child',
        ]);
    }
}
