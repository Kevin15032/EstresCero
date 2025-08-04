@extends('layouts.navprincipal')

@section('titulo', 'Seguimiento Emocional')

@section('estilos')
<style>
    body {
        background-color: #e6f5f9;
    }

    .diary-form {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 40px;
        animation: fadeIn 0.5s ease;
    }

    .diary-form label {
        font-weight: 500;
        color: #1D3557;
    }

    .btn-add {
        background: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: #1D3557;
        transform: scale(1.05);
    }

    .entry-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        padding: 20px;
        margin-bottom: 25px;
        animation: slideInUp 0.4s ease;
        position: relative;
        border-left: 6px solid #A8DADC;
    }

    .entry-card.low {
        border-left-color: #38b000;
    }

    .entry-card.medium {
        border-left-color: #f1c40f;
    }

    .entry-card.high {
        border-left-color: #e63946;
    }

    .entry-card h5 {
        margin-bottom: 10px;
        font-weight: bold;
        color: #1D3557;
    }

    .entry-card p {
        margin: 4px 0;
        color: #333;
    }

    .entry-emoji {
        font-size: 1.5rem;
        margin-right: 6px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('contenido')
<main class="container mt-4">
    <div class="diary-form">
        <form action="{{ route('seguimiento.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">📅 Fecha</label>
                <input type="date" class="form-control" id="date" name="date" required>
                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="stress_level" class="form-label">🌡️ Nivel de Estrés</label>
                <select class="form-control" id="stress_level" name="stress_level" required>
                    <option value="Bajo">Bajo</option>
                    <option value="Medio">Medio</option>
                    <option value="Alto">Alto</option>
                </select>
                @error('stress_level') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="emotion" class="form-label">😊 Emoción</label>
                <input type="text" class="form-control" id="emotion" name="emotion" placeholder="Ej. Tristeza, Alegría..." required>
                @error('emotion') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">📝 Comentario</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Cuéntanos cómo te sentiste hoy..." required></textarea>
                @error('comment') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-add">Agregar</button>
        </form>
    </div>

    @foreach($entries as $entry)
    @php
        $stressClass = strtolower($entry->stress_level);
        $emoji = match(strtolower($entry->emotion)) {
            'felicidad', 'alegría' => '😄',
            'tristeza' => '😢',
            'enojo' => '😠',
            'ansiedad' => '😰',
            'miedo' => '😨',
            'amor' => '💖',
            default => '🧠',
        };

        $stressIcon = match(strtolower($entry->stress_level)) {
            'bajo' => '🟢',
            'medio' => '🟡',
            'alto' => '🔴',
            default => '⚪',
        };
    @endphp
    <div class="entry-card {{ $stressClass }}">
        <h5>{{ $entry->date->format('l, d M Y') }}</h5>
        <p><span class="entry-emoji">{{ $stressIcon }}</span><strong>Nivel de Estrés:</strong> {{ $entry->stress_level }}</p>
        <p><span class="entry-emoji">{{ $emoji }}</span><strong>Emoción:</strong> {{ $entry->emotion }}</p>
        <p class="fst-italic">"{{ $entry->comment }}"</p>
    </div>
    @endforeach
</main>
@endsection
