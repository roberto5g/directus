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
        $perguntas = Perguntas::with(['respostas' => function($query) use ($user_id) {
            $query->where('user_id','<>',$user_id);
        }])->get();
        //dd($perguntas);
/*
        $perguntas = [];
        foreach ($resultados as $pergunta){
            if($pergunta->respostas){
                foreach ($pergunta->respostas as $respostas){
                    if($respostas->user_id != $user_id){
                        $perguntas[] = $respostas;
                    }
                }

            }
        }*/

        return response()->json($perguntas);

        if (Auth::user()->tipo == 'administrador') {
            return view('admin.dashboard');
        } else {
            return view('usuarios.dashboard', compact('perguntas'));
        }


    }
}
