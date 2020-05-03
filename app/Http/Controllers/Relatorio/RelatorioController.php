<?php
namespace App\Http\Controllers\Relatorio;

use App\AreaAtuacao;
use App\Candidato;
use App\ExperienciaProfissional;
use App\Http\Controllers\Controller;
//use Datatables;
use App\Models\Om\Om;
use App\Models\Perguntas\Perguntas;
use App\Pessoa;
use PDF;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{


    // retorna resultado para gerar pdf do relatorio
    public function relatorio_om_sem_resposta(Request $request)
    {

        $perguntas = Perguntas::where('id', $request['pergunta_id'])
            ->with(['om','respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->get();

        $pergunta = $perguntas[0];

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
                            $item->data = date('d/m/Y h:m:s', strtotime($perguntas[$j]->respostas[$z]->created_at));
                            $item->anexo = $perguntas[$j]->respostas[$z]->anexo_resposta;
                        }
                    }
                }
                $resposta_pergunta[] = $item;
            }
        }

        $sem_resposta = [];
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
                $sem_resposta[] = $item;
            }

        }

        //dd($sem_resposta);

        // se o request for pdf então gera um arquivo pdf
        if ($request['pdf']) {

            $pdf = PDF::loadView('admin.relatorio.relatorio_pergunta_om_sem_resposta',
                compact('sem_resposta', 'pergunta'));
            $pdf->getDOMPdf()->set_option('isPhpEnabled', true);
            $pdf->setPaper("A4", "portrail");
            return $pdf->download('relatorio_oms_sem_resposta.pdf');
        }


    }

    // retorna relatorio geral
    public function relatorio_geral(Request $request)
    {

        $perguntas = Perguntas::where('id', $request['pergunta_id'])
            ->with(['om','respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->orderBy('perguntas.status','DESC')->get();

        $pergunta = $perguntas[0];

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
                            $item->data = date('d/m/Y h:m:s', strtotime($perguntas[$j]->respostas[$z]->created_at));
                            $item->anexo = $perguntas[$j]->respostas[$z]->anexo_resposta;
                        }
                    }
                }
                $resposta_pergunta[] = $item;
            }
        }

        $retorno_pendente = [];
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
                $retorno_pendente[] = $item;
            }
        }

        $retorno_respondido = [];
        foreach ($resposta_pergunta as $val){
            $item = new \stdClass();
            if($val->status == 'respondido'){
                $item->id = $val->id;
                $item->sigla = $val->sigla;
                $item->nome = $val->nome;
                $item->status = $val->status;
                $item->resposta = $val->resposta;
                $item->data = $val->data;
                $item->anexo = $val->anexo;
                $retorno_respondido[] = $item;
            }
        }

        $retorno = array_merge($retorno_respondido,$retorno_pendente);

        // se o request for pdf então gera um arquivo pdf
        if ($request['pdf']) {

            $pdf = PDF::loadView('admin.relatorio.relatorio_pergunta_geral',
                compact('retorno', 'pergunta'));
            $pdf->getDOMPdf()->set_option('isPhpEnabled', true);
            $pdf->setPaper("A4", "landscape");
            return $pdf->download('relatorio_pergunta_geral.pdf');
        }


    }


}

?>
