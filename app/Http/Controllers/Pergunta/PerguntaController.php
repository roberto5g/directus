<?php

namespace App\Http\Controllers\Pergunta;

use App\Http\Controllers\Controller;
use App\Models\Perguntas\OmPerguntas;
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

        //dd($request->all());
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

        $pergunta->om()->attach($request['om_pergunta']);

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

        $pergunta->om()->sync($request['om_pergunta']);

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

        $perguntas = Perguntas::where('id', $id)
            ->with(['om','respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->get();

        $resposta_pergunta = [];
        for ($j = 0; $j < count($perguntas); $j++) {

            for ($x = 0; $x < count($perguntas[$j]->om); $x++) {
                $item = new \stdClass();
                $item->id = $perguntas[$j]->om[$x]->om_id;
                $item->sigla = $perguntas[$j]->om[$x]->sigla;
                $item->nome = $perguntas[$j]->om[$x]->nome;
                $item->status = $perguntas[$j]->om[$x]->status;
                if($perguntas[$j]->respostas){
                    for($z = 0; $z < count($perguntas[$j]->respostas); $z++){
                        if($perguntas[$j]->respostas[$z]->users->om_id == $perguntas[$j]->om[$x]->om_id){
                            $item->resposta = $perguntas[$j]->respostas[$z]->resposta;
                            $item->data = date('d/m/Y H:m:s', strtotime($perguntas[$j]->respostas[$z]->created_at));
                            $item->anexo = $perguntas[$j]->respostas[$z]->anexo_resposta;
                        }
                    }
                }
                $resposta_pergunta[] = $item;
            }
        }

        $retorno = [];
        foreach ($resposta_pergunta as $val){
            $item = new \stdClass();
            if($val->status == 'pendente'){
                $item->id = $val->id;
                $item->sigla = $val->sigla;
                $item->nome = $val->nome;
                $item->status = $val->status;
                $item->resposta = "Não respondido";
                $item->data = "--";
                $item->anexo = "--";
            } else {
                $item->id = $val->id;
                $item->sigla = $val->sigla;
                $item->nome = $val->nome;
                $item->status = $val->status;
                $item->resposta = $val->resposta;
                $item->data = $val->data;
                $item->anexo = $val->anexo;
            }
            $retorno[] = $item;
        }

        return datatables()->of($retorno)->make(true);



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
        if(Auth::user()->tipo == 'administrador'){
            $pergunta = Perguntas::all();
        } elseif (Auth::user()->tipo == 'gerente'){
            $pergunta = Perguntas::where('user_id',Auth::user()->id)->get();
        }

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
        if(Auth::user()->tipo == 'administrador'){
            $perguntas = Perguntas::with(['om','user' => function ($user) {
                $user->with('om');
            }])->get();
        } elseif (Auth::user()->tipo == 'gerente'){
            $perguntas = Perguntas::where('user_id',Auth::user()->id)->with(['om','user' => function ($user) {
                $user->with('om');
            }])->get();
        }


        $percentual = [];
        $pendente = 0;
        $respondido = 0;
        foreach ($perguntas as $pergunta){
            $pendente=0;
            $respondido=0;
            $item = new \stdClass();
            foreach ($pergunta->om as $om){
                if($om->status=='pendente'){
                    $pendente+=1;
                } else {
                    $respondido+=1;
                }
            }
            $item->porcentagem = number_format(($respondido*100)/($respondido+$pendente),2);
            $percentual[] = $item;
        }

        $retorno = [];
        for ($i = 0; $i < count($perguntas); $i++){
            $item = new \stdClass();
            $item->id = $perguntas[$i]->id;
            $item->sigla = $perguntas[$i]->user->om->sigla;
            $item->descricao = $perguntas[$i]->descricao;
            $item->created_at = date('d/m/Y h:m:s', strtotime($perguntas[$i]->created_at));
            $item->status = $perguntas[$i]->status;
            $item->porcentagem = $percentual[$i]->porcentagem;
            $retorno[] = $item;
        }

        return datatables()->of($retorno)->addColumn('action', function ($query) {


            return '<div class="text-center"> 
                       
                        <h6><a href="#" class="badge badge-secondary" id="detalhes_' . $query->id . '" onclick="detalhesPergunta(' . $query->id . ')"  data-descricao="' . $query->descricao . '" data-toggle="modal">
                            <i class="fa fa-search separaicon " data-toggle="tooltip" data-placement="top" title="Detalhes Pergunta"></i>
                        </a></h6>
                    
                    </div>';

        })->make(true);
    }

}
