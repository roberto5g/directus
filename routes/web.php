<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/admin/gerencia/verificalogin/{acao}', 'User\UserController@verificaLogin');
Route::get('/admin/gerencia/verificacpf/{acao}', 'User\UserController@verificaCpf');;

Route::get('/{hash}/conta', 'Candidato\DadosBasicosController@ativarConta');
Route::post('/candidato/gerencia/recuperar/senha', 'Auth\ResetPasswordController@recuperarSenha')->name('recuperar.senha');
Route::get('/{hashuser}/recovery/{hashrecovery}', 'Auth\ResetPasswordController@index');
Route::post('/redefinir/senha/usuario', 'Auth\ResetPasswordController@redefinirSenha');


/* rotas autenticadas */
Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index');


    // cadastro om
    Route::get('/admin/gerencia/om', 'Om\OmController@index')->name('om');
    Route::post('/admin/gerencia/cadastro/om', 'Om\OmController@cadastra')->name('cadastro.om');
    Route::get('/admin/gerencia/lista/om', 'Om\OmController@getData');
    Route::get('/admin/gerencia/om/lista', 'Om\OmController@lista');
    Route::get('/admin/gerencia/edita/om/{id}', 'Om\OmController@edita');
    Route::post('/admin/gerencia/edita/om/{id}', 'Om\OmController@update');
    Route::post('/admin/gerencia/remove/om/{id}', 'Om\OmController@remove');


    // usuario
    Route::get('/admin/gerencia/usuario', 'User\UserController@index')->name('usuario');
    Route::get('/admin/gerencia/getdata/usuario', 'User\UserController@getData');
    Route::post('/admin/gerencia/cadastra/usuario', 'User\UserController@cadastra');
    Route::post('/admin/gerencia/edita/usuario/{id}', 'User\UserController@edita');
    Route::post('/admin/gerencia/reseta/usuario/{id}', 'User\UserController@resetaSenha');
    Route::post('/admin/gerencia/updatesenha/usuario', 'User\UserController@updatesenha');
    Route::post('/admin/gerencia/remove/usuario/{id}', 'User\UserController@remove');

    //pergunta
    Route::get('/admin/gerencia/pergunta', 'Pergunta\PerguntaController@index')->name('pergunta');
    Route::post('/admin/gerencia/cadastro/pergunta', 'Pergunta\PerguntaController@cadastra');
    Route::get('/admin/gerencia/edita/pergunta/{id}', 'Pergunta\PerguntaController@edita');
    Route::post('/admin/gerencia/update/pergunta', 'Pergunta\PerguntaController@update');
    Route::get('/admin/gerencia/lista/pergunta/getdata', 'Pergunta\PerguntaController@getData');
    Route::get('/admin/gerencia/lista/perguntas', 'Pergunta\PerguntaController@listaData');
    Route::post('/admin/gerencia/remove/pergunta/{id}', 'Pergunta\PerguntaController@remove');
    Route::post('/admin/gerencia/inativa/pergunta/{id}', 'Pergunta\PerguntaController@inativa');
    Route::get('/admin/gerencia/ativar/pergunta/{id}', 'Pergunta\PerguntaController@ativa');
    Route::get('/admin/detalhes/perguntas/respostas/{id}', 'Pergunta\PerguntaController@detalhes');
    Route::get('/admin/gerencia/lista/pergunta/{id}', 'Pergunta\PerguntaController@lista');


    //respostas
    Route::post('/responde/pergunta/{id}', 'Respostas\RespostasController@cadastra');
    Route::get('/usuario/lista/respostas', 'Respostas\RespostasController@getData');


    //om_perguta
    Route::get('/admin/lista/pergunta/om/{id}', 'Pergunta\OmPerguntaController@lista');

    //relatorios
    Route::get('/admin/gera/relatorio/om/sem/resposta/pergunta', 'Relatorio\RelatorioController@relatorio_om_sem_resposta');
    Route::get('/admin/gera/relatorio/geral/pergunta', 'Relatorio\RelatorioController@relatorio_geral');

});
// Section Pages
Route::view('/errors/400', 'errors.400');
Route::view('/sample/error404', 'errors.404')->name('error404');
Route::view('/sample/error500', 'errors.500')->name('error500');