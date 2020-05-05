<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('tipo')->default('usuario');
            $table->integer('om_id')->nullable();
            $table->foreign('om_id')->references('id')->on('oms')->onDelete('cascade');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        return User::create([
            'nome' => "ADMINISTRADOR",
            'email' => 'admin@12rm.eb.mil.br',
            'password' => bcrypt(123456),
            'om_id' =>  1,
            'tipo' => 'administrador',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
