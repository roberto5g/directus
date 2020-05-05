<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Om\Om;

class CreateOmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->string('sigla',30);
            $table->timestamps();
        });

        return Om::create([
            'nome' => 'ADMINISTRADOR 12ªRM',
            'sigla' => 'ADMINISTRADOR 12ªRM',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oms');
    }
}
