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
Route::get('/admin/gerencia/verificaemail/{acao}', 'Candidato\DadosBasicosController@verificaEmail');
Route::get('/admin/gerencia/verificacpf/{acao}', 'Candidato\DadosBasicosController@verificaCpf');;

Route::get('/{hash}/conta', 'Candidato\DadosBasicosController@ativarConta');
Route::post('/candidato/gerencia/recuperar/senha', 'Auth\ResetPasswordController@recuperarSenha')->name('recuperar.senha');
Route::get('/{hashuser}/recovery/{hashrecovery}', 'Auth\ResetPasswordController@index');
Route::post('/redefinir/senha/usuario', 'Auth\ResetPasswordController@redefinirSenha');


/* rotas autenticadas */
Route::middleware('auth')->group(function() {

    Route::get('/', 'HomeController@index');

    // envio de email
    Route::get('/candidato/reenviar/email/validacao', 'Auth\SendEmailController@reSendValidacaoEmail');

    // cadastro de administradores
    Route::get('/admin/gerencia/administradores', 'Admin\AdministradorController@index')->name('gerencia.administradores');
    Route::post('/admin/gerencia/cadastros/administrador', 'Admin\AdministradorController@cadastra');
    Route::get('/admin/gerencia/lista/administrador', 'Admin\AdministradorController@getdata');

    // cadastro região
    Route::get('/admin/gerencia/regiao', 'Admin\Regiao\RegiaoMilitarController@index')->name('gerencia.regiao');
    Route::get('/admin/gerencia/lista/regiao', 'Admin\Regiao\RegiaoMilitarController@getdata');
    Route::get('/admin/gerencia/lista/regioes', 'Admin\Regiao\RegiaoMilitarController@lista');
    Route::post('/admin/gerencia/cadastro/regiao', 'Admin\Regiao\RegiaoMilitarController@cadastra');
    Route::post('/admin/gerencia/edita/regiao/{id}', 'Admin\Regiao\RegiaoMilitarController@edita');
    Route::post('/admin/gerencia/remove/regiao/{id}', 'Admin\Regiao\RegiaoMilitarController@remove');

    // cadastro om
    Route::get('/admin/gerencia/om', 'Admin\Om\OmController@index')->name('gerencia.om');
    Route::post('/admin/gerencia/cadastro/om', 'Admin\Om\OmController@cadastra')->name('cadastro.om');
    Route::get('/admin/gerencia/lista/om', 'Admin\Om\OmController@getdata');
    Route::post('/admin/gerencia/edita/om/{id}', 'Admin\Om\OmController@edita');
    Route::post('/admin/gerencia/remove/om/{id}', 'Admin\Om\OmController@remove');
    Route::get('/admin/gerencia/lista/oms', 'Admin\Om\OmController@lista');
    Route::get('/admin/lista/estados', 'Admin\Estado\EstadoController@index');
    Route::get('/admin/lista/paises', 'Admin\Paises\PaisesController@index');

    // cidades
    Route::get('/admin/lista/estado/cidades/{id}', 'Admin\Cidade\CidadeController@lista');
    Route::get('/admin/lista/cidade/estado/{id}', 'Admin\Cidade\CidadeController@cidade_estado');

    //rotas para estado e cidades
    Route::get('/estado/cidade/{estado_id}', 'Localizacao\EstadoController@cidades')->name('estado.cidades');

    //rota dados basicos candidato
    Route::post('/candidato/cadastros/dados/basicos', 'Candidato\DadosBasicosController@cadastra')->name('cadastro.dados_basicos');
    Route::post('/candidato/gerencia/cadastros/dados/complementares', 'Candidato\DadosComplementaresController@cadastra')->name('cadastro.dados_complementares');
    Route::post('/candidato/gerencia/cadastros/dados/contato', 'Candidato\DadosContatoController@cadastra')->name('cadastro.dados_contato');
    Route::get('/candidato/gerencia/perfil', 'Candidato\CandidatoPerfilController@index')->name('candidato.perfil');
    Route::post('/candidato/gerencia/perfil', 'Candidato\CandidatoPerfilController@perfil');
    Route::get('/candidato/gerencia/curriculo', 'Candidato\CurriculoCandidatoController@index')->name('candidato.curriculo');
    Route::post('/candidato/gerencia/cadastra/foto', 'Candidato\FotoCandidatoController@cadastra');
    Route::post('/candidato/gerencia/editar/foto', 'Candidato\FotoCandidatoController@editar');
    Route::post('/candidato/gerencia/remover/foto', 'Candidato\FotoCandidatoController@remover');


    //rotas para Grau de formação academica
    Route::get('/admin/gerencia/grau/formacao/academica', 'Admin\Parametro\GrauFormacaoAcademicaController@index');
    Route::get('/admin/gerencia/lista/grau/formacao/academicas', 'Admin\Parametro\GrauFormacaoAcademicaController@lista');
    Route::get('/admin/gerencia/lista/grau/formacao/academicas/{id}', 'Admin\Parametro\GrauFormacaoAcademicaController@listaNivel');
/*    Route::get('/admin/gerencia/retorna/grau/formacao/academicas/{id}', 'Admin\Parametro\GrauFormacaoAcademicaController@retorna');*/
    Route::get('/admin/gerencia/lista/grau/formacao/academica', 'Admin\Parametro\GrauFormacaoAcademicaController@getData');
    Route::post('/admin/gerencia/cadastra/grau/formacao/academica', 'Admin\Parametro\GrauFormacaoAcademicaController@cadastra');

    //rota para area de atuação
    Route::get('/admin/gerencia/area/atuacao', 'Admin\Parametro\AreaAtuacaoController@index');
    Route::post('/admin/gerencia/cadastra/area/atuacao', 'Admin\Parametro\AreaAtuacaoController@cadastra');
    Route::get('/admin/gerencia/lista/area/atuacao', 'Admin\Parametro\AreaAtuacaoController@getData');
    Route::get('/admin/gerencia/lista/area/atuacao/{id}', 'Admin\Parametro\AreaAtuacaoController@lista');
    Route::get('/admin/gerencia/verifica/area/atuacao/conselho/{id}', 'Admin\Parametro\AreaAtuacaoController@areaConselho');

    //rotas para conselhos
    Route::get('/admin/gerencia/conselhos/atuacao', 'Admin\Parametro\ConselhosController@index');
    Route::get('/admin/gerencia/lista/conselhos', 'Admin\Parametro\ConselhosController@getData');
   /* Route::post('/admin/cadastros/area', 'AreaAtuacao\AreaAtuacaoController@cadastra');
    Route::post('/admin/cadastros/edita/area/{id}', 'AreaAtuacao\AreaAtuacaoController@edita');
    Route::get('/admin/cadastros/remove/area/{id}', 'AreaAtuacao\AreaAtuacaoController@remove');
    Route::get('/admin/cadastros/detalhe/area/{id}', 'AreaAtuacao\AreaAtuacaoController@detalheAreaAtuacao');
    Route::get('/admin/cadastros/edita/area/{id}', 'AreaAtuacao\AreaAtuacaoController@editaAreaAtuacao');
    Route::get('/admin/ajaxdata/area', 'AreaAtuacao\AreaAtuacaoController@getdata')->name('ajaxdata.area_atuacao');*/


    //rota para candidato processo
    Route::post('/candidato/cadastros/candidato/processo', 'Candidato\CandidatoProcessoController@cadastra');
    Route::get('/candidato/lista/candidato/processo/{hash}', 'Candidato\CandidatoProcessoController@lista');
    Route::get('/candidato/lista/curriculo/candidato', 'Candidato\CandidatoProcessoController@getData');


    //rota para formação academica candidato
    Route::get('/candidato/gerencia/lista/formacoes/inscricao/candidato/{hash}', 'Candidato\Inscricao\Formacao\CandidatoFormacaoController@getData');
    Route::get('/candidato/gerencia/formacoes/inscricao/candidato/{hash}', 'Candidato\Inscricao\Formacao\CandidatoFormacaoController@formacoes');
    Route::post('/candidato/gerencia/cadastra/formacoes/inscricao/candidato', 'Candidato\Inscricao\Formacao\CandidatoFormacaoController@cadastra');

//rotas tipo experiencia profissional
    Route::get('/admin/cadastros/tipo/experiencia/profissional', 'Admin\Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@index')->name('tipo.experiencia_profissional');
    Route::post('/admin/cadastros/tipo/experiencia/profissional', 'Admin\Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@cadastra');
    Route::get('/admin/ajaxdata/tipo/experiencia/profissional', 'Admin\Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@getdata')->name('ajaxdata.tipo_experiencia_profissional');
    Route::get('/admin/ajaxdata/lista/tipo/experiencia/profissional', 'Admin\Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@lista');


//rotas duração cursos
    Route::get('/admin/cadastros/duracao/cursos', 'Admin\DuracaoCursos\DuracaoCursosController@index');
    Route::get('/admin/ajaxdata/duracao/cursos', 'Admin\DuracaoCursos\DuracaoCursosController@getdata');
    Route::get('/admin/cadastros/lista/duracao/cursos', 'Admin\DuracaoCursos\DuracaoCursosController@lista');
    Route::post('/admin/cadastros/duracao/cursos', 'Admin\DuracaoCursos\DuracaoCursosController@cadastra');
    Route::post('/admin/cadastros/edita/duracao/cursos/{id}', 'Admin\DuracaoCursos\DuracaoCursosController@edita');
    Route::get('/admin/cadastros/remove/duracao/cursos/{id}', 'Admin\DuracaoCursos\DuracaoCursosController@remove');


    Route::post('/admin/cadastros/edita/tipo/experiencia/profissional/{id}', 'Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@edita');
    Route::get('/admin/cadastros/remove/tipo/experiencia/profissional/{id}', 'Tipo\ExperienciaProfissional\TipoExperienciaProfissionalController@remove');


//rotas para processo seletivo
    Route::get('/admin/cadastro/processos/seletivos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@index')->name('processo.basico');
    Route::get('/admin/gerencia/lista/processos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@lista');
    Route::get('/admin/gerencia/lista/area/processo/{id}', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@listaAreasProcesso');
    Route::get('/admin/cadastro/processos/seletivos/parametros', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@parametros')->name('processo.parametros');
    Route::post('/admin/cadastra/processos/seletivos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@cadastra');
    Route::post('/admin/cadastra/inicial/processos/seletivos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@cadastroInicial');
    Route::get('/admin/processos/seletivos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@getData');

    Route::get('/candidato/processos/seletivos', 'Admin\ProcessoSeletivo\ProcessoSeletivoController@disponiveis')->name('processos.seletivos.disponiveis');



//rotas para nivel formações
    Route::get('/admin/gerencia/lista/nivel/formacao', 'Admin\Parametro\NivelFormacoesController@lista');

























    //rotas para avaliação
    Route::get('/admin/avaliacao/curricular', 'Avaliacao\AvaliacaoCurricularController@index')->name('avaliacao.curricular');
    Route::get('/admin/avaliacao/fisica', 'Avaliacao\AvaliacaoFisicaController@index')->name('avaliacao.fisica');
    Route::get('/admin/avaliacao/pratica', 'Avaliacao\AvaliacaoPraticaController@index')->name('avaliacao.pratica');

    //rotas para avisos de convocação
    Route::get('/admin/avisos/cet', 'Avisos\AvisoCetController@index')->name('aviso.cet');
    Route::get('/admin/avisos/stt_ott', 'Avisos\AvisoSttOttController@index')->name('aviso.stt_ott');
    Route::get('/admin/avisos/mfdv', 'Avisos\AvisoMfdvController@index')->name('aviso.mfdv');

    //rotas financeiro
    Route::get('/admin/financeiro/controlefinanceirogru', 'Financeiro\ControleFinanceiroGRUController@index')->name('financeiro.controlefinanceirogru');
    Route::get('/admin/financeiro/pagamento', 'Financeiro\PagamentoController@index')->name('financeiro.pagamento');
    Route::get('/admin/financeiro/unidadefavorecida', 'Financeiro\UnidadeFavorecidaController@index')->name('financeiro.unidadefavorecida');




    //rotas tipo diploma
    Route::get('/admin/cadastros/tipo/diploma', 'Tipo\Diploma\TipoDiplomaController@index')->name('tipo.diploma');
    Route::post('/admin/cadastros/tipo/diploma', 'Tipo\Diploma\TipoDiplomaController@cadastra');
    Route::post('/admin/cadastros/edita/tipo/diploma/{id}', 'Tipo\Diploma\TipoDiplomaController@edita');
    Route::get('/admin/cadastros/remove/tipo/diploma/{id}', 'Tipo\Diploma\TipoDiplomaController@remove');
    Route::get('/admin/ajaxdata/tipo/diploma', 'Tipo\Diploma\TipoDiplomaController@getdata')->name('ajaxdata.tipo_diploma');


    //rotas tipo documento militar
    Route::get('/admin/cadastros/tipo/documento/militar', 'Tipo\DocumentoMilitar\TipoDocumentoMilitarController@index')->name('tipo.documento_militar');
    Route::post('/admin/cadastros/tipo/documento/militar', 'Tipo\DocumentoMilitar\TipoDocumentoMilitarController@cadastra');
    Route::post('/admin/cadastros/edita/tipo/documento/militar/{id}', 'Tipo\DocumentoMilitar\TipoDocumentoMilitarController@edita');
    Route::get('/admin/cadastros/remove/tipo/documento/militar/{id}', 'Tipo\DocumentoMilitar\TipoDocumentoMilitarController@remove');
    Route::get('/admin/ajaxdata/tipo/documento/militar', 'Tipo\DocumentoMilitar\TipoDocumentoMilitarController@getdata')->name('ajaxdata.tipo_documento_militar');





    //rotas tipo publicacao
    Route::get('/admin/cadastros/tipo/publicacao', 'Tipo\Publicacao\TipoPublicacaoController@index')->name('tipo.publicacao');
    Route::post('/admin/cadastros/tipo/publicacao', 'Tipo\Publicacao\TipoPublicacaoController@cadastra');
    Route::post('/admin/cadastros/edita/tipo/publicacao/{id}', 'Tipo\Publicacao\TipoPublicacaoController@edita');
    Route::get('/admin/cadastros/remove/tipo/publicacao/{id}', 'Tipo\Publicacao\TipoPublicacaoController@remove');
    Route::get('/admin/ajaxdata/tipo/publicacao', 'Tipo\Publicacao\TipoPublicacaoController@getdata')->name('ajaxdata.tipo_publicacao');


    //rotas para manutenção
    Route::get('/admin/manutencao/candidato', 'Manutencao\ManutencaoController@index');
    Route::get('/admin/ajaxdata/manutencao', 'Manutencao\ManutencaoController@getdata')->name('ajaxdata.manutencao');
    Route::post('/admin/manutencao/edita/email/candidato/{id}', 'Manutencao\ManutencaoController@edita');

    //rotas para relatórios
    Route::get('/admin/relatorio/candidato', 'Relatorio\RelatorioController@lista');
    Route::get('/admin/relatorio/candidato/area', 'Relatorio\RelatorioController@porArea')->name('relatorio.por_area');
    Route::get('/admin/relatorio/ajaxdata/candidato/areas/{id}', 'Relatorio\RelatorioController@getArea')->name('relatorio.get_area');
    Route::get('/admin/relatorio/ajaxdata/pesquisa/candidato/areas', 'Relatorio\RelatorioController@pesquisa')->name('relatorio.pesquisa');
    Route::get('ajaxdata/getdata', 'Relatorio\RelatorioController@getdata')->name('ajaxdata.getdata');
    Route::get('/admin/gera/relatorio/inicial/candidato/area', 'Relatorio\RelatorioController@relatorio_inicial')->name('relatorio.gera_relatorio_inicial');
    Route::get('/admin/gera/relatorio/ssmr/candidato/area', 'Relatorio\RelatorioController@relatorio_geral')->name('relatorio.gera_relatorio_ssmr');
    Route::get('/relatorio','Relatorio\RelatorioController@teste');


    //rotas para pessoa
    Route::get('/admin/pessoa/{id}', 'Pessoa\PessoaController@detalhes');
    Route::post('/admin/pesquisa/pessoa/','Pessoa\PessoaController@pesquisa')->name('pessoa.pesquisa');


    //rotas para as guarnições
    Route::get('/admin/cadastros/guarnicao', 'Guarnicao\GuarnicaoController@index');
    Route::get('/admin/ajaxdata/guarnicao/lista', 'Guarnicao\GuarnicaoController@lista');
    Route::get('/admin/ajaxdata/guarnicao', 'Guarnicao\GuarnicaoController@getdata')->name('ajaxdata.guarnicao');
    Route::post('/admin/cadastros/guarnicao', 'Guarnicao\GuarnicaoController@cadastra');
    Route::post('/admin/cadastros/edita/guarnicao/{id}', 'Guarnicao\GuarnicaoController@edita');
    Route::get('/admin/cadastros/remove/guarnicao/{id}', 'Guarnicao\GuarnicaoController@remove');


    //rotas para conversão de notas
    Route::get('/admin/conversao/notas', 'ConversaoNotas\ConversaoNotasController@index');


    //rotas para entrevista candidatos
    Route::get('/admin/entrevista/candidato', 'EntrevistaCandidato\EntrevistaCandidatoController@index');

    // Section CoreUI elements
    Route::view('/sample/dashboard', 'samples.dashboard');
    Route::view('/sample/buttons', 'samples.buttons');
    Route::view('/sample/social', 'samples.social');
    Route::view('/sample/cards', 'samples.cards');
    Route::view('/sample/forms', 'samples.forms');
    Route::view('/sample/modals', 'samples.modals');
    Route::view('/sample/switches', 'samples.switches');
    Route::view('/sample/tables', 'samples.tables');
    Route::view('/sample/tabs', 'samples.tabs');
    Route::view('/sample/icons-font-awesome', 'samples.font-awesome-icons');
    Route::view('/sample/icons-simple-line', 'samples.simple-line-icons');
    Route::view('/sample/widgets', 'samples.widgets');
    Route::view('/sample/charts', 'samples.charts');


    //rotas para Candidato
    Route::get('/admin/status/candidato/','Candidato\CandidatoController@index')->name('candidato.status.index');
    //Route::get('/admin/ajaxdata/status', 'Candidato\CandidatoController@getdata')->name('ajaxdata.status');
    Route::post('/admin/status/edita/candidato/{id}', 'Candidato\CandidatoController@edita');
});
// Section Pages
Route::view('/sample/error404','errors.404')->name('error404');
Route::view('/sample/error500','errors.500')->name('error500');