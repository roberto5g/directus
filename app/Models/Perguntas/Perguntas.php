<?php

namespace App\Models\Perguntas;


use App\Models\Respostas\Respostas;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Perguntas extends Model
{
    protected
        $table = 'perguntas';

    protected
        $fillable = [
        'descricao',
        'anexo',
        'user_id'
    ];


    protected
        $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function respostas()
    {
        return $this->hasMany(Respostas::class,'pergunta_id');
    }
}
