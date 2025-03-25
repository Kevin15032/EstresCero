@extends('layouts.navprincipal')

@section('titulo', 'Seguimiento Emocional')

@section('estilos')
<style>
    .entry {
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        position: relative;
        width: calc(33.333% - 30px);
        margin: 15px;
        float: left;
        background-color: white;
        border-left: 5px solid #457B9D;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .entry:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
    }

    .entry h3 {
        color: #1D3557;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    .entry p {
        color: #333333;
        margin-bottom: 8px;
    }

    .entry p strong {
        color: #457B9D;
    }

    .entry::before {
        content: "";
        position: absolute;
        top: -10px;
        left: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #457B9D;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
@endsection

@section('contenido')
<main class="container mt-4 clearfix">
    <form action="{{ route('seguimiento.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" required>
            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stress_level" class="form-label">Nivel de Estrés</label>
            <select class="form-control" id="stress_level" name="stress_level" required>
                <option value="Bajo">Bajo</option>
                <option value="Medio">Medio</option>
                <option value="Alto">Alto</option>
            </select>
            @error('stress_level')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="emotion" class="form-label">Emoción</label>
            <input type="text" class="form-control" id="emotion" name="emotion" required>
            @error('emotion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comentario</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            @error('comment')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-custom">Agregar</button>
    </form>

    <div id="entries">
        @foreach($entries as $entry)
        <div class="entry">
            <h3>{{ $entry->date->format('Y-m-d') }}</h3>
            <p><strong>Nivel de Estrés:</strong> {{ $entry->stress_level }}</p>
            <p><strong>Emoción:</strong> {{ $entry->emotion }}</p>
            <p class="fst-italic">"{{ $entry->comment }}"</p>
        </div>
        @endforeach
    </div>
</main>
@endsection