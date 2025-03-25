@extends('layouts.navprincipal')

@section('titulo', 'Foro')

@section('estilos')
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-title {
        color: #1D3557;
    }
    .card-text {
        color: #333333;
    }
    .btn-custom {
        background: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s ease;
        font-weight: 500;
        min-width: 80px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-custom:hover {
        background: #1D3557;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
        color: white;
    }
    .btn-custom:active {
        transform: translateY(0px);
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    .comments-section {
        margin-left: 50px;
        border-left: 2px solid #457B9D;
        padding-left: 20px;
        margin-top: 10px;
    }
    .comment {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .rounded-circle {
        border: 2px solid #457B9D;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .comment .rounded-circle {
        border-width: 1px;
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Formulario para crear post -->
    <div class="card p-4 mb-4">
        <h4>Crear un nuevo post</h4>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Publicar</button>
        </form>
    </div>

    <!-- Lista de posts -->
    @foreach($posts as $post)
    <div class="card p-4 mb-4">
        <div class="d-flex align-items-start">
            @if($post->user->avatar)
                <img src="{{ asset('storage/' . $post->user->avatar) }}" 
                     alt="{{ $post->user->name }}" 
                     class="rounded-circle me-3" 
                     style="width: 50px; height: 50px; object-fit: cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff&size=50&bold=true" 
                     alt="{{ $post->user->name }}" 
                     class="rounded-circle me-3" 
                     style="width: 50px; height: 50px; object-fit: cover;">
            @endif
            <div class="w-100">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="text-muted">{{ $post->user->name }} - {{ $post->created_at->format('d M Y, h:i A') }}</p>
                <p class="card-text">{{ $post->content }}</p>
                
                <!-- Botón para mostrar/ocultar comentarios -->
                <button class="btn btn-custom mb-3" onclick="toggleComments({{ $post->id }})">
                    <i class="bi bi-chat-dots"></i> Comentarios ({{ $post->comments->count() }})
                </button>

                <!-- Sección de comentarios -->
                <div class="comments-section" id="comments-{{ $post->id }}" style="display: none;">
                    <!-- Formulario para nuevo comentario -->
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="content" 
                                   placeholder="Escribe un comentario..." required>
                            <button class="btn btn-custom" type="submit">Comentar</button>
                        </div>
                    </form>

                    <!-- Lista de comentarios -->
                    @foreach($post->comments as $comment)
                    <div class="comment">
                        <div class="d-flex align-items-start">
                            @if($comment->user->avatar)
                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" 
                                     alt="{{ $comment->user->name }}" 
                                     class="rounded-circle me-2" 
                                     style="width: 30px; height: 30px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff&size=30&bold=true" 
                                     alt="{{ $comment->user->name }}" 
                                     class="rounded-circle me-2" 
                                     style="width: 30px; height: 30px; object-fit: cover;">
                            @endif
                            <div>
                                <p class="mb-0"><strong>{{ $comment->user->name }}</strong></p>
                                <p class="text-muted small mb-1">{{ $comment->created_at->format('d M Y, h:i A') }}</p>
                                <p class="mb-0">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</main>

@section('scripts')
<script>
function toggleComments(postId) {
    const commentsSection = document.getElementById(`comments-${postId}`);
    commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection
@endsection