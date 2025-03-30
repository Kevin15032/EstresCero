<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Recurso;
use App\Models\Ejercicio;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('perfiladmin', compact('user'));
    }

    public function dashboard()
    {
        // Verificar si el usuario es administrador
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('dashboard');
        }

        // Redirigir directamente a la vista de usuarios
        return redirect()->route('admin.users.index');
    }
}
