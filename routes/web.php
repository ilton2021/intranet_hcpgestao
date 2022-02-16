<?php

use Illuminate\Support\Facades\Route;
use App\Models\Unidades;
use App\Models\Mural;
use App\Models\Destaques;

Route::get('/', function () {
    $unidades = Unidades::all();
    $und_Princ = Unidades::where('id',1)->get();
    $unidade =  $und_Princ;
    $murais = Mural::all();
    $destaques = Destaques::all();
    return view('welcome', compact('unidades','murais','destaques','unidade'));
});

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
Route::get('/destaques_detalhes/{id}', [App\Http\Controllers\HomeController::class, 'destaquesDetalhes'])->name('destaquesDetalhes');
Route::get('/murais_detalhes/{id}', [App\Http\Controllers\HomeController::class, 'muraisDetalhes'])->name('muraisDetalhes');
Route::get('/acesso_rapido/{id}', [App\Http\Controllers\HomeController::class, 'acessoRapido'])->name('acessoRapido');
Route::post('/unidade/{id}', [App\Http\Controllers\HomeController::class, 'enviarEmail'])->name('enviarEmail');
Route::get('/admin/indicador', [App\Http\Controllers\UserController::class, 'telaLoginIndicador'])->name('telaLoginIndicador');
Route::get('/acesso_rapido/3/ramais_unidade/{id}', [App\Http\Controllers\RamaisController::class, 'ramaisUnidade'])->name('ramaisUnidade');
Route::get('/acesso_rapido/3/emails_unidade/{id}', [App\Http\Controllers\EmailsController::class, 'emailsUnidade'])->name('emailsUnidade');
////

Route::middleware(['auth'])->group( function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    //Usuários
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
});

