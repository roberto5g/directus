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

        $oms = Om::all();

        $perguntas = Perguntas::where('id', $request['pergunta_id'])
            ->with(['respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->get();

        $pergunta = $perguntas[0];

        $sem_resposta = [];
        $array_om_id = [];
        for ($j = 0; $j < count($perguntas); $j++) {
            for ($x = 0; $x < count($perguntas[$j]->respostas); $x++) {
                $array_om_id[] = $perguntas[$j]->respostas[$x]->users->om_id;
            }
        }

        for ($i = 0; $i < count($oms); $i++) {

            if (!in_array($oms[$i]->id, $array_om_id)) {
                $item = new \stdClass();
                $item->id = $oms[$i]->id;
                $item->nome = $oms[$i]->nome;
                $item->sigla = $oms[$i]->sigla;
                $item->resposta = "Não informado";
                $item->data = "--";
                $item->anexo = null;
                $sem_resposta[] = $item;
            }

        }


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

        $oms = Om::all();

        $perguntas = Perguntas::where('id', $request['pergunta_id'])
            ->with(['respostas' => function ($respostas) {
                $respostas->with(['users' => function ($users) {
                    $users->with('om');
                }]);
            }])->get();

        $pergunta = $perguntas[0];

        $sem_resposta = [];
        $array_om_id = [];
        $com_resposta = [];
        for ($j = 0; $j < count($perguntas); $j++) {

            for ($x = 0; $x < count($perguntas[$j]->respostas); $x++) {
                $item = new \stdClass();
                $item->id = $perguntas[$j]->respostas[$x]->users->om_id;
                $item->sigla = $perguntas[$j]->respostas[$x]->users->om->sigla;
                $item->resposta = $perguntas[$j]->respostas[$x]->resposta;
                $item->data = date('d/m/Y h:m:s', strtotime($perguntas[$j]->respostas[$x]->created_at));
                //$item->anexo = $perguntas[$j]->respostas[$x]->anexo_resposta;
                $com_resposta[] = $item;
                $array_om_id[] = $perguntas[$j]->respostas[$x]->users->om_id;
            }
        }

        for ($i = 0; $i < count($oms); $i++) {

            if (!in_array($oms[$i]->id, $array_om_id)) {
                $item = new \stdClass();
                $item->id = $oms[$i]->id;
                $item->sigla = $oms[$i]->sigla;
                $item->resposta = "Não informado";
                $item->data = "--";
                //$item->anexo = null;
                $sem_resposta[] = $item;
            }

        }

        $retorno = array_merge($com_resposta,$sem_resposta);
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
