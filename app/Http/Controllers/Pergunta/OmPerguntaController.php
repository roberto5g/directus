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

class OmPerguntaController extends Controller
{

    public function lista($id)
    {

        $pergunta_om = Perguntas::where('id',$id)->with('om')->get();
        return response()->json($pergunta_om);

    }

}
