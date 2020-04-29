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
        $user_id = Auth::user()->id;
        $resutado = Perguntas::with(['respostas' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->get();
        $perguntas = [];
        foreach ($resutado as $per) {
            if (count($per->respostas)) {
                foreach ($per->respostas as $res) {
                    if ($res->user_id != $user_id) {
                        $perguntas[] = $per;
                    }
                }
            } else {
                $perguntas[] = $per;
            }
        }

        if (Auth::user()->tipo == 'administrador') {
            return view('admin.dashboard');
        } else {
            return view('usuarios.dashboard', compact('perguntas'));
        }


    }
}
