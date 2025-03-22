<?php

namespace App\Http\Controllers;

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

    public function dashboard()
    {
        return view('dashboard');
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
