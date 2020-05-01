<?php

namespace App\Models\Om;

use App\Models\Perguntas\OmPergunta;
use App\Models\Perguntas\Perguntas;
use App\User;
use Illuminate\Database\Eloquent\Model;


class Om extends Model
{
    protected
        $table = 'oms';

    protected
        $fillable = ['nome','sigla'];

    protected
        $guarded = ['id'];

    public function pergunta(){
        return $this->belongsToMany(Perguntas::class,'om_pergunta','om_id','pergunta_id');
    }

}
