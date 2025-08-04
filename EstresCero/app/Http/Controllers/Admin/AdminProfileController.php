<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    // Mostrar perfil del administrador
    public function index()
    {
        $user = auth()->user();
        return view('perfiladmin', compact('user'));
    }

    // Vista para editar el perfil del administrador
    public function edit()
    {
        $user = auth()->user();
        return view('editarperfiladmin', compact('user'));
    }

    // Actualizar perfil del administrador
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Si se envió nueva contraseña
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Si se subió un nuevo avatar
        if ($request->hasFile('avatar')) {
            // Borrar avatar anterior si existe
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('admin.perfil')->with('success', 'Perfil actualizado correctamente');
    }

    // Redirige al dashboard principal del admin
    public function dashboard()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('admin.users.index');
    }
}
