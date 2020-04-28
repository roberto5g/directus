<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendRecoveryMailUser;
use App\Models\HashRecuperaSenha;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{

    public function index($hashuser, $hashrecovery)
    {
        $user = User::where('hash', $hashuser)->first();

        $hash_recupera_senha = HashRecuperaSenha::where('user_id', $user->id)->first();

        if($hash_recupera_senha){
            if ($hash_recupera_senha->hash == $hashrecovery) {
                return view('candidato.home.recovery.nova_senha_candidato', compact('user', 'hashrecovery'));
            } else {
                return view('candidato.home.recovery.erro');
            }
        } else {
            return view('candidato.home.recovery.erro');
        }

    }


    public function recuperarSenha(Request $resquest)
    {
        $user = User::where('cpf', limpaCPF($resquest['cpf']))->first();

        if ($user->email == strtolower($resquest['email'])) {

            $hashs_user = HashRecuperaSenha::where('user_id', $user->id)->get();

            if ($hashs_user) {
                foreach ($hashs_user as $hash) {
                    $hash->delete();
                }
            }

            $hash = HashRecuperaSenha::create(['hash' => str_random(128), 'user_id' => $user->id]);

            Mail::to($user->email)->queue(new SendRecoveryMailUser($user));

            return response()->json(str_random(128));

        } else {
            return response()->json(false);
        }
    }

    public function redefinirSenha(Request $request)
    {

        $user = User::where('hash', $request['hashsuer'])->first();

        $hash_recupera_senha = HashRecuperaSenha::where('user_id', $user->id)->first();

        if ($hash_recupera_senha->hash == $request['hash']) {
            if ($request['password'] == $request['password_confirmation']) {
                $user->password = bcrypt($request['password']);
                $user->save();
                $hash_recupera_senha->delete();
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        } else {
            return response()->json(false);
        }

    }

}
