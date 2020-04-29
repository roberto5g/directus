<?php

namespace App\Http\Controllers\Respostas;

use App\Http\Controllers\Controller;
use App\Models\Respostas\Respostas;
use Illuminate\Http\Request as FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Request;

class RespostasController extends Controller
{


    public function cadastra(FormRequest $request,$id)
    {

        $resposta = new Respostas();
        $resposta->resposta = $request['resposta'];
        $resposta->pergunta_id = $id;
        $resposta->user_id = Auth::user()->id;



        if ($request->hasFile('anexo_resposta') && $request->file('anexo_resposta')->isValid()) {

            $folderPath = 'arquivos/perguntas/resposta/anexo/';

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->anexo_resposta->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->anexo_resposta->storeAs($folderPath, $nameFile);
            $resposta->anexo_resposta = $folderPath . $nameFile;
        }

        $resposta->save();

        if ($resposta instanceof Model) {

            Request::session()->flash('sucesso', "Resposta enviada com sucesso.");
            return back();

        } else {
            Request::session()->flash('erro', "Ocorreu um erro, tente novamente.");

            return back();
        }

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

        $respostas = Respostas::where('user_id',Auth::user()->id)
            ->with(['perguntas' => function($query){
                $query->with(['user' => function($user) {
                    $user->with('om');
                }]);
            }])->get();


        return datatables()->of($respostas)->addColumn('action', function ($query) {
            return '<div class="text-center"> 
                       
                        <a href="#" class="link-simples " id="detalhes_'.$query->id.'" onclick="detalhes('.$query->id.')"  
                            data-pergunta="' . $query->perguntas->descricao . '" 
                            data-om="' . $query->perguntas->user->om->sigla . '" 
                            data-resposta="' . $query->resposta . '" 
                            data-anexo_pergunta="' . $query->perguntas->anexo . '" 
                            data-anexo_resposta="' . $query->anexo_resposta . '" 
                            data-toggle="modal">
                            <i class="fa fa-search separaicon " data-toggle="tooltip" data-placement="top" title="Detalhes"></i>
                        </a>
             
                    </div>';
        })->make(true);
    }

}
