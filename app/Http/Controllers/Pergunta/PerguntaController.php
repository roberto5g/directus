<?php

namespace App\Http\Controllers\Pergunta;

use App\Http\Controllers\Controller;
use App\Models\Respostas\Respostas;
use App\Models\Om\Om;
use App\Models\Perguntas\Perguntas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Request;

class PerguntaController extends Controller
{

    public function index()
    {

        return view('admin.cadastros.pergunta.pergunta');
    }

    public function cadastra(FormRequest $request)
    {

        //return response()->json($request->all());

        $pergunta = new Perguntas();
        $pergunta->descricao = $request['descricao'];
        $pergunta->user_id = auth()->user()->id;

        if ($request->hasFile('anexo') && $request->file('anexo')->isValid()) {

            $folderPath = 'arquivos/perguntas/anexo/';

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->anexo->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->anexo->storeAs($folderPath, $nameFile);
            $pergunta->anexo = $folderPath . $nameFile;
        }

        $pergunta->save();


        if ($pergunta instanceof Model) {

            Request::session()->flash('sucesso', "Pergunta cadastrada com sucesso.");
            return back();

        } else {
            Request::session()->flash('erro', "Ocorreu um erro, tente novamente.");

            return back();
        }
    }


    public function edita(FormRequest $request)
    {


        $pergunta = Perguntas::find($request['pergunta_id']);
        $pergunta->descricao = $request['descricao'];
        //$pergunta->anexo = $request['anexo'];

        if ($request->hasFile('anexo') && $request->file('anexo')->isValid()) {

            Storage::delete($pergunta->anexo);

            $folderPath = 'arquivos/perguntas/anexo/';

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->anexo->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:

            $upload = $request->anexo->storeAs($folderPath, $nameFile);
            //Storage::put($folderPath. $nameFile,$upload);

            $pergunta->anexo = $folderPath . $nameFile;
        }


        $pergunta->save();

        if ($pergunta instanceof Model) {

            Request::session()->flash('sucesso', "Pergunta editada com sucesso.");
            return back();

        } else {
            Request::session()->flash('erro', "Ocorreu um erro, tente novamente.");

            return back();
        }


    }


    public function lista($id)
    {

        $oms = Om::all();


        $respostas = Respostas::with(['perguntas' => function ($query) use ($id) {
            $query->where('id', $id)->with(['user' => function ($user) {
                $user->with('om');
            }]);
        }])->get();

        $resultado = [];
        foreach ($respostas as $resp) {
            if ($resp->perguntas != null) {
                $resultado[] = $resp;
            }
        }

        $retorno = [];
        foreach ($oms as $om) {

            $item = new \stdClass();
            foreach ($resultado as $resulta) {

                if ($om->id == $resulta->perguntas->user->om->id) {

                    $item->id = $resulta->perguntas->user->om->id;
                    $item->nome = $resulta->perguntas->user->om->nome;
                    $item->resposta = $resulta->resposta;
                    //$item->data = date('d/m/Y HH:mm:ss', strtotime($perguntas[$j]->respostas[$x]->created_at));
                    $item->anexo = $resulta->anexo_resposta;

                } else {

                    $item->id = $om->id;
                    $item->nome = $om->sigla;
                    $item->resposta = "Não informado";
                    //$item->data = date('d/m/Y HH:mm:ss', strtotime($perguntas[$j]->respostas[$x]->created_at));
                    $item->anexo = 'sem anexo';

                }
            }
            $retorno[] = $item;

        }

        return response()->json([$oms,$resultado]);

        /*$perguntas = Perguntas::where('id', $id)
            ->with(['respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->first();*/


        /*$retorno = [];
        foreach ($perguntas->respostas as $resposta) {
            if($resposta){
                foreach ($oms as $om) {
                    // $retorno = [];
                    $item = new \stdClass();
                    if ($om->id == $resposta->users->om->id) {
                        $item->id = $resposta->users->om->id;
                        $item->nome = $resposta->users->om->nome;
                        $item->resposta = $resposta->resposta;
                        //$item->data = date('d/m/Y HH:mm:ss', strtotime($perguntas[$j]->respostas[$x]->created_at));
                        $item->anexo = $resposta->anexo_resposta;

                    } else {
                        $item->id = $om->id;
                        $item->nome = $om->nome;
                        $item->resposta = "Não informado";
                        //$item->data = "--";
                        $item->anexo = "Sem anexo";

                    }
                    $retorno[] = $item;
                }
            } else {
                $retorno[] = "NADA";
            }
        }*/

        /*for($i = 0; $i < count($oms); $i++){
            $item = new \stdClass();
            for($j = 0; $j < count($perguntas); $j++){
                for($x = 0; $x < count($perguntas[$j]->respostas); $x++){
                    if($oms[$i]->id == $perguntas[$j]->respostas[$x]->users->om_id){
                        $item->id = $perguntas[$j]->respostas[$x]->users->om->id;
                        $item->nome = $perguntas[$j]->respostas[$x]->users->om->nome;
                        $item->resposta = $perguntas[$j]->respostas[$x]->resposta;
                        //$item->data = date('d/m/Y HH:mm:ss', strtotime($perguntas[$j]->respostas[$x]->created_at));
                        $item->anexo = $perguntas[$j]->respostas[$x]->anexo_resposta;

                    } else {
                        $item->id = $oms[$i]->id;
                        $item->nome = $oms[$i]->nome;
                        $item->resposta = "Não informado";
                        //$item->data = "--";
                        $item->anexo = "Sem anexo";

                    }

                }
            }
            $retorno[] = $item;
        }*/


    }


    public function inativa($id)
    {
        $pergunta = Perguntas::find($id);
        $pergunta->status = 'Inativa';
        $pergunta->save();

        return response()->json('ok');
    }

    public function ativa($id)
    {
        $pergunta = Perguntas::find($id);
        $pergunta->status = 'Ativo';
        $pergunta->save();

        return response()->json('ok');
    }

    public function remove($id)
    {
        $pergunta = Perguntas::find($id);
        $respostas = Respostas::where('pergunta_id', $id)->get();
        foreach ($respostas as $resposta) {
            $resposta->delete();
        }
        Storage::delete($pergunta->anexo);
        $pergunta->delete();

        return response()->json('ok');
    }


    public function detalhes($id)
    {
        $pergunta = Perguntas::where('id', $id)
            ->with(['respostas' => function ($respostas) {
                $respostas->with(['users' => function ($user) {
                    $user->with('om');
                }]);
            }])->get();
        return response()->json($pergunta);
    }


    public function getData()
    {
        $pergunta = Perguntas::all();

        return datatables()->of($pergunta)->addColumn('action', function ($query) {

            if ($query->status == 'Ativo') {
                return '<div class="text-center"> 
                       
                        <a href="#" class="link-simples " id="edita_' . $query->id . '" onclick="editaPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-edit separaicon " data-toggle="tooltip" data-placement="top" title="Editar Pergunta"></i>
                        </a>
                        
                        <a href="#" class="link-simples " id="remove_' . $query->id . '" onclick="removePergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-trash separaicon " data-toggle="tooltip" data-placement="top" title="Remover Pergunta"></i>
                        </a>
                        
                        <a href="#" class="link-simples " id="inativa_' . $query->id . '" onclick="inativaPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-ban separaicon " data-toggle="tooltip" data-placement="top" title="Inativar Pergunta"></i>
                        </a>
             
                    </div>';
            } else {
                return '<div class="text-center"> 
                       
                        <a href="#" class="link-simples " id="edita_' . $query->id . '" onclick="editaPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-edit separaicon " data-toggle="tooltip" data-placement="top" title="Editar Pergunta"></i>
                        </a>
                        
                        <a href="#" class="link-simples " id="remove_' . $query->id . '" onclick="removePergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-trash separaicon " data-toggle="tooltip" data-placement="top" title="Remover Pergunta"></i>
                        </a>
                        
                        <a href="#" class="link-simples " id="ativar_' . $query->id . '" onclick="ativarPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-mail-reply separaicon " data-toggle="tooltip" data-placement="top" title="Ativar Pergunta"></i>
                        </a>
             
                    </div>';
            }
        })->make(true);
    }

    public function listaData()
    {
        $pergunta = Perguntas::with(['user' => function ($user) {
            $user->with('om');
        }])->get();

        // return response()->json($pergunta);

        return datatables()->of($pergunta)->addColumn('action', function ($query) {


            return '<div class="text-center"> 
                       
                        <h6><a href="#" class="badge badge-secondary" id="detalhes_' . $query->id . '" onclick="detalhesPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-search separaicon " data-toggle="tooltip" data-placement="top" title="Detalhes Pergunta"></i>
                        </a></h6>
                    
                    </div>';

        })->make(true);
    }

}
