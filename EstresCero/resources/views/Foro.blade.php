@extends('layouts.navprincipal')

@section('titulo', 'Foro')

@section('estilos')
<style>
    .card {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        animation: fadeInUp 0.5s ease both;
    }

    .form-control {
        border-radius: 12px;
        padding: 10px 14px;
    }

    textarea.form-control {
        resize: none;
    }

    .btn-custom {
        background-color: #457B9D;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
    }

    .btn-custom:hover {
        background-color: #1D3557;
        transform: scale(1.05);
    }

    .btn-toggle {
        background-color: #A8DADC;
        color: #1D3557;
        border-radius: 20px;
        font-weight: bold;
        padding: 6px 16px;
        border: none;
        margin-top: 10px;
    }

    .btn-toggle:hover {
        background-color: #1D3557;
        color: #fff;
    }

    .post-avatar, .comment-avatar {
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #457B9D;
    }

    .post-avatar {
        width: 50px;
        height: 50px;
    }

    .comment-avatar {
        width: 30px;
        height: 30px;
    }

    .comments-section {
        border-left: 3px solid #A8DADC;
        padding-left: 16px;
        margin-top: 10px;
    }

    .comment {
        background-color: #f1f9fc;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .card-title {
        font-size: 1.2rem;
        color: #1D3557;
        font-weight: bold;
    }

    .card-text {
        font-size: 0.95rem;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('contenido')
<main class="container py-4">
    <!-- Crear Post -->
    <div class="card p-4 mb-4">
        <h4 class="mb-3">📝 Crear un nuevo post</h4>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenido</label>
                <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Publicar</button>
        </form>
    </div>

    <!-- Lista de posts -->
    @foreach($posts as $post)
    <div class="card p-4 mb-4">
        <div class="d-flex align-items-start">
            @if($post->user->avatar)
                <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" class="post-avatar me-3">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=random&color=fff&size=50" alt="{{ $post->user->name }}" class="post-avatar me-3">
            @endif

            <div class="w-100">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="text-muted">{{ $post->user->name }} – {{ $post->created_at->format('d M Y, h:i A') }}</p>
                <p class="card-text">{{ $post->content }}</p>

                <!-- Botón de comentarios -->
                <button class="btn btn-toggle mb-3" onclick="toggleComments({{ $post->id }})">
                    💬 Comentarios ({{ $post->comments->count() }})
                </button>

                <!-- Comentarios -->
                <div class="comments-section" id="comments-{{ $post->id }}" style="display: none;">
                    <!-- Nuevo comentario -->
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="input-group">
                            <input type="text" name="content" class="form-control" placeholder="Escribe un comentario..." required>
                            <button class="btn btn-custom" type="submit">Comentar</button>
                        </div>
                    </form>

                    <!-- Lista de comentarios -->
                    @foreach($post->comments as $comment)
                    <div class="comment">
                        <div class="d-flex align-items-start">
                            @if($comment->user->avatar)
                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="comment-avatar me-2">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff&size=30" alt="{{ $comment->user->name }}" class="comment-avatar me-2">
                            @endif
                            <div>
                                <p class="mb-1"><strong>{{ $comment->user->name }}</strong></p>
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
@endsection

@section('scripts')
<script>
function toggleComments(postId) {
    const section = document.getElementById(`comments-${postId}`);
    section.style.display = (section.style.display === 'none') ? 'block' : 'none';
}
</script>
@endsection
