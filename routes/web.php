<?php

use Illuminate\Support\Facades\Route;
use App\Models\Unidades;
use App\Models\Mural;
use App\Models\Destaques;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $unidades  = Unidades::all();
    $und_Princ = Unidades::where('id', 1)->get();
    $unidade   =  $und_Princ;
    $murais    = Mural::where('unidade_id', 1)->where('status', 1)->get();
    $destaques = Destaques::where('unidade_id', 1)->where('status', 1)->get();
    $destaqueQtd = 0;
    return view('welcome', compact('unidades', 'murais', 'destaques', 'unidade', 'destaqueQtd'));
});

//Portal Assinaturas
Route::get('/portal_assinaturas', [App\Http\Controllers\HomeController::class, 'showPA'])->name('showPA');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\UserController::class, 'telaLoginIndicador'])->name('telaLoginIndicador');
Route::post('/admin', [App\Http\Controllers\UserController::class, 'Login'])->name('Login');
Route::get('auth/register', [App\Http\Controllers\UserController::class, 'telaRegistro'])->name('telaRegistro');
Route::post('auth/register', [App\Http\Controllers\UserController::class, 'store'])->name('store');
Route::get('auth/passwords/email', [App\Http\Controllers\UserController::class, 'telaEmail'])->name('telaEmail');
Route::post('auth/passwords/email', [App\Http\Controllers\UserController::class, 'emailReset'])->name('emailReset');
Route::get('auth/passwords/reset', [App\Http\Controllers\UserController::class, 'telaReset'])->name('telaReset');
Route::post('auth/passwords/reset', [App\Http\Controllers\UserController::class, 'resetarSenha'])->name('resetarSenha');

//HOME
Route::get('/hcpgestao', [App\Http\Controllers\HomeController::class, 'oquee'])->name('oquee');
Route::get('/unidade/{id}', [App\Http\Controllers\HomeController::class, 'unidade'])->name('unidade');
Route::post('/veiculo/{id}', [App\Http\Controllers\ControleVeiculosController::class, 'storeVeiculo'])->name('storeVeiculo');
Route::get('/destaques_detalhes/{id}/{id_d}', [App\Http\Controllers\HomeController::class, 'destaquesDetalhes'])->name('destaquesDetalhes');
Route::get('/murais_detalhes/{id}', [App\Http\Controllers\HomeController::class, 'muraisDetalhes'])->name('muraisDetalhes');
Route::get('/acesso_rapido/{id}', [App\Http\Controllers\HomeController::class, 'acessoRapido'])->name('acessoRapido');
Route::post('/unidade/{id}', [App\Http\Controllers\HomeController::class, 'enviarEmail'])->name('enviarEmail');
Route::get('/cardapio/{id}', [App\Http\Controllers\HomeController::class, 'cardapio'])->name('cardapio');
Route::post('/cardapio/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'questCardapio'])->name('questCardapio');
Route::get('/admin/indicador', [App\Http\Controllers\UserController::class, 'telaLoginIndicador'])->name('telaLoginIndicador');
Route::get('/acesso_rapido/3/ramais_unidade/{id}', [App\Http\Controllers\RamaisController::class, 'ramaisUnidade'])->name('ramaisUnidade');
Route::post('/acesso_rapido/3/ramais_unidade/{id}', [App\Http\Controllers\RamaisController::class, 'pesqRamaisUnidade'])->name('pesqRamaisUnidade');
Route::get('/acesso_rapido/3/emails_unidade/{id}', [App\Http\Controllers\EmailsController::class, 'emailsUnidade'])->name('emailsUnidade');
Route::post('/acesso_rapido/3/emails_unidade/{id}', [App\Http\Controllers\EmailsController::class, 'pesqEmailsUnidade'])->name('pesqEmailsUnidade');
Route::get('/acesso_rapido/documentos/{id}', [App\Http\Controllers\HomeController::class, 'documentosUnidades'])->name('documentosUnidades');
Route::get('/acesso_rapido/documentos/{id}/{id_u}/{id_s}', [App\Http\Controllers\HomeController::class, 'documentosQualidade'])->name('documentosQualidade');
Route::get('/acesso_rapido/documentos_setores/{id}/{id_u}', [App\Http\Controllers\HomeController::class, 'documentosSetores'])->name('documentosSetores');
Route::get('/area_colaborador', [App\Http\Controllers\HomeController::class, 'areaColaborador'])->name('areaColaborador');
Route::get('/avaliacao_experiencia', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'avaliacaoExp'])->name('avaliacaoExp');
Route::post('/avaliacao_experiencia', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'avaliacaoExpStore'])->name('avaliacaoExpStore');
Route::get('/ouvidoria_rh', [App\Http\Controllers\HomeController::class, 'ouvidoriaRhSend'])->name('ouvidoriaRhSend');
Route::post('/ouvidoria_rh', [App\Http\Controllers\HomeController::class, 'ouvidoriaRhSend'])->name('ouvidoriaRhSend');
Route::get('/ocorrencia', [App\Http\Controllers\HomeController::class, 'ocorrencia'])->name('ocorrencia');
Route::post('/ocorrencia_enviar', [App\Http\Controllers\HomeController::class, 'storeOcorrencia'])->name('storeOcorrencia');
Route::get('/educacao_permanente', [App\Http\Controllers\HomeController::class, 'educacaoPermanente'])->name('educacaoPermanente');
Route::get('/educacao_permanente/quiz', [App\Http\Controllers\HomeController::class, 'educacaoPermanenteQuiz'])->name('educacaoPermanenteQuiz');
Route::post('/educacao_permanente/quiz/{id}', [App\Http\Controllers\HomeController::class, 'questEducacaoP'])->name('questEducacaoP');
Route::get('/educacao_permanente/documentos', [App\Http\Controllers\HomeController::class, 'educacaoPermanenteDocumentos'])->name('educacaoPermanenteDocumentos');
Route::get('/educacao_permanente/videos', [App\Http\Controllers\HomeController::class, 'educacaoPermanenteVideos'])->name('educacaoPermanenteVideos');
Route::get('/indicador_acidente/informacao', [App\Http\Controllers\IndicadorAcidenteController::class, 'indicadorAcidenteInfo'])->name('indicadorAcidenteInfo');
Route::get('/indicador_acidente', [App\Http\Controllers\IndicadorAcidenteController::class, 'indicadorAcidente'])->name('indicadorAcidente');
Route::post('/indicador_acidente', [App\Http\Controllers\IndicadorAcidenteController::class, 'indicadorAcidenteStore'])->name('indicadorAcidenteStore');
////

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Usuários
    Route::get('/cadastro_usuarios/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
    Route::get('/cadastro_usuarios', [App\Http\Controllers\UserController::class, 'cadastroUsuarios'])->name('cadastroUsuarios');
    Route::get('/pesquisar_usuarios', [App\Http\Controllers\UserController::class, 'pesquisarUsuarios'])->name('pesquisarUsuarios');
    Route::post('/pesquisar_usuarios', [App\Http\Controllers\UserController::class, 'pesquisarUsuarios'])->name('pesquisarUsuarios');
    Route::get('/cadastro_usuarios_novo', [App\Http\Controllers\UserController::class, 'usuariosNovo'])->name('usuariosNovo');
    Route::post('/cadastro_usuarios_novo', [App\Http\Controllers\UserController::class, 'storeUsuarios'])->name('storeUsuarios');
    Route::get('/cadastro_usuarios/alterar_usuarios/{id}', [App\Http\Controllers\UserController::class, 'usuariosAlterar'])->name('usuariosAlterar');
    Route::post('/cadastro_usuarios/alterar_usuarios/{id}', [App\Http\Controllers\UserController::class, 'alterarUsuarios'])->name('alterarUsuarios');
    Route::get('/cadastro_usuarios/excluir_usuarios/{id}', [App\Http\Controllers\UserController::class, 'usuariosExcluir'])->name('usuariosExcluir');
    Route::post('/cadastro_usuarios/excluir_usuarios/{id}', [App\Http\Controllers\UserController::class, 'deleteUsuario'])->name('deleteUsuario');
    ////

    //PerfilUsuários
    Route::get('/cadastro_perfil_usuarios', [App\Http\Controllers\PerfilUserController::class, 'cadastroPerfilUsuarios'])->name('cadastroPerfilUsuarios');
    Route::get('/pesquisar_perfil_usuarios', [App\Http\Controllers\PerfilUserController::class, 'pesquisarPerfilUsuarios'])->name('pesquisarPerfilUsuarios');
    Route::post('/pesquisar_perfil_usuarios', [App\Http\Controllers\PerfilUserController::class, 'pesquisarPerfilUsuarios'])->name('pesquisarPerfilUsuarios');
    Route::get('/cadastro_perfil_usuarios_novo', [App\Http\Controllers\PerfilUserController::class, 'usuariosPerfilNovo'])->name('usuariosPerfilNovo');
    Route::post('/cadastro_perfil_usuarios_novo', [App\Http\Controllers\PerfilUserController::class, 'storePerfilUsuarios'])->name('storePerfilUsuarios');
    Route::get('/cadastro_perfil_usuarios/alterar_perfil_usuarios/{id}', [App\Http\Controllers\PerfilUserController::class, 'usuariosPerfilAlterar'])->name('usuariosPerfilAlterar');
    Route::post('/cadastro_perfil_usuarios/alterar_perfil_usuarios/{id}', [App\Http\Controllers\PerfilUserController::class, 'updatePerfilUsuarios'])->name('updatePerfilUsuarios');
    Route::get('/cadastro_perfil_usuarios/excluir_perfil_usuarios/{id}', [App\Http\Controllers\PerfilUserController::class, 'usuariosPerfilExcluir'])->name('usuariosPerfilExcluir');
    Route::post('/cadastro_perfil_usuarios/excluir_perfil_usuarios/{id}', [App\Http\Controllers\PerfilUserController::class, 'destroyPerfilUsuarios'])->name('destroyPerfilUsuarios');
    ////

    //Unidades
    Route::get('/cadastro_unidades', [App\Http\Controllers\UnidadesController::class, 'cadastroUnidade'])->name('cadastroUnidade');
    Route::get('/pesquisar_unidades', [App\Http\Controllers\UnidadesController::class, 'pesquisarUnidade'])->name('pesquisarUnidade');
    Route::post('/pesquisar_unidades', [App\Http\Controllers\UnidadesController::class, 'pesquisarUnidade'])->name('pesquisarUnidade');
    Route::get('/cadastro_unidades_novo', [App\Http\Controllers\UnidadesController::class, 'unidadeNovo'])->name('unidadeNovo');
    Route::post('/cadastro_unidades_novo', [App\Http\Controllers\UnidadesController::class, 'storeUnidade'])->name('storeUnidade');
    Route::get('/cadastro_unidades/alterar_unidade/{id}', [App\Http\Controllers\UnidadesController::class, 'unidadeAlterar'])->name('unidadeAlterar');
    Route::post('/cadastro_unidades/alterar_unidade/{id}', [App\Http\Controllers\UnidadesController::class, 'updateUnidade'])->name('updateUnidade');
    Route::get('/cadastro_unidades/excluir_unidade/{id}', [App\Http\Controllers\UnidadesController::class, 'unidadeExcluir'])->name('unidadeExcluir');
    Route::post('/cadastro_unidades/excluir_unidade/{id}', [App\Http\Controllers\UnidadesController::class, 'destroyUnidade'])->name('destroyUnidade');
    ////

    //Mural
    Route::get('/cadastro_mural', [App\Http\Controllers\MuralController::class, 'cadastroMural'])->name('cadastroMural');
    Route::get('/pesquisar_mural', [App\Http\Controllers\MuralController::class, 'pesquisarMural'])->name('pesquisarMural');
    Route::post('/pesquisar_mural', [App\Http\Controllers\MuralController::class, 'pesquisarMural'])->name('pesquisarMural');
    Route::get('/cadastro_mural_novo', [App\Http\Controllers\MuralController::class, 'muralNovo'])->name('muralNovo');
    Route::post('/cadastro_mural_novo', [App\Http\Controllers\MuralController::class, 'storeMural'])->name('storeMural');
    Route::get('/cadastro_mural/alterar_mural/{id}', [App\Http\Controllers\MuralController::class, 'muralAlterar'])->name('muralAlterar');
    Route::post('/cadastro_mural/alterar_mural/{id}', [App\Http\Controllers\MuralController::class, 'updateMural'])->name('updateMural');
    Route::get('/cadastro_mural/excluir_mural/{id}', [App\Http\Controllers\MuralController::class, 'muralExcluir'])->name('muralExcluir');
    Route::post('/cadastro_mural/excluir_mural/{id}', [App\Http\Controllers\MuralController::class, 'destroyMural'])->name('destroyMural');
    ////

    //Destaques
    Route::get('/cadastro_destaques', [App\Http\Controllers\DestaquesController::class, 'cadastroDestaques'])->name('cadastroDestaques');
    Route::get('/pesquisar_destaques', [App\Http\Controllers\DestaquesController::class, 'pesquisarDestaques'])->name('pesquisarDestaques');
    Route::post('/pesquisar_destaques', [App\Http\Controllers\DestaquesController::class, 'pesquisarDestaques'])->name('pesquisarDestaques');
    Route::get('/cadastro_destaques_novo', [App\Http\Controllers\DestaquesController::class, 'destaquesNovo'])->name('destaquesNovo');
    Route::post('/cadastro_destaques_novo', [App\Http\Controllers\DestaquesController::class, 'storeDestaques'])->name('storeDestaques');
    Route::get('/cadastro_destaques/alterar_destaques/{id}', [App\Http\Controllers\DestaquesController::class, 'destaquesAlterar'])->name('destaquesAlterar');
    Route::post('/cadastro_destaques/alterar_destaques/{id}', [App\Http\Controllers\DestaquesController::class, 'updateDestaques'])->name('updateDestaques');
    Route::get('/cadastro_destaques/excluir_destaques/{id}', [App\Http\Controllers\DestaquesController::class, 'destaquesExcluir'])->name('destaquesExcluir');
    Route::post('/cadastro_destaques/excluir_destaques/{id}', [App\Http\Controllers\DestaquesController::class, 'destroyDestaques'])->name('destroyDestaques');
    ////

    //PoliticasNormas
    Route::get('/cadastro_politicas', [App\Http\Controllers\PoliticasNormasController::class, 'cadastroPoliticas'])->name('cadastroPoliticas');
    Route::get('/pesquisar_politicas', [App\Http\Controllers\PoliticasNormasController::class, 'pesquisarPoliticas'])->name('pesquisarPoliticas');
    Route::post('/pesquisar_politicas', [App\Http\Controllers\PoliticasNormasController::class, 'pesquisarPoliticas'])->name('pesquisarPoliticas');
    Route::get('/cadastro_politicas_novo', [App\Http\Controllers\PoliticasNormasController::class, 'politicasNovo'])->name('politicasNovo');
    Route::post('/cadastro_politicas_novo', [App\Http\Controllers\PoliticasNormasController::class, 'storePoliticas'])->name('storePoliticas');
    Route::get('/cadastro_politicas/alterar_politicas/{id}', [App\Http\Controllers\PoliticasNormasController::class, 'politicasAlterar'])->name('politicasAlterar');
    Route::post('/cadastro_politicas/alterar_politicas/{id}', [App\Http\Controllers\PoliticasNormasController::class, 'updatePoliticas'])->name('updatePoliticas');
    Route::get('/cadastro_politicas/excluir_politicas/{id}', [App\Http\Controllers\PoliticasNormasController::class, 'politicasExcluir'])->name('politicasExcluir');
    Route::post('/cadastro_politicas/excluir_politicas/{id}', [App\Http\Controllers\PoliticasNormasController::class, 'destroyPoliticas'])->name('destroyPoliticas');
    ////

    //Setores
    Route::get('/cadastro_setores', [App\Http\Controllers\SetoresController::class, 'cadastroSetores'])->name('cadastroSetores');
    Route::get('/pesquisar_setores', [App\Http\Controllers\SetoresController::class, 'pesquisarSetores'])->name('pesquisarSetores');
    Route::post('/pesquisar_setores', [App\Http\Controllers\SetoresController::class, 'pesquisarSetores'])->name('pesquisarSetores');
    Route::get('/cadastro_setores_novo', [App\Http\Controllers\SetoresController::class, 'setoresNovo'])->name('setoresNovo');
    Route::post('/cadastro_setores_novo', [App\Http\Controllers\SetoresController::class, 'storeSetores'])->name('storeSetores');
    Route::get('/cadastro_setores/alterar_setores/{id}', [App\Http\Controllers\SetoresController::class, 'setoresAlterar'])->name('setoresAlterar');
    Route::post('/cadastro_setores/alterar_setores/{id}', [App\Http\Controllers\SetoresController::class, 'updateSetores'])->name('updateSetores');
    Route::get('/cadastro_setores/excluir_setores/{id}', [App\Http\Controllers\SetoresController::class, 'setoresExcluir'])->name('setoresExcluir');
    Route::post('/cadastro_setores/excluir_setores/{id}', [App\Http\Controllers\SetoresController::class, 'destroySetores'])->name('destroySetores');
    ////

    //Ouvidorias
    Route::get('/cadastro_ouvidoria_unidades', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'cadastroOuvidorias'])->name('cadastroOuvidorias');
    Route::get('/pesquisar_ouvidoria_unidades', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'pesquisarOuvidorias'])->name('pesquisarOuvidorias');
    Route::post('/pesquisar_ouvidoria_unidades', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'pesquisarOuvidorias'])->name('pesquisarOuvidorias');
    Route::get('/cadastro_ouvidoria_unidades_novo', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'ouvidoriasNovo'])->name('ouvidoriasNovo');
    Route::post('/cadastro_ouvidoria_unidades_novo', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'storeOuvidorias'])->name('storeOuvidorias');
    Route::get('/cadastro_ouvidoria_unidades/alterar_ouvidoria_unidades/{id}', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'ouvidoriasAlterar'])->name('ouvidoriasAlterar');
    Route::post('/cadastro_ouvidoria_unidades/alterar_ouvidoria_unidades/{id}', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'updateOuvidorias'])->name('updateOuvidorias');
    Route::get('/cadastro_ouvidoria_unidades/excluir_ouvidoria_unidades/{id}', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'ouvidoriasExcluir'])->name('ouvidoriasExcluir');
    Route::post('/cadastro_ouvidoria_unidades/excluir_ouvidoria_unidades/{id}', [App\Http\Controllers\OuvidoriaUnidadesController::class, 'destroyOuvidorias'])->name('destroyOuvidorias');
    ////

    //Documentos_Qualidade
    Route::get('/cadastro_documentos', [App\Http\Controllers\DocumentosQualidadeController::class, 'cadastroDocumentos'])->name('cadastroDocumentos');
    Route::get('/pesquisar_documentos', [App\Http\Controllers\DocumentosQualidadeController::class, 'pesquisarDocumentos'])->name('pesquisarDocumentos');
    Route::post('/pesquisar_documentos', [App\Http\Controllers\DocumentosQualidadeController::class, 'pesquisarDocumentos'])->name('pesquisarDocumentos');
    Route::get('/cadastro_documentos_novo', [App\Http\Controllers\DocumentosQualidadeController::class, 'documentosNovo'])->name('documentosNovo');
    Route::post('/cadastro_documentos_novo', [App\Http\Controllers\DocumentosQualidadeController::class, 'storeDocumentos'])->name('storeDocumentos');
    Route::get('/cadastro_documentos/alterar_documentos/{id}', [App\Http\Controllers\DocumentosQualidadeController::class, 'documentosAlterar'])->name('documentosAlterar');
    Route::post('/cadastro_documentos/alterar_documentos/{id}', [App\Http\Controllers\DocumentosQualidadeController::class, 'updateDocumentos'])->name('updateDocumentos');
    Route::get('/cadastro_documentos/excluir_documentos/{id}', [App\Http\Controllers\DocumentosQualidadeController::class, 'documentosExcluir'])->name('documentosExcluir');
    Route::post('/cadastro_documentos/excluir_documentos/{id}', [App\Http\Controllers\DocumentosQualidadeController::class, 'destroyDocumentos'])->name('destroyDocumentos');
    ////

    //Protocolos_Institucionais
    Route::get('/cadastro_protocolos', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'cadastroProtocolos'])->name('cadastroProtocolos');
    Route::get('/pesquisar_protocolos', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'pesquisarProtocolos'])->name('pesquisarProtocolos');
    Route::post('/pesquisar_protocolos', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'pesquisarProtocolos'])->name('pesquisarProtocolos');
    Route::get('/cadastro_protocolos_novo', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'protocolosNovo'])->name('protocolosNovo');
    Route::post('/cadastro_protocolos_novo', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'storeProtocolos'])->name('storeProtocolos');
    Route::get('/cadastro_protocolos/alterar_protocolos/{id}', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'protocolosAlterar'])->name('protocolosAlterar');
    Route::post('/cadastro_protocolos/alterar_protocolos/{id}', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'updateProtocolos'])->name('updateProtocolos');
    Route::get('/cadastro_protocolos/excluir_protocolos/{id}', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'protocolosExcluir'])->name('protocolosExcluir');
    Route::post('/cadastro_protocolos/excluir_protocolos/{id}', [App\Http\Controllers\ProtocolosInstitucionaisController::class, 'destroyProtocolos'])->name('destroyProtocolos');
    ////

    //Emails
    Route::get('/cadastro_emails', [App\Http\Controllers\EmailsController::class, 'cadastroEmails'])->name('cadastroEmails');
    Route::get('/pesquisar_emails', [App\Http\Controllers\EmailsController::class, 'pesquisarEmails'])->name('pesquisarEmails');
    Route::post('/pesquisar_emails', [App\Http\Controllers\EmailsController::class, 'pesquisarEmails'])->name('pesquisarEmails');
    Route::get('/cadastro_emails_novo', [App\Http\Controllers\EmailsController::class, 'emailsNovo'])->name('emailsNovo');
    Route::post('/cadastro_emails_novo', [App\Http\Controllers\EmailsController::class, 'storeEmails'])->name('storeEmails');
    Route::get('/cadastro_emails/alterar_emails/{id}', [App\Http\Controllers\EmailsController::class, 'emailsAlterar'])->name('emailsAlterar');
    Route::post('/cadastro_emails/alterar_emails/{id}', [App\Http\Controllers\EmailsController::class, 'updateEmails'])->name('updateEmails');
    Route::get('/cadastro_emails/excluir_emails/{id}', [App\Http\Controllers\EmailsController::class, 'emailsExcluir'])->name('emailsExcluir');
    Route::post('/cadastro_emails/excluir_emails/{id}', [App\Http\Controllers\EmailsController::class, 'destroyEmails'])->name('destroyEmails');
    ////

    //Ramais
    Route::get('/cadastro_ramais', [App\Http\Controllers\RamaisController::class, 'cadastroRamais'])->name('cadastroRamais');
    Route::get('/pesquisar_ramais', [App\Http\Controllers\RamaisController::class, 'pesquisarRamais'])->name('pesquisarRamais');
    Route::post('/pesquisar_ramais', [App\Http\Controllers\RamaisController::class, 'pesquisarRamais'])->name('pesquisarRamais');
    Route::get('/cadastro_ramais_novo', [App\Http\Controllers\RamaisController::class, 'ramaisNovo'])->name('ramaisNovo');
    Route::post('/cadastro_ramais_novo', [App\Http\Controllers\RamaisController::class, 'storeRamais'])->name('storeRamais');
    Route::get('/cadastro_ramais/alterar_ramais/{id}', [App\Http\Controllers\RamaisController::class, 'ramaisAlterar'])->name('ramaisAlterar');
    Route::post('/cadastro_ramais/alterar_ramais/{id}', [App\Http\Controllers\RamaisController::class, 'updateRamais'])->name('updateRamais');
    Route::get('/cadastro_ramais/excluir_ramais/{id}', [App\Http\Controllers\RamaisController::class, 'ramaisExcluir'])->name('ramaisExcluir');
    Route::post('/cadastro_ramais/excluir_ramais/{id}', [App\Http\Controllers\RamaisController::class, 'destroyRamais'])->name('destroyRamais');

    ////

    //Indicadores
    Route::get('/cadastro_indicadores', [App\Http\Controllers\IndicadoresController::class, 'cadastroIndicadores'])->name('cadastroIndicadores');
    Route::get('/pesquisar_indicadores', [App\Http\Controllers\IndicadoresController::class, 'pesquisarIndicadores'])->name('pesquisarIndicadores');
    Route::post('/pesquisar_indicadores', [App\Http\Controllers\IndicadoresController::class, 'pesquisarIndicadores'])->name('pesquisarIndicadores');
    Route::get('/cadastro_indicadores_novo', [App\Http\Controllers\IndicadoresController::class, 'indicadoresNovo'])->name('indicadoresNovo');
    Route::post('/cadastro_indicadores_novo', [App\Http\Controllers\IndicadoresController::class, 'storeIndicadores'])->name('storeIndicadores');
    Route::get('/cadastro_indicadores/alterar_indicadores/{id}', [App\Http\Controllers\IndicadoresController::class, 'indicadoresAlterar'])->name('indicadoresAlterar');
    Route::post('/cadastro_indicadores/alterar_indicadores/{id}', [App\Http\Controllers\IndicadoresController::class, 'updateIndicadores'])->name('updateIndicadores');
    Route::get('/cadastro_indicadores/excluir_indicadores/{id}', [App\Http\Controllers\IndicadoresController::class, 'indicadoresExcluir'])->name('indicadoresExcluir');
    Route::post('/cadastro_indicadores/excluir_indicadores/{id}', [App\Http\Controllers\IndicadoresController::class, 'destroyIndicadores'])->name('destroyIndicadores');
    Route::post('/admin/indicador', [App\Http\Controllers\IndicadoresController::class, 'pesquisarIndicadoresGestores'])->name('pesquisarIndicadoresGestores');
    Route::get('/cadastro_indicadores/tela_indicador/{id}', [App\Http\Controllers\IndicadoresController::class, 'telaIndicador'])->name('telaIndicador');
    Route::get('/cadastro_indicadores/indicadores_vincular_pf_usuarios/{id}', [App\Http\Controllers\IndicadoresController::class, 'indicadorVincular'])->name('indicadorVincular');
    Route::post('/cadastro_indicadores/indicadores_vincular_pf_usuarios/{id}', [App\Http\Controllers\IndicadoresController::class, 'storeIndiPerfUsers'])->name('storeIndiPerfUsers');
    Route::get('/cadastro_indicadores/indicadores_vincular_pf_usuarios/excluir/{id}/{id_p}', [App\Http\Controllers\IndicadoresController::class, 'indicaVincularExcluir'])->name('indicaVincularExcluir');
    Route::post('/cadastro_indicadores/indicadores_vincular_pf_usuarios/excluir/{id}/{id_p}', [App\Http\Controllers\IndicadoresController::class, 'destroyIndUser'])->name('destroyIndUser');
    Route::get('/admin/indicador/link/{id}/{id_g}', [App\Http\Controllers\IndicadoresController::class, 'showIndicador'])->name('showIndicador');
    ////

    //Setor_Documento
    Route::get('/setoresDocumentos', [App\Http\Controllers\SetorDocumentoController::class, 'setorDocumento'])->name('setorDocumento');
    Route::get('/setoresDocumentos/pesquisar', [App\Http\Controllers\SetorDocumentoController::class, 'pesquisarSetoresDocumentos'])->name('pesquisarSetoresDocumentos');
    Route::post('/setoresDocumentos/pesquisar', [App\Http\Controllers\SetorDocumentoController::class, 'pesquisarSetoresDocumentos'])->name('pesquisarSetoresDocumentos');
    Route::get('/novoSetorDocumento', [App\Http\Controllers\SetorDocumentoController::class, 'novoSetorDocumento'])->name('novoSetorDocumento');
    Route::post('/novoSetorDocumento', [App\Http\Controllers\SetorDocumentoController::class, 'storeSetorDocumento'])->name('storeSetorDocumento');
    Route::get('/alterarSetorDocumento/{id}', [App\Http\Controllers\SetorDocumentoController::class, 'alterarSetorDocumento'])->name('alterarSetorDocumento');
    Route::post('/alterarSetorDocumento/{id}', [App\Http\Controllers\SetorDocumentoController::class, 'updateSetorDocumento'])->name('updateSetorDocumento');
    Route::get('/deleteSetorDocumento/{id}', [App\Http\Controllers\SetorDocumentoController::class, 'deleteSetorDocumento'])->name('deleteSetorDocumento');
    Route::post('/deleteSetorDocumento/{id}', [App\Http\Controllers\SetorDocumentoController::class, 'destroySetorDocumento'])->name('destroySetorDocumento');
    ////

    //Cardápios - Insumos
    Route::get('/cadastro_cardapios/insumos/{id}', [App\Http\Controllers\InsumosController::class, 'cadastroInsumos'])->name('cadastroInsumos');
    Route::get('/pesquisar_cardapios/insumos/{id}', [App\Http\Controllers\InsumosController::class, 'pesquisarInsumos'])->name('pesquisarInsumos');
    Route::post('/pesquisar_cardapios/insumos/{id}', [App\Http\Controllers\InsumosController::class, 'pesquisarInsumos'])->name('pesquisarInsumos');
    Route::get('/cadastro_cardapios/novo_insumos/{id}', [App\Http\Controllers\InsumosController::class, 'insumosNovo'])->name('insumosNovo');
    Route::post('/cadastro_cardapios/novo_insumos/{id}', [App\Http\Controllers\InsumosController::class, 'storeInsumos'])->name('storeInsumos');
    Route::get('/cadastro_cardapios/alterar_insumos/{id_tp}/{id}', [App\Http\Controllers\InsumosController::class, 'insumosAlterar'])->name('insumosAlterar');
    Route::post('/cadastro_cardapios/alterar_insumos/{id_tp}/{id}', [App\Http\Controllers\InsumosController::class, 'updateInsumos'])->name('updateInsumos');
    Route::get('/cadastro_cardapios/excluir_insumos/{id_tp}/{id}', [App\Http\Controllers\InsumosController::class, 'insumosExcluir'])->name('insumosExcluir');
    Route::post('/cadastro_cardapios/excluir_insumos/{id_tp}/{id}', [App\Http\Controllers\InsumosController::class, 'destroyInsumos'])->name('destroyInsumos');
    ////

    //Cardápios - Tipos Insumos
    Route::get('/cadastro_cardapios/tipos_insumos/{id}', [App\Http\Controllers\TiposInsumosController::class, 'cadastroTiposInsumos'])->name('cadastroTiposInsumos');
    Route::get('/pesquisar_cardapios/tipos_insumos/{id}', [App\Http\Controllers\TiposInsumosController::class, 'pesquisarTiposInsumos'])->name('pesquisarTiposInsumos');
    Route::post('/pesquisar_cardapios/tipos_insumos/{id}', [App\Http\Controllers\TiposInsumosController::class, 'pesquisarTiposInsumos'])->name('pesquisarTiposInsumos');
    Route::get('/cadastro_cardapios/novo_tipos_insumos/{id}', [App\Http\Controllers\TiposInsumosController::class, 'tiposInsumosNovo'])->name('tiposInsumosNovo');
    Route::post('/cadastro_cardapios/novo_tipos_insumos/{id}', [App\Http\Controllers\TiposInsumosController::class, 'storeTiposInsumos'])->name('storeTiposInsumos');
    Route::get('/cadastro_cardapios/alterar_tipos_insumos/{id_tp}/{id}', [App\Http\Controllers\TiposInsumosController::class, 'tiposInsumosAlterar'])->name('tiposInsumosAlterar');
    Route::post('/cadastro_cardapios/alterar_tipos_insumos/{id_tp}/{id}', [App\Http\Controllers\TiposInsumosController::class, 'updateTiposInsumos'])->name('updateTiposInsumos');
    Route::get('/cadastro_cardapios/excluir_tipos_insumos/{id_tp}/{id}', [App\Http\Controllers\TiposInsumosController::class, 'tiposInsumosExcluir'])->name('tiposInsumosExcluir');
    Route::post('/cadastro_cardapios/excluir_tipos_insumos/{id_tp}/{id}', [App\Http\Controllers\TiposInsumosController::class, 'destroyTiposInsumos'])->name('destroyTiposInsumos');
    ////

    //CardápiosDia
    Route::get('/cadastro_cardapios/cardapios_dia/inicio', [App\Http\Controllers\CardapiosDiaController::class, 'cadastroCardapiosDiaInicio'])->name('cadastroCardapiosDiaInicio');
    Route::get('/cadastro_cardapios/cardapios_dia/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'cadastroCardapiosDia'])->name('cadastroCardapiosDia');
    Route::get('/pesquisar_cardapios/cardapios_dia/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'pesquisarCardapiosDia'])->name('pesquisarCardapiosDia');
    Route::post('/pesquisar_cardapios/cardapios_dia/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'pesquisarCardapiosDia'])->name('pesquisarCardapiosDia');
    Route::get('/cadastro_cardapios/novo_cardapios_dia/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'cardapiosDiaNovo'])->name('cardapiosDiaNovo');
    Route::post('/cadastro_cardapios/novo_cardapios_dia/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'storeCardapiosDia'])->name('storeCardapiosDia');
    Route::get('/cadastro_cardapios/alterar_cardapios_dia/{id_tp}/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'cardapiosDiaAlterar'])->name('cardapiosDiaAlterar');
    Route::post('/cadastro_cardapios/alterar_cardapios_dia/{id_tp}/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'updateCardapiosDia'])->name('updateCardapiosDia');
    Route::get('/cadastro_cardapios/excluir_cardapios_dia/{id_tp}/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'cardapiosDiaExcluir'])->name('cardapiosDiaExcluir');
    Route::post('/cadastro_cardapios/excluir_cardapios_dia/{id_tp}/{id}', [App\Http\Controllers\CardapiosDiaController::class, 'destroyCardapiosDia'])->name('destroyCardapiosDia');
    Route::get('/cadastro_cardapios/cardapios_dia/{id}/graficos', [App\Http\Controllers\CardapiosDiaController::class, 'avaliacaoCardapio'])->name('avaliacaoCardapio');
    ////

    //Grupo de Indicadores
    Route::get('/cadastro_grupo_indicadores', [App\Http\Controllers\GrupoIndicadoresController::class, 'cadastroGrupoIndicadores'])->name('cadastroGrupoIndicadores');
    Route::get('/pesquisar_grupo_indicadores', [App\Http\Controllers\GrupoIndicadoresController::class, 'pesquisarGrupoIndicadores'])->name('pesquisarGrupoIndicadores');
    Route::post('/pesquisar_grupo_indicadores', [App\Http\Controllers\GrupoIndicadoresController::class, 'pesquisarGrupoIndicadores'])->name('pesquisarGrupoIndicadores');
    Route::get('/cadastro_grupo_indicadores_novo', [App\Http\Controllers\GrupoIndicadoresController::class, 'indicadoresGrupoNovo'])->name('indicadoresGrupoNovo');
    Route::post('/cadastro_grupo_indicadores_novo', [App\Http\Controllers\GrupoIndicadoresController::class, 'storeGrupoIndicadores'])->name('storeGrupoIndicadores');
    Route::get('/cadastro_grupo_indicadores/alterar_grupo_indicadores/{id}', [App\Http\Controllers\GrupoIndicadoresController::class, 'indicadoresGrupoAlterar'])->name('indicadoresGrupoAlterar');
    Route::post('/cadastro_grupo_indicadores/alterar_grupo_indicadores/{id}', [App\Http\Controllers\GrupoIndicadoresController::class, 'updateGrupoIndicadores'])->name('updateGrupoIndicadores');
    Route::get('/cadastro_grupo_indicadores/excluir_grupo_indicadores/{id}', [App\Http\Controllers\GrupoIndicadoresController::class, 'indicadoresGrupoExcluir'])->name('indicadoresGrupoExcluir');
    Route::post('/cadastro_grupo_indicadores/excluir_grupo_indicadores/{id}', [App\Http\Controllers\GrupoIndicadoresController::class, 'destroyGrupoIndicadores'])->name('destroyGrupoIndicadores');
    ////

    //Permissão
    Route::get('/cadastro_permissao', [App\Http\Controllers\PermissaoController::class, 'cadastroPermissoes'])->name('cadastroPermissoes');
    Route::get('/pesquisar_permissao', [App\Http\Controllers\PermissaoController::class, 'pesquisarPermissoes'])->name('pesquisarPermissoes');
    Route::post('/pesquisar_permissao', [App\Http\Controllers\PermissaoController::class, 'pesquisarPermissoes'])->name('pesquisarPermissoes');
    Route::get('/cadastro_permissao_novo', [App\Http\Controllers\PermissaoController::class, 'cadastroPermissaoNovo'])->name('cadastroPermissaoNovo');
    Route::post('/cadastro_permissao_novo', [App\Http\Controllers\PermissaoController::class, 'storePermissoes'])->name('storePermissoes');
    Route::get('/cadastro_permissao/permissao_alterar/{id}', [App\Http\Controllers\PermissaoController::class, 'permissaoAlterar'])->name('permissaoAlterar');
    Route::post('/cadastro_permissao/permissao_alterar/{id}', [App\Http\Controllers\PermissaoController::class, 'updatePermissoes'])->name('updatePermissoes');
    Route::get('/cadastro_permissao/permissao_excluir/{id}', [App\Http\Controllers\PermissaoController::class, 'permissaoExcluir'])->name('permissaoExcluir');
    Route::post('/cadastro_permissao/permissao_excluir/{id}', [App\Http\Controllers\PermissaoController::class, 'destroyPermissoes'])->name('destroyPermissoes');
    Route::get('/cadastro_permissao/permissao_vincular_usuario/excluir/{id}', [App\Http\Controllers\PermissaoController::class, 'permissaoUserExcluir'])->name('permissaoUserExcluir');
    Route::get('/cadastro_permissao/permissao_vincular_usuario/excluir/{id}/{id_p}', [App\Http\Controllers\PermissaoController::class, 'permissaoUserExcluir_'])->name('permissaoUserExcluir_');
    Route::post('/cadastro_permissao/permissao_vincular_usuario/excluir/{id}/{id_p}', [App\Http\Controllers\PermissaoController::class, 'destroyPermissaoUser'])->name('destroyPermissaoUser');
    Route::get('/cadastro_permissao/permissao_vincular_usuario/{id}', [App\Http\Controllers\PermissaoController::class, 'permissaoVincular'])->name('permissaoVincular');
    Route::post('/cadastro_permissao/permissao_vincular_usuario/{id}', [App\Http\Controllers\PermissaoController::class, 'storePermissaoUsers'])->name('storePermissaoUsers');

	//Veiculos
	Route::get('/cadastro_veiculos', [App\Http\Controllers\ControleVeiculosController::class, 'showVeiculos'])->name('showVeiculos');
	Route::post('/cadastro_veiculos', [App\Http\Controllers\ControleVeiculosController::class, 'pesquisaVeiculos'])->name('pesquisaVeiculos');

    //Educação Permanente
    Route::get('/educacao_permanente/inicio', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoEscolha'])->name('cadastroEducacaoEscolha');
    Route::get('/educacao_permanente/inicio/cadastro/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacao'])->name('cadastroEducacao');
    Route::get('/educacao_permanente/inicio/cadastro/{id}/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisarEducacao'])->name('pesquisarEducacao');
    Route::post('/educacao_permanente/inicio/cadastro/{id}/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisarEducacao'])->name('pesquisarEducacao');
    Route::get('/educacao_permanente/cadastro/novo/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoNovo'])->name('cadastroEducacaoNovo');
    Route::post('/educacao_permanente/cadastro/novo/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'storeEducacaoNovo'])->name('storeEducacaoNovo');
    Route::get('/educacao_permanente/cadastro/alterar/{id}/{idEd}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoAlterar'])->name('cadastroEducacaoAlterar');
    Route::post('/educacao_permanente/cadastro/alterar/{id}/{idEd}', [App\Http\Controllers\EducacaoPermanenteController::class, 'updateEducacaoAlterar'])->name('updateEducacaoAlterar');
    Route::get('/educacao_permanente/cadastro/excluir/{id}/{idEd}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoExcluir'])->name('cadastroEducacaoExcluir');
    Route::post('/educacao_permanente/cadastro/excluir/{id}/{idEd}', [App\Http\Controllers\EducacaoPermanenteController::class, 'destroyEducacaoExcluir'])->name('destroyEducacaoExcluir');
    Route::get('/educacao_permanente/cadastro_videos', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoVideos'])->name('cadastroEducacaoVideos');
    Route::get('/educacao_permanente/cadastro_documentos', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoDocumentos'])->name('cadastroEducacaoDocumentos');
    Route::get('/educacao_permanente/cadastro_quiz', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoQuiz'])->name('cadastroEducacaoQuiz');
    Route::get('/educacao_permanente/cadastro_quiz/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoQuiz'])->name('pesquisaEducacaoQuiz');
    Route::post('/educacao_permanente/cadastro_quiz/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoQuiz'])->name('pesquisaEducacaoQuiz');
    Route::get('/educacao_permanente/cadastro_quiz/respondidas/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoQuizRespondidas'])->name('cadastroEducacaoQuizRespondidas');
    Route::get('/educacao_permanente/cadastro_quiz/respondidas/{id}/pesquisa', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoQuizRespondidas'])->name('pesquisaEducacaoQuizRespondidas');
    Route::post('/educacao_permanente/cadastro_quiz/respondidas/{id}/pesquisa', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoQuizRespondidas'])->name('pesquisaEducacaoQuizRespondidas');
    Route::get('/educacao_permanente/cadastro_quiz/novo', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoQuizNovo'])->name('cadastroEducacaoQuizNovo');
    Route::post('/educacao_permanente/cadastro_quiz/novo', [App\Http\Controllers\EducacaoPermanenteController::class, 'storeEducacaoQuizNovo'])->name('storeEducacaoQuizNovo');
    Route::get('/educacao_permanente/cadastro_quiz/alterar/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoQuizAlterar'])->name('cadastroEducacaoQuizAlterar');
    Route::post('/educacao_permanente/cadastro_quiz/alterar/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'updateEducacaoQuizAlterar'])->name('updateEducacaoQuizAlterar');
    Route::get('/educacao_permanente/cadastro_quiz/excluir/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoQuizExcluir'])->name('cadastroEducacaoQuizExcluir');
    Route::post('/educacao_permanente/cadastro_quiz/excluir/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'destroyEducacaoQuizExcluir'])->name('destroyEducacaoQuizExcluir');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoPerguntas'])->name('cadastroEducacaoPerguntas');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/{id}/pesquisa', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoPerguntas'])->name('pesquisaEducacaoPerguntas');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/{id}/pesquisa', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoPerguntas'])->name('pesquisaEducacaoPerguntas');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/novo/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoPerguntasNovo'])->name('cadastroEducacaoPerguntasNovo');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/novo/{id}', [App\Http\Controllers\EducacaoPermanenteController::class, 'storeEducacaoQuizPergNovo'])->name('storeEducacaoQuizPergNovo');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/alterar/{id}/{id_q}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoPerguntasAlterar'])->name('cadastroEducacaoPerguntasAlterar');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/alterar/{id}/{id_q}', [App\Http\Controllers\EducacaoPermanenteController::class, 'updateEducacaoPerguntasAlterar'])->name('updateEducacaoPerguntasAlterar');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/excluir/{id}/{id_q}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoPerguntasExcluir'])->name('cadastroEducacaoPerguntasExcluir');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/excluir/{id}/{id_q}', [App\Http\Controllers\EducacaoPermanenteController::class, 'destroyEducacaoPerguntasExcluir'])->name('destroyEducacaoPerguntasExcluir');

    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/{id}/{id_p}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoRespostas'])->name('cadastroEducacaoRespostas');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/{id}/{id_p}/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoRespostas'])->name('pesquisaEducacaoRespostas');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/{id}/{id_p}/pesquisar', [App\Http\Controllers\EducacaoPermanenteController::class, 'pesquisaEducacaoRespostas'])->name('pesquisaEducacaoRespostas');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/novo/{id}/{id_p}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoRespostasNovo'])->name('cadastroEducacaoRespostasNovo');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/novo/{id}/{id_p}', [App\Http\Controllers\EducacaoPermanenteController::class, 'storeEducacaoRespostasNovo'])->name('storeEducacaoRespostasNovo');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/alterar/{id}/{id_p}/{id_r}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoRespostasAlterar'])->name('cadastroEducacaoRespostasAlterar');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/alterar/{id}/{id_p}/{id_r}', [App\Http\Controllers\EducacaoPermanenteController::class, 'updateEducacaoRespostas'])->name('updateEducacaoRespostas');
    Route::get('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/excluir/{id}/{id_p}/{id_r}', [App\Http\Controllers\EducacaoPermanenteController::class, 'cadastroEducacaoRespostasExcluir'])->name('cadastroEducacaoRespostasExcluir');
    Route::post('/educacao_permanente/cadastro_quiz/perguntas/cadastro/respostas/excluir/{id}/{id_p}/{id_r}', [App\Http\Controllers\EducacaoPermanenteController::class, 'destroyEducacaoRespostas'])->name('destroyEducacaoRespostas');

    //Avaliacao Experiencia
    Route::get('/cadastro_avaliacao_experiencia/cadastro', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'cadastroAvaliacaoExp'])->name('cadastroAvaliacaoExp');
    Route::get('/cadastro_avaliacao_experiencia/cadastro/pesquisar', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'cadastroAvaliacaoExp'])->name('cadastroAvaliacaoExp');
    Route::post('/cadastro_avaliacao_experiencia/cadastro/pesquisar', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'pesquisarAvaliacaoExp'])->name('pesquisarAvaliacaoExp');
    Route::get('/cadastro_avaliacao_experiencia/excluir/{id}', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'excluirAvaliacaoExp'])->name('excluirAvaliacaoExp');
    Route::post('/cadastro_avaliacao_experiencia/excluir/{id}', [App\Http\Controllers\AvaliacaoExperienciaController::class, 'destroyAvaliacaoExp'])->name('destroyAvaliacaoExp');

	//Relatorios
	Route::get('/relatorios', [App\Http\Controllers\RelatoriosController::class, 'showRelatorios'])->name('showRelatorios');
	Route::post('/relatorios', [App\Http\Controllers\RelatoriosController::class, 'relatorioVeiculos'])->name('relatorioVeiculos');

     // Manuais
     Route::get('manuais/lista_manuais', [App\Http\Controllers\ManuaisController::class, 'listaManuais'])->name('listaManuais');
     Route::get('manuais/lista_manuais/pesquisa', [App\Http\Controllers\ManuaisController::class, 'pesquisarMural'])->name('pesquisarMural');
     Route::post('manuais/lista_manuais/pesquisa', [App\Http\Controllers\ManuaisController::class, 'pesquisarMural'])->name('pesquisarMural');
     Route::get('manuais/novo_manual', [App\Http\Controllers\ManuaisController::class, 'novoManual'])->name('novoManual');
     Route::post('manuais/novo_manual', [App\Http\Controllers\ManuaisController::class, 'storeManual'])->name('storeManual');
 
     Route::get('manuais/lista_manuais/alterar_manual/{id}', [App\Http\Controllers\ManuaisController::class, 'alterarManual'])->name('alterarManual');
     Route::post('manuais/lista_manuais/alterar_manual/{id}', [App\Http\Controllers\ManuaisController::class, 'updateManual'])->name('updateManual');
 
     route::get('manuais/lista_manuais/excluir_manual/{id}', [App\Http\Controllers\ManuaisController::class, 'excluirManual'])->name('excluirManual');
     route::post('manuais/lista_manuais/excluir_manual/{id}', [App\Http\Controllers\ManuaisController::class, 'destroyManual'])->name('destroyManual');
});

// Rota para Inicio de Formulário Enviando informações da Unidade pela qual o Colaborador faz parte
Route::get('pesquisa_clima', [App\Http\Controllers\FormularioController::class, 'iniciarForm'])->name('iniciarForm');
Route::post('pesquisa_clima', [App\Http\Controllers\FormularioController::class, 'storeIniciarForm'])->name('storeIniciarForm');

// Rota para Perguntas 1/4
Route::get('pergunta/sobreVoce/{id}', [App\Http\Controllers\FormularioController::class, 'sobreVoce'])->name('sobreVoce');
Route::post('pergunta/sobreVoce/{id}', [App\Http\Controllers\FormularioController::class, 'storeSobreVoce'])->name('storeSobreVoce');

// Rota para Perguntas 2/4
Route::get('pergunta/ondeTrabalha/{id}', [App\Http\Controllers\FormularioController::class, 'ondeTrabalha'])->name('ondeTrabalha');
Route::post('pergunta/ondeTrabalha/{id}', [App\Http\Controllers\FormularioController::class, 'storeOndeTrabalha'])->name('storeOndeTrabalha');

// Rota para Perguntas 3/4
Route::get('pergunta/seuGestor/{id}', [App\Http\Controllers\FormularioController::class, 'seuGestor'])->name('seuGestor');
Route::post('pergunta/seuGestor/{id}', [App\Http\Controllers\FormularioController::class, 'storeSeuGestor'])->name('storeSeuGestor');

// Rota para Perguntas 4/4
Route::get('pergunta/consideracoesFinais/{id}', [App\Http\Controllers\FormularioController::class, 'consideracoesFinais'])->name('consideracoesFinais');
Route::post('pergunta/consideracoesFinais/{id}', [App\Http\Controllers\FormularioController::class, 'storeConsideracoesFinais'])->name('storeConsideracoesFinais');

// Rota para Final de Pesquisa (Agradecimento)
Route::get('finalForm', [App\Http\Controllers\FormularioController::class, 'finalForm'])->name('finalForm');

Route::get('graphics', [App\Http\Controllers\GraphicController::class, 'graphics'])->name('graphics');
Route::get('graphics/graphicsSobreVoce', [App\Http\Controllers\GraphicController::class, 'graphicsSobreVoce'])->name('graphicsSobreVoce');
Route::get('graphics/graphicsOndeTrabalha', [App\Http\Controllers\GraphicController::class, 'graphicsOndeTrabalha'])->name('graphicsOndeTrabalha');
Route::get('graphics/graphicsSeuGestor', [App\Http\Controllers\GraphicController::class, 'graphicsSeuGestor'])->name('graphicsSeuGestor');
Route::get('graphics/graphicsConsideracoes', [App\Http\Controllers\GraphicController::class, 'graphicsConsideracoes'])->name('graphicsConsideracoes');

// Rota para Retornar Tela de Gráfico "Sobre Você"
Route::get('graphics/sobreVoceGraphic', [App\Http\Controllers\GraphicController::class, 'sobreVoceGraphic'])->name('sobreVoceGraphic');
Route::get('graphics/sobreVoceGraphic/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce'])->name('pesqSobreVoce');
Route::post('graphics/sobreVoceGraphic/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce'])->name('pesqSobreVoce');
//
Route::get('graphics/sobreVoceGraphic2', [App\Http\Controllers\GraphicController::class, 'sobreVoceGraphic2'])->name('sobreVoceGraphic2');
Route::get('graphics/sobreVoceGraphic2/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce2'])->name('pesqSobreVoce2');
Route::post('graphics/sobreVoceGraphic2/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce2'])->name('pesqSobreVoce2');
//
Route::get('graphics/sobreVoceGraphic3', [App\Http\Controllers\GraphicController::class, 'sobreVoceGraphic3'])->name('sobreVoceGraphic3');
Route::get('graphics/sobreVoceGraphic3/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce3'])->name('pesqSobreVoce3');
Route::post('graphics/sobreVoceGraphic3/pesquisa', [App\Http\Controllers\GraphicController::class, 'pesqSobreVoce3'])->name('pesqSobreVoce3');
// Rota para Retornar Tela de Gráfico "Onde Trabalha"
Route::get('graphics/OndeTrabalhaGraphic', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'ondeTrabalhaGraphic'])->name('ondeTrabalhaGraphic');
Route::get('graphics/OndeTrabalhaGraphic/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha'])->name('pesqOndeTrabalha');
Route::post('graphics/OndeTrabalhaGraphic/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha'])->name('pesqOndeTrabalha');
//
Route::get('graphics/OndeTrabalhaGraphic2', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'ondeTrabalhaGraphic2'])->name('ondeTrabalhaGraphic2');
Route::get('graphics/OndeTrabalhaGraphic2/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha2'])->name('pesqOndeTrabalha2');
Route::post('graphics/OndeTrabalhaGraphic2/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha2'])->name('pesqOndeTrabalha2');
//
Route::get('graphics/OndeTrabalhaGraphic3', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'ondeTrabalhaGraphic3'])->name('ondeTrabalhaGraphic3');
Route::get('graphics/OndeTrabalhaGraphic3/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha3'])->name('pesqOndeTrabalha3');
Route::post('graphics/OndeTrabalhaGraphic3/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha3'])->name('pesqOndeTrabalha3');
//
Route::get('graphics/OndeTrabalhaGraphic4', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'ondeTrabalhaGraphic4'])->name('ondeTrabalhaGraphic4');
Route::get('graphics/OndeTrabalhaGraphic4/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha4'])->name('pesqOndeTrabalha4');
Route::post('graphics/OndeTrabalhaGraphic4/pesquisa', [App\Http\Controllers\OndeTrabalhaGraphicController::class, 'pesqOndeTrabalha4'])->name('pesqOndeTrabalha4');
// Rota para Retornar Tela de Gráfico "Seu Gestor"
Route::get('graphics/seuGestorGraphic', [App\Http\Controllers\SeuGestorGraphicController::class, 'seuGestorGraphic'])->name('seuGestorGraphic');
Route::get('graphics/seuGestorGraphic/pesquisa', [App\Http\Controllers\SeuGestorGraphicController::class, 'pesqSeuGestor'])->name('pesqSeuGestor');
Route::post('graphics/seuGestorGraphic/pesquisa', [App\Http\Controllers\SeuGestorGraphicController::class, 'pesqSeuGestor'])->name('pesqSeuGestor');
//
// Rota para Retornar Tela de Gráfico "Consideracoes Finais"
Route::get('graphics/consideracoesFinais', [App\Http\Controllers\ConsideracoesGraphicController::class, 'consideracoesFinaisGraphic'])->name('consideracoesFinaisGraphic');
Route::get('graphics/consideracoesFinais/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais'])->name('pesqConsideracoesFinais');
Route::post('graphics/consideracoesFinais/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais'])->name('pesqConsideracoesFinais');
//
Route::get('graphics/consideracoesFinais2', [App\Http\Controllers\ConsideracoesGraphicController::class, 'consideracoesFinaisGraphic2'])->name('consideracoesFinaisGraphic2');
Route::get('graphics/consideracoesFinais2/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais2'])->name('pesqConsideracoesFinais2');
Route::post('graphics/consideracoesFinais2/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais2'])->name('pesqConsideracoesFinais2');

Route::get('graphics/consideracoesFinais3', [App\Http\Controllers\ConsideracoesGraphicController::class, 'consideracoesFinaisGraphic3'])->name('consideracoesFinaisGraphic3');
Route::get('graphics/consideracoesFinais3/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais3'])->name('pesqConsideracoesFinais3');
Route::post('graphics/consideracoesFinais3/pesquisa', [App\Http\Controllers\ConsideracoesGraphicController::class, 'pesqConsideracoesFinais3'])->name('pesqConsideracoesFinais3');

//Rota para Retonar Tela para Manual Farmaceutico
Route::get('manual_farmacia', [App\Http\Controllers\HomeController::class, 'manualFarmacia'])->name('manualFarmacia');

//Rotas para gerar iframe com PDFs Farmacêuticos
Route::get('manual_farmacia/iframe/{id}', [App\Http\Controllers\HomeController::class, 'iframeFarmacia'])->name('iframeFarmacia');
Route::post('manual_farmacia/iframe/{id}', [App\Http\Controllers\HomeController::class, 'iframeFarmacia'])->name('iframeFarmacia');

Route::get('/relatoriosNF', [App\Http\Controllers\RelatoriosController::class, 'relatoriosNF'])->name('relatoriosNF');
Route::post('/relatoriosNF', [App\Http\Controllers\RelatoriosController::class, 'relatoriosNF'])->name('relatoriosNF');
Route::get('/relatorioNF/{id}', [App\Http\Controllers\RelatoriosController::class, 'relatorioNF'])->name('relatorioNF');
Route::get('/relatoriosNF/{id}/filtrar', [App\Http\Controllers\RelatoriosController::class, 'filtrarNF'])->name('filtrarNF');
Route::post('/relatoriosNF/{id}/filtrar', [App\Http\Controllers\RelatoriosController::class, 'filtrarNF'])->name('filtrarNF');
Route::get('/relatoriosNF/{id}/filtrar/{data}/download', [App\Http\Controllers\RelatoriosController::class, 'downloadRelatorioNF'])->name('downloadRelatorioNF');