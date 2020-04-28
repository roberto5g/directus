<?php

namespace App\Models\Perguntas;


use App\Models\Respostas\Respostas;
use Illuminate\Database\Eloquent\Model;

class Perguntas extends Model
{
    protected
        $table = 'perguntas';

    public $timestamps = false;

    protected
        $fillable = [
        'descricao',
        'anexo',
        'user_id'
    ];


    protected
        $guarded = ['id'];

    public function respostas()
    {
        return $this->hasMany(Respostas::class,'pergunta_id');
    }
}
