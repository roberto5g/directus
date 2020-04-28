<?php

namespace App\Http\Controllers;

use App\Models\Respostas\Respostas;
use App\Models\Om\Om;
use App\Models\Perguntas\Perguntas;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perguntas = Perguntas::all();

        if (Auth::user()->tipo == 'administrador') {
            return view('admin.dashboard');
        } else {
            return view('usuarios.dashboard', compact('perguntas'));
        }


    }
}
