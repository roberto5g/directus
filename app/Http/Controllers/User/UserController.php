<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        return view('admin.cadastros.usuario.usuario');
    }

    public function cadastra(Request $request)
    {
        $usuario = User::create([
            'nome' => $request['nome'],
            'email' => strtolower($request['email']),
            'password' => bcrypt($request['password']),
            'om_id' =>  $request['om_id'],
            'tipo' => $request['tipo'],
        ]);

        return response()->json($usuario);
    }

    public function edita(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->nome = $request['nome'];
        $usuario->email = $request['email'];
        $usuario->tipo = $request['tipo'];
        $usuario->om_id = $request['om_id_edita'];
        $usuario->save();
        return response()->json($usuario);
    }

    public function resetaSenha($id)
    {
        $usuario = User::find($id);
        $usuario->password = bcrypt($usuario->email);
        $usuario->save();
    }

    public function remove($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return response()->json('ok');
    }

    public function getData()
    {
        $user = User::with('om')->get();
        return datatables()->of(
            $user
        )->addColumn('action', function ($query) {
            return '<div class="text-center">
                        <a href="#" class="link-simples editar_administrador" onclick="editarAdmin(' . $query->id . ')" 
                        id="edita_' . $query->id . '" 
                        data-nome="' . $query->nome . '" 
                        data-email="' . $query->email . '" 
                        data-tipo="' . $query->tipo . '" 
                        data-om_id="' . $query->om_id . '" 
                            data-toggle="modal">
                            <i class="fa fa-edit separaicon " data-toggle="tooltip" data-placement="top" title="Editar Oficial Mobilizador"></i>
                        </a>
                        <a href="#" class="link-simples senha_administrador" onclick="editarSenha(' . $query->id . ')" id="senha_' . $query->id . '" data-id="' . $query->id . '" 
                            data-nome="' . $query->nome . '" 
                
                            data-toggle="modal">
                            <i class="fa fa-lock separaicon " data-toggle="tooltip" data-placement="top" title="Editar Senha "></i>
                        </a>
                       
                        <a href="#" class="link-vermelho remover_administrador" onclick="remover(' . $query->id . ')" id="remover_' . $query->id . '" data-id="' . $query->id . '" 
                            data-nome="' . $query->nome . '" 
                           
                            data-toggle="modal">
                            <i class="fa fa-trash separaicon " data-toggle="tooltip" data-placement="top" title="Remover Usuário "></i>
                        </a>
                    </div>';
        })->make(true);
    }

    public function verificaEmail($acao, Request $resquest)
    {
        //dd($resquest);
        $resultado = User::where('email', $resquest['email'])->first();
        $retorno = "";

        if ($acao == 'cadastro') {
            if ($resultado) {
                $retorno = "O email já encontra-se em nossa base de dados.";
            } else {
                $retorno = "true";
            }
        } elseif ($acao == "recuperar") {
            if ($resultado) {
                $retorno = "true";
            } else {
                $retorno = "O email informado não esta em nossa base de dados";
            }
        } elseif ($acao == 'editar'){
            if ($resultado) {
                if($resultado->id == $resquest['adm_id']){
                    $retorno = 'true';
                } else {
                    $retorno = 'O email já encontra-se em nossa base de dados';
                }
            } else {
                $retorno = 'true';
            }
        }


        return response()->json($retorno);
    }

}
