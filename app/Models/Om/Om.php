<?php

namespace App\Models\Om;

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


}
