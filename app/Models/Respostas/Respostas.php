<?php

namespace App\Models\Respostas;

use App\Models\Perguntas\Perguntas;
use App\User;
use Illuminate\Database\Eloquent\Model;


class Respostas extends Model
{
    protected
        $table = 'respostas';

    protected
        $fillable = [
        'resposta',
        'user_id',
        'pergunta_id',
    ];

    protected
        $guarded = ['id'];

    public function perguntas()
    {
        return $this->belongsTo(Perguntas::class, 'pegunta_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
