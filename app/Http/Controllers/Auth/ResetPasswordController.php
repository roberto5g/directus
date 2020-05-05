<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendRecoveryMailUser;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as FormRequest;
use Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{

    public function recuperarSenha(FormRequest $resquest)
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

    public function redefinirSenha(FormRequest $request)
    {

        $user = User::find(auth()->user()->id);


        if ($request['password'] == $request['password_confirmation']) {
            $user->password = bcrypt($request['password']);
            $user->status = 'ativo';
            $user->save();
            $status=1;
        }

        if ($user instanceof Model) {

            Request::session()->flash('sucesso', "Senha editada com sucesso.");
            return back();

        } else {
            Request::session()->flash('erro', "Ocorreu um erro, tente novamente.");

            return back();
        }
    }


}
