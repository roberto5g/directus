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
        $user_om_id = Auth::user()->om->id;

        $perguntas_select = Perguntas::where('status','Ativo')->with(['user' => function($user){
            $user->with('om');
        },'om'=>function($om) use($user_om_id){
            $om->where('om_id', $user_om_id)
            ->where('status','pendente');
        }])->get();


        $perguntas_lista = [];
        if($perguntas_select){
            foreach($perguntas_select as $pergunta){
                if(count($pergunta->om)){
                    $item = new \stdClass();
                    $item->id = $pergunta->id;
                    $item->sigla = $pergunta->user->om->sigla;
                    $item->descricao = $pergunta->descricao;
                    $item->anexo = $pergunta->anexo;
                
                    $perguntas_lista[] = $item;
                }
            }
        }

        $perguntas = $perguntas_lista;

        if (Auth::user()->tipo == 'administrador') {
            $oms = Om::all();
            return view('admin.dashboard',compact('oms'));
        } else if(Auth::user()->tipo == 'gerente') {
            $oms = Om::all();
            return view('admin.dashboard',compact('oms'));
        } else {
            return view('usuarios.dashboard', compact('perguntas'));
        }

    }
}
