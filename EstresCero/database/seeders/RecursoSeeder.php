<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recurso;

class RecursoSeeder extends Seeder
{
    public function run(): void
    {
        Recurso::create([
            'titulo' => 'Cómo gestionar tus emociones en época de exámenes',
            'descripcion' => 'Descubre técnicas efectivas para mantener la calma y el enfoque durante los exámenes.',
            'contenido' => 'Durante los periodos de exámenes, la gestión emocional es clave para lograr un buen rendimiento académico. La respiración consciente es una herramienta poderosa para calmar la mente en momentos de ansiedad. También puedes usar técnicas como el journaling para expresar tus emociones y evitar que se acumulen. No subestimes el poder de una buena alimentación y el descanso adecuado: dormir bien mejora la memoria y la capacidad de concentración. Finalmente, establecer rutinas realistas y no compararte con otros te ayudará a mantener un estado mental equilibrado.',
            'categoria' => 'Artículo',
            'imagen' => 'recursos/articulo.jpg',
        ]);

        Recurso::create([
            'titulo' => 'Guía semanal para organizar tus tareas universitarias',
            'descripcion' => 'Aprende a dividir tu semana de forma efectiva para evitar el estrés por acumulación.',
            'contenido' => 'Una buena planificación semanal puede marcar la diferencia entre el caos y la productividad. Empieza cada domingo dedicando 20 minutos a planificar tu semana. Usa una agenda o aplicación para anotar fechas de entrega, tiempos de estudio y momentos de descanso. Prioriza tareas usando la técnica Eisenhower (urgente vs importante). Deja bloques libres para imprevistos y no olvides incluir actividades de autocuidado. Al mantener una rutina visualmente clara, reduces la sobrecarga mental y mejoras tu sentido de control.',
            'categoria' => 'Guía',
            'imagen' => 'recursos/guia.jpg',
        ]);

        Recurso::create([
            'titulo' => 'Tips para mejorar tu concentración en clases virtuales',
            'descripcion' => 'Pequeños cambios que pueden marcar una gran diferencia en tu aprendizaje remoto.',
            'contenido' => 'Estudiar desde casa puede ser un reto, pero con algunos ajustes puedes mejorar mucho tu concentración. Designa un espacio fijo, limpio y ordenado para tus clases. Usa audífonos para aislar ruidos externos y cierra pestañas que no estés usando. Aplica la técnica Pomodoro: estudia 25 minutos y descansa 5. Evita multitareas: enfócate en una sola cosa a la vez. Además, comunicarte con tus profesores o compañeros cuando tengas dudas mantiene tu atención activa. Una buena postura y luz natural también influyen en tu productividad.',
            'categoria' => 'Tips',
            'imagen' => 'recursos/tips.jpg',
        ]);
    }
}
