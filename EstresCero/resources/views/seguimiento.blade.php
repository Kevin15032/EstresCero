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
    <form class="mb-4">
        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="date" required>
        </div>
        <div class="mb-3">
            <label for="stressLevel" class="form-label">Nivel de Estrés</label>
            <select class="form-control" id="stressLevel" required>
                <option value="Bajo">Bajo</option>
                <option value="Medio">Medio</option>
                <option value="Alto">Alto</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="emotion" class="form-label">Emoción</label>
            <input type="text" class="form-control" id="emotion" required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Comentario</label>
            <textarea class="form-control" id="comment" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-custom">Agregar</button>
    </form>

    <div id="entries">
        <!-- Entrada 1 -->
        <div class="entry">
            <h3>2024-03-22</h3>
            <p><strong>Nivel de Estrés:</strong> Bajo</p>
            <p><strong>Emoción:</strong> Feliz</p>
            <p class="fst-italic">"Buen día de estudio"</p>
        </div>

        <!-- Entrada 2 -->
        <div class="entry">
            <h3>2024-03-21</h3>
            <p><strong>Nivel de Estrés:</strong> Medio</p>
            <p><strong>Emoción:</strong> Ansioso</p>
            <p class="fst-italic">"Examen próximo"</p>
        </div>

        <!-- Entrada 3 -->
        <div class="entry">
            <h3>2024-03-20</h3>
            <p><strong>Nivel de Estrés:</strong> Alto</p>
            <p><strong>Emoción:</strong> Estresado</p>
            <p class="fst-italic">"Fecha límite del proyecto"</p>
        </div>
    </div>
</main>
@endsection