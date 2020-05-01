<?php

namespace App\Models\Perguntas;


use App\Models\Respostas\Respostas;
use App\User;
use Illuminate\Database\Eloquent\Model;

class OmPergunta extends Model
{
    protected
        $table = 'om_pergunta';

    protected
        $fillable = [
        'om_id',
        'pergunta_id',
        'status',
    ];

    public $timestamps = false;

    protected
        $guarded = ['id'];


}
