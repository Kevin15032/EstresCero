<?php

namespace App\Http\Controllers;

use App\Models\Post;  // Asegúrate de que esta línea esté presente
use App\Models\Comment;
use Illuminate\Http\Request;

class ForoController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->get();
        
        return view('foro', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('foro')->with('success', '¡Post creado exitosamente!');
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);

        return back()->with('success', '¡Comentario agregado!');
    }
}
