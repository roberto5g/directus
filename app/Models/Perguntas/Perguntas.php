<?php

namespace App\Models\Perguntas;


use App\Models\Om\Om;
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
        'user_id',
        'status',
    ];


    protected
        $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function om()
    {
        return $this->belongsToMany(Om::class,'om_pergunta','pergunta_id','om_id')
            ->select(['om_id','nome','status']);
    }

    public function respostas()
    {
        return $this->hasMany(Respostas::class,'pergunta_id');
    }
}
