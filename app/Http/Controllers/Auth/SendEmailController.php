<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendMailUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{

    public function reSendValidacaoEmail()
    {
        $mensagem = '';
        if (Auth::user()->status == "Pendente") {
            $mensagem = "enviando";
            Mail::to(Auth::user()->email)->queue(new SendMailUser(Auth::user()));
        } else {
            $mensagem = 'naoenviando';
        }

        return response()->json($mensagem);
    }

}
