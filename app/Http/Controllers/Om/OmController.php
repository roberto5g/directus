<?php

namespace App\Http\Controllers\Om;

use App\Http\Controllers\Controller;
use App\Models\Om\Om;
use Illuminate\Http\Request;


class OmController extends Controller
{

    public function index()
    {

        return view('admin.cadastros.om.om');
    }

    public function cadastra(Request $request)
    {
        $om = Om::create([
            'nome' => $request['nome'],
            'sigla' => $request['sigla'],
        ]);
        return response()->json($request->all());
    }


    public function edita($id)
    {
        $om = Om::find($id);

        return response()->json($om);
    }

    public function update(Request $request,$id)
    {
        $om = Om::find($id);
        $om->nome = $request['nome'];
        $om->sigla = $request['sigla'];

        $om->save();

        return response()->json($om);
    }

    public function remove($id)
    {
        $om = Om::find($id);
        $om->delete();
        return response()->json('ok');
    }

    public function lista()
    {
        $oms = Om::where('id','>',1)->get();
        return response()->json($oms);
    }

    public function getData()
    {
        $oms = Om::where('id','>',1)->get();

        return datatables()->of($oms)->addColumn('action', function ($query) {
            return '<div class="text-center"> 
                       
                        <a href="#" class="link-simples edita_organizacao_militar" id="'.$query->id.'" onclick="editaOm('.$query->id.')"  data-nome="' . $query->nome . '" data-sigla="' . $query->sigla . '" data-toggle="modal">
                            <i class="fa fa-edit separaicon " data-toggle="tooltip" data-placement="top" title="Editar Organização Militar"></i>
                        </a>
                      
                        <a href="#" class="link-simples remover_om" id="'.$query->id.'" data-id="'.$query->id.'" data-nome="' . $query->nome . '" data-sigla="' . $query->sigla . '"data-toggle="modal">
                            <i class="fa fa-trash separaicon " data-toggle="tooltip" data-placement="top" title="Inativa Organização Militar por completo do sistema"></i>
                        </a>
                    </div>';
        })->make(true);
    }

}
