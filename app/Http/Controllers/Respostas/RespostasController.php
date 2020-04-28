<?php

namespace App\Http\Controllers\Respostas;

use App\Http\Controllers\Controller;
use App\Models\Respostas\Respostas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RespostasController extends Controller
{


    public function cadastra(Request $request,$id)
    {

        /*$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
        $pieces = explode(" ", $pizza);
        echo $pieces[0]; // piece1
        echo $pieces[1]; // piece2*/


        $resposta = Respostas::create([
            'resposta' => $request['resposta'],
            'pergunta_id' => $id,
            'user_id' => Auth::user()->id
        ]);

        //dd($request->all());

        /*$levantamento = Respostas::create([
            'confirmado' => $request['confirmado'],
            'responsaveis' => $request['responsaveis'],
            'idosos' => $request['idosos'],
            'imunodeficiente' => $request['imunodeficiente'],
            'gestantes' => $request['gestantes'],
            'idade_escolar' => $request['idade_escolar'],
            'nao_presentes' => $request['nao_presentes'],
            'user_id' => Auth::user()->id,
            'periodo_id' => $request['pergunta'],
        ]);*/
        return back();
    }


    public function edita($id)
    {
        $levantamento = Respostas::find($id);

        return response()->json($levantamento);
    }


    public function remove($id)
    {
        $levantamento = Respostas::find($id);
        $levantamento->delete();
        return response()->json('ok');
    }

    public function lista()
    {
        $levantamento = Respostas::all();
        return response()->json($levantamento);
    }

    public function getData()
    {
        $retorno = [];
        $levantamentos = Respostas::where('user_id',Auth::user()->id)->with('pergunta')->get();

        foreach ($levantamentos as $levantamento){
            $levantamento->periodo->fim = date('Y-m-d',strtotime("-1 day", strtotime($levantamento->periodo->fim)));
            $retorno[] = $levantamento;
        }


        return datatables()->of($retorno)->addColumn('action', function ($query) {
            return '<div class="text-center"> 
                       
                        <a href="#" class="link-simples " id="detalhes_'.$query->id.'" onclick="detalhes('.$query->id.')"  
                            data-confirmado="' . $query->confirmado . '" 
                            data-responsaveis="' . $query->responsaveis . '" 
                            data-idosos="' . $query->idosos . '" 
                            data-imunodeficiente="' . $query->imunodeficiente . '" 
                            data-gestantes="' . $query->gestantes . '" 
                            data-idade_escolar="' . $query->idade_escolar . '" 
                            data-nao_presentes="' . $query->nao_presentes . '" 
                            data-toggle="modal">
                            <i class="fa fa-search separaicon " data-toggle="tooltip" data-placement="top" title="Detalhes"></i>
                        </a>
             
                    </div>';
        })->make(true);
    }

}
