<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PaginasController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function sesion()
    {
        return view('sesion');
    }

    public function registro()
    {
        return view('registro');
    }

    public function recursos()
    {
        return view('recursos');
    }

    public function ejercicios()
    {
        return view('ejercicios');
    }

    public function seguimiento()
    {
        return view('seguimiento');
    }

    public function foro()
    {
        return view('foro');
    }
    public function perfil()
    {
        return view('perfil');
    }

    
}
