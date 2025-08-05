<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'domingueztorreskevin@gmail.com'],
            [
                'name' => 'Kevin Dominguez',
                'password' => Hash::make('T15030315'), // Puedes cambiar la contraseña si deseas
                'is_admin' => true,
                'is_active' => true,
                'email_verified_at' => now(), // Para evitar pedir confirmación por correo
            ]
        );
    }
}

