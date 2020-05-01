<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOmPerguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('om_pergunta', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('om_id')->nullable();
            $table->foreign('om_id')->references('id')->on('oms')->onDelete('cascade');
            $table->integer('pergunta_id')->nullable();
            $table->foreign('pergunta_id')->references('id')->on('perguntas')->onDelete('cascade');
            $table->string('status')->nullable()->default('pendente');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('om_pergunta');
    }
}
