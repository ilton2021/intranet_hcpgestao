<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use App\Models\Destaques;
use App\Models\Mural;
use App\Models\OuvidoriaUnidades;
use App\Models\DocumentosQualidade;
use App\Models\PoliticasNormas;
use App\Models\Indicadores;
use App\Models\Ramais;
use App\Models\Emails;
use App\Models\Manual;
use App\Models\Setor;
use App\Models\ProtocolosInstitucionais;
use App\Models\UserPerfil;
use App\Models\CardapiosDia;
use App\Models\Insumos;
use App\Models\SetorDocumento;
use App\Models\EducacaoPermanente;
use App\Models\EducacaoPermanenteQuiz;
use App\Models\EducacaoPermanentePerguntas;
use App\Models\EducacaoPermanenteRespostas;
use App\Models\EducacaoPermanenteRespostasQuiz;
use App\Models\emailouvidoriarh;
use App\Models\Ocorrencias;
use App\Models\TiposOcorrencias;
use App\Models\OcorrenciasForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $UserPerfil = UserPerfil::where('users_id', $id_user)->get();
        $perfil_user = array();
        for ($i = 0; $i < sizeof($UserPerfil); $i++) {
            $perfil_user[$i] = $UserPerfil[$i]->perfil_id;
        }
        return view('home', compact('perfil_user'));
    }

    public function oquee()
    {
        $unidades = Unidades::all();
        return view('oquee', compact('unidades'));
    }

   public function unidade($id)
    {
        $murais = Mural::where('status', 1)->get();
        $destaques = Destaques::where('status', 1)->get();
        $und_Princ = Unidades::where('id', $id)->get();
        $muraisDaUnd = array();
        for ($i = 0; $i < sizeof($murais); $i++) {
            $und_atuais = explode(",", $murais[$i]->unidade_id);	
            if (in_array($und_Princ[0]->id, $und_atuais) || in_array(1, $und_atuais)) {	
                array_push($muraisDaUnd, $murais[$i]->id);
            }
        }
        $destaDaUnd = array();
        for ($u = 0; $u < sizeof($destaques); $u++) {
            $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais2) || in_array(1, $und_atuais2)) {
                array_push($destaDaUnd, $destaques[$u]->id);
            }
        }
        $destaques = Destaques::where('status', 1)->whereIn('id',$destaDaUnd)->get();
        $murais = Mural::where('status', 1)->whereIn('id',$muraisDaUnd)->get();
        $unidades = Unidades::all();
        $unidade = Unidades::where('id', $id)->get();
        $und_Matriz = Unidades::where('id', 1)->get();
        $id_und = $unidade[0]->id;
        return view('unidade', compact('unidade', 'unidades', 'murais', 'destaques', 'destaDaUnd', 'muraisDaUnd', 'und_Matriz','id_und'));
    }

    public function areaColaborador()
    {
        $unidades   = Unidades::all();
        $und_Matriz = Unidades::where('id', 1)->get();
        $setores    = Setor::all();
        return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores'));
    }

    public function ouvidoriaRhSend(Request $request)
    {
        $input = $request->all();
        $unidades = Unidades::all();
        $und_Matriz = Unidades::where('id', 1)->get();
        $setores     = Setor::all();

        $validator = Validator::make($request->all(), [
            'tipocolaborador'   => 'required',
            'dtocorren'         => 'required|date',
            'solicitacao'       => 'required',
            'texto'             => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $texto           =  $input['texto'];
            $tipocolaborador =  $input['tipocolaborador'];
            $telefone        =  isset($input['telefone']) ? $input['telefone'] : "";
            $celular         =  isset($input['celular']) ? $input['celular'] : "";
            $setor           =  isset($input['setor']) ? $input['setor'] : "";
            $dtocorren       =  $input['dtocorren'];
            $solicitacao     =  $input['solicitacao'];
            $emailUsuario    =  isset($input['nome']) ? $input['nome'] : "";

            if ($emailUsuario !== "") {

                $dominio = explode("@", $emailUsuario);
                $dominio = $dominio[1];
                $validacaoEmail = 0;
                if ($dominio == "hmr.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "hss.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "upaearruda.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "upaearcoverde.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "upaebelojardim.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "hcpgestao.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "upaigarassu.org.br") {
                    $validacaoEmail = 1;
                } elseif ($dominio == "upaecaruaru.org.br") {
                    $validacaoEmail = 1;
                } else {
                    $validacaoEmail = 0;
                }
                if ($validacaoEmail == 1) {
                    if (isset($input['token'])) {
                        $emailouvidoriarh = emailouvidoriarh::where('email', $emailUsuario)->where('token', $input['token'])->where('status', 1)->get();
                        $ultimoReg = sizeof($emailouvidoriarh) - 1;
                        if (sizeof($emailouvidoriarh) > 0) {
                            $hoje = date('Y-m-d H:i:s');
                            $tempo =  (strtotime($hoje) - strtotime($emailouvidoriarh[$ultimoReg]->created_at));
                            if ($tempo <= 3600) {
                                $assunto  =  "Ouvidoria RH intranet - " . $solicitacao;
                                Mail::send(
                                    'email.emails_ouvidoriaRh',
                                    [
                                        'texto'             =>  $texto,
                                        'tipocolaborador'   =>  $tipocolaborador,
                                        'telefone'          =>  $telefone,
                                        'celular'           =>  $celular,
                                        'setor'             =>  $setor,
                                        'dtocorren'         =>  $dtocorren,
                                        'solicitacao'       =>  $solicitacao,
                                        'nome'              =>  $emailUsuario
                                    ],
                                    function ($m) use ($assunto, $emailUsuario) {
                                        $m->from($emailUsuario);
                                        $m->subject($assunto);
                                        $m->to('dh@hcpgestao.org.br');
                                        $m->cc($emailUsuario);
                                    }
                                );
                                $input['status'] = 0;
                                $ouvidoria = emailouvidoriarh::find($emailouvidoriarh[$ultimoReg]->id);
                                $ouvidoria->update($input);
                                $validator = "Chamado para ouvidoria enviado com sucesso";
                                return  redirect()->route('areaColaborador')
                                    ->withErrors($validator);
                            } else {
                                $str = rand();
                                $tokenCode = md5($str);
                                $tokenCode = substr($tokenCode, 0, 30);
                                $assunto  =  "Ouvidoria RH intranet - confirmação de e-mail";
                                Mail::send(
                                    'email.emails_ouvidoriaRhOk',
                                    ['texto' =>  $texto, 'token' => $tokenCode],
                                    function ($m) use ($assunto, $emailUsuario) {
                                        $m->from("dh@hcpgestao.org.br");
                                        $m->subject($assunto);
                                        $m->to($emailUsuario);
                                    }
                                );
                                $input['token'] = $tokenCode;
                                $input['email'] = $emailUsuario;
                                $ouvidoria = emailouvidoriarh::create($input);
                                $token = "ok";
                                $validator = "Acesse seu e-mail e copie o token !";
                                return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                    ->withErrors($validator)
                                    ->withInput(session()->flashInput($request->input()));
                            }
                        } else {
                            $emailouvidoriarh = emailouvidoriarh::where('email', $emailUsuario)->where('status', 1)->get();
                            $ultimoReg = sizeof($emailouvidoriarh) - 1;
                            if (sizeof($emailouvidoriarh) > 0) {
                                $hoje = date('Y-m-d H:i:s');
                                $tempo =  (strtotime($hoje) - strtotime($emailouvidoriarh[$ultimoReg]->created_at));
                                if ($tempo <= 3600) {
                                    $token = "ok";
                                    $validator = "O token já foi enviado para seu e-mail !";
                                    return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                        ->withErrors($validator)
                                        ->withInput(session()->flashInput($request->input()));
                                } else {
                                    $str = rand();
                                    $tokenCode = md5($str);
                                    $tokenCode = substr($tokenCode, 0, 30);
                                    $assunto  =  "Ouvidoria RH intranet - confirmação de e-mail";
                                    Mail::send(
                                        'email.emails_ouvidoriaRhOk',
                                        ['texto' =>  $texto, 'token' => $tokenCode],
                                        function ($m) use ($assunto, $emailUsuario) {
                                            $m->from("dh@hcpgestao.org.br");
                                            $m->subject($assunto);
                                            $m->to($emailUsuario);
                                        }
                                    );
                                    $input['token'] = $tokenCode;
                                    $input['email'] = $emailUsuario;
                                    $ouvidoria = emailouvidoriarh::create($input);
                                    $token = "ok";
                                    $validator = "Acesse seu e-mail e copie o token !";
                                    return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                        ->withErrors($validator)
                                        ->withInput(session()->flashInput($request->input()));
                                }
                            } else {
                                $str = rand();
                                $tokenCode = md5($str);
                                $tokenCode = substr($tokenCode, 0, 30);
                                $assunto  =  "Ouvidoria RH intranet - confirmação de e-mail";
                                Mail::send(
                                    'email.emails_ouvidoriaRhOk',
                                    ['texto' =>  $texto, 'token' => $tokenCode],
                                    function ($m) use ($assunto, $emailUsuario) {
                                        $m->from("dh@hcpgestao.org.br");
                                        $m->subject($assunto);
                                        $m->to($emailUsuario);
                                    }
                                );
                                $input['token'] = $tokenCode;
                                $input['email'] = $emailUsuario;
                                $ouvidoria = emailouvidoriarh::create($input);
                                $token = "ok";
                                $validator = "Acesse seu e-mail e copie o token !";
                                return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                    ->withErrors($validator)
                                    ->withInput(session()->flashInput($request->input()));
                            }
                        }
                    } else {
                        $emailouvidoriarh = emailouvidoriarh::where('email', $emailUsuario)->where('status', 1)->get();
                        $ultimoReg = sizeof($emailouvidoriarh) - 1;
                        if (sizeof($emailouvidoriarh) > 0) {
                            $hoje = date('Y-m-d H:i:s');
                            $tempo =  (strtotime($hoje) - strtotime($emailouvidoriarh[$ultimoReg]->created_at));
                            if ($tempo <= 3600) {
                                $token = "ok";
                                $validator = "O token já foi enviado para seu e-mail !";
                                return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                    ->withErrors($validator)
                                    ->withInput(session()->flashInput($request->input()));
                            } else {
                                $str = rand();
                                $tokenCode = md5($str);
                                $tokenCode = substr($tokenCode, 0, 30);
                                $assunto  =  "Ouvidoria RH intranet - confirmação de e-mail";
                                Mail::send(
                                    'email.emails_ouvidoriaRhOk',
                                    ['texto' =>  $texto, 'token' => $tokenCode],
                                    function ($m) use ($assunto, $emailUsuario) {
                                        $m->from("dh@hcpgestao.org.br");
                                        $m->subject($assunto);
                                        $m->to($emailUsuario);
                                    }
                                );
                                $input['token'] = $tokenCode;
                                $input['email'] = $emailUsuario;
                                $ouvidoria = emailouvidoriarh::create($input);
                                $token = "ok";
                                $validator = "Acesse seu e-mail e copie o token !";
                                return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                    ->withErrors($validator)
                                    ->withInput(session()->flashInput($request->input()));
                            }
                        } else {
                            $str = rand();
                            $tokenCode = md5($str);
                            $tokenCode = substr($tokenCode, 0, 30);
                            $assunto  =  "Ouvidoria RH intranet - confirmação de e-mail";
                            Mail::send(
                                'email.emails_ouvidoriaRhOk',
                                ['texto' =>  $texto, 'token' => $tokenCode],
                                function ($m) use ($assunto, $emailUsuario) {
                                    $m->from("dh@hcpgestao.org.br");
                                    $m->subject($assunto);
                                    $m->to($emailUsuario);
                                }
                            );
                            $input['token'] = $tokenCode;
                            $input['email'] = $emailUsuario;
                            $ouvidoria = emailouvidoriarh::create($input);
                            $token = "ok";
                            $validator = "Acesse seu e-mail e copie o token !";
                            return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores', 'token'))
                                ->withErrors($validator)
                                ->withInput(session()->flashInput($request->input()));
                        }
                    }
                } else {
                    $validator = "O e-mail precisa ser corporativo !";
                    return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores'))
                        ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
                }
            } else {
                $validator = "Você precisa inserir o e-mail !";
                return view('area_colaborador', compact('unidades', 'und_Matriz', 'setores'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            }
        }
    }

    public function destaquesDetalhes($id, $id_d)
    {
        $unidades = Unidades::all();
        $und_atual = $id;
        if ($id == 1) {
            $destaSelect = Destaques::where('id', $id_d)->where('status', 1)->get();
            $destaques = Destaques::where('status', 1)->get();
        } else {
            $destaques = Destaques::where('status', 1)->get();
            $destaSelect = Destaques::where('id', $id_d)->where('status', 1)->get();
            $destaDaUnd = array();
            for ($u = 0; $u < sizeof($destaques); $u++) {
                $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
                if (in_array($id, $und_atuais2)) {
                    array_push($destaDaUnd, $destaques[$u]);
                }
            }
            $destaques = $destaDaUnd;
        }
        return view('destaques_detalhes', compact('destaSelect', 'destaques', 'unidades', 'und_atual'));
    }

    public function muraisDetalhes($id)
    {
        $unidades = Unidades::all();
        if ($id == 0) {
            $murais = Mural::where('status', 1)->orderby('data_inicio','DESC')->get();
        } else {
            $murais = Mural::where('id', $id)->where('status', 1)->orderby('data_inicio','DESC')->get();
        }
        $murais2 = Mural::where('status', 1)->orderby('data_inicio','DESC')->get();
        return view('murais_detalhes', compact('murais', 'murais2', 'unidades'));
    }

    public function acessoRapido($id)
    {
        $ouvidorias  = OuvidoriaUnidades::all();
        $documentos  = DocumentosQualidade::all();
        $politicas   = PoliticasNormas::all();
        $protocolos  = ProtocolosInstitucionais::all();
        $ramais      = Ramais::all();
        $emails      = Emails::all();
        $setores     = Setor::all();
        $indicadores = Indicadores::all();
        $unidades    = Unidades::all();
        return view('acesso_rapido', compact('id', 'setores', 'ouvidorias', 'documentos', 'politicas', 'ramais', 'emails', 'protocolos', 'indicadores', 'unidades'));
    }

    public function documentosUnidades($id)
    {
        $unidades = Unidades::all();
        return view('documentos_unidades', compact('unidades', 'id'));
    }
    
    public function documentosSetores($id, $id_u)
    {
        $setores  = SetorDocumento::where('unidade_id', $id_u)->orderby('setor', 'ASC')->get();
        $unds     = Unidades::where('id', $id_u)->get();
        $unidades = Unidades::all();
        return view('setoresDocumentos', compact('setores', 'unidades', 'unds', 'id'));
    }

    public function documentosQualidade($id, $id_u, $id_d)
    {
        $unidades   = Unidades::where('id', $id_u)->get();
        if($id == 1) {
            $setores    = SetorDocumento::where('unidade_id', $id_u)->get();
            $documentos = DocumentosQualidade::where('setor_id', $id_d)->orderby('sigla','ASC')->get();
            $protocolos = ProtocolosInstitucionais::where('id', 0)->get();
            $politicas  = PoliticasNormas::where('id', 0)->get();
        } else if ($id == 2) {
            $setores    = SetorDocumento::where('unidade_id', $id_u)->get();
            $documentos = DocumentosQualidade::where('id', 0)->get();
            $protocolos = ProtocolosInstitucionais::where('setor_id', $id_d)->orderby('sigla','ASC')->get();
            $politicas  = PoliticasNormas::where('id', 0)->get();
        } else if ($id == 3) {
            $setores    = SetorDocumento::where('unidade_id', $id_u)->get();
            $documentos = DocumentosQualidade::where('id', 0)->get();
            $protocolos = ProtocolosInstitucionais::where('id', 0)->get();
            $politicas  = PoliticasNormas::where('setor_id', $id_d)->orderby('sigla','ASC')->get();
        }
        $qtdDocs = sizeof($documentos);
        $qtdProt = sizeof($protocolos);
        $qtdPols = sizeof($politicas); 
        return view('documentos', compact('unidades','documentos','politicas','protocolos','id', 'id_u', 'setores','qtdDocs','qtdPols','qtdProt'));
    }

    public function cardapio($id)
    {
        $dia                = date('Y-m-d', strtotime('now'));
        $cardapiosDiaCafe   = CardapiosDia::where('tipo_refeicao',1)->where('dia',$dia)->where('unidade_id',$id)->get();
        $cardapiosDiaAlmoco = CardapiosDia::where('tipo_refeicao',2)->where('dia',$dia)->where('unidade_id',$id)->get();
        $cardapiosDiaJantar = CardapiosDia::where('tipo_refeicao',3)->where('dia',$dia)->where('unidade_id',$id)->get();
        $qtdCDCF            = sizeof($cardapiosDiaCafe);
        $qtdCDAL            = sizeof($cardapiosDiaAlmoco);
        $qtdCDJA            = sizeof($cardapiosDiaJantar);
        $insumos            = Insumos::all(); 
        $unidades           = Unidades::where('id',$id)->get(); 
        return view('cardapio', compact('unidades','cardapiosDiaCafe','cardapiosDiaAlmoco','cardapiosDiaJantar','qtdCDCF','qtdCDAL','qtdCDJA','insumos'));
    }

    public function enviarEmail($id, Request $request)
    {
        $input = $request->all();
        $unidade = Unidades::where('id', $id)->get();
        $emailUnd = $unidade[0]->ouvidoria;
        $undsigla = 'Ouvidoria ' . $unidade[0]->sigla;
        $nomeClt  = $input['name'];
        $emailClt = $input['email'];
        $assunto =  $input['subject'];
        $texto   =  $input['message'];
        Mail::send([], [], function ($m) use ($nomeClt, $emailClt, $emailUnd, $assunto, $texto, $undsigla) {
            $m->from($emailClt, $nomeClt);
            $m->subject($assunto);
            $m->setBody($texto);
            $m->to($emailUnd);
        });
        $destaques = Destaques::where('status', 1)->get();
        $unidades  = Unidades::all();
        $murais    = Mural::where('status', 1)->get();
        $und_Princ = Unidades::where('id', $id)->get();
        $muraisDaUnd = array();
        for ($i = 0; $i < sizeof($murais); $i++) {
            $und_atuais = explode(",", $murais[$i]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais)) {
                array_push($muraisDaUnd, $murais[$i]->id);
            }
        }
        $destaDaUnd = array();
        for ($u = 0; $u < sizeof($destaques); $u++) {
            $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais2)) {
                array_push($destaDaUnd, $destaques[$u]->id);
            }
        }
        $validator = "Mensagem enviada com sucesso !!";
        return view('unidade', compact('destaques', 'destaDaUnd', 'unidade', 'unidades', 'murais', 'muraisDaUnd'));
    }
    
    
    public function ocorrencia()
    {
        $ocorrencias = Ocorrencias::all();
        $setor = Setor::all();
        $tiposOcorrencias = TiposOcorrencias::all();
        return view('ocorrencias.novaOcorrencia', compact('setor', 'ocorrencias', 'tiposOcorrencias'));
    }

    public function storeOcorrencia(Request $request)
    {
        $input = $request->all();
        $ocorrenciaDesc = Ocorrencias::where('id', $input['ocorrencia'])->get();
        $ocorrenciaDesc = $ocorrenciaDesc[0]->descricao;
        $input['ocorrencia'] = $ocorrenciaDesc;
        $input['classificar_incidente'] = implode(";", $input['classificar_incidente']);
        $OcorrenciasForm = OcorrenciasForm::create($input);
        $OcorrenciasForm = OcorrenciasForm::all();
        $validator = 'Ocorrencia enviada com Sucesso!';
        return redirect()->route('ocorrencia')
            ->withErrors($validator);
    }

    public function educacaoPermanente()
    {
        $unidades  = Unidades::all();
        return view('educacao_permanente', compact('unidades'));
    }

    public function educacaoPermanenteVideos()
    {
        $unidades = Unidades::all();
        $videos   = EducacaoPermanente::where('tipo',2)->get();
        return view('educacao_permanente_videos', compact('unidades', 'videos'));
    }

    public function educacaoPermanenteDocumentos()
    {
        $unidades   = Unidades::all();
        $documentos = EducacaoPermanente::where('tipo',1)->get();
        return view('educacao_permanente_documentos', compact('unidades','documentos'));
    }

    public function educacaoPermanenteQuiz()
    {
        $unidades  = Unidades::all();
        $quiz      = EducacaoPermanenteQuiz::all();
        $perguntas = EducacaoPermanentePerguntas::all();
        $respostas = EducacaoPermanenteRespostas::all();
        return view('educacao_permanente_quiz', compact('unidades','quiz','perguntas','respostas'));
    }

    public function questEducacaoP(Request $request)
    {
        $input     = $request->all();
        $quiz      = EducacaoPermanenteQuiz::all();
        $perguntas = EducacaoPermanentePerguntas::all();
        $respostas = EducacaoPermanenteRespostas::all();
        $unidades  = Unidades::all();
        $validator = Validator::make($request->all(), [
			'nome'       => 'required|max:1000',
			'matricula'  => 'required|max:10',
            'unidade_id' => 'required'
		]);
		if ($validator->fails()) {
			return view('educacao_permanente_quiz', compact('unidades','perguntas','quiz','respostas'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
            $input['nome'] = strtoupper($input['nome']);
            $respostas = EducacaoPermanenteRespostasQuiz::where('quiz_id',$input['quiz_id'])
                        ->where('matricula',$input['matricula'])->where('nome',$input['nome'])->get();            
            $qtd = sizeof($respostas);
            
            if ($qtd > 0) {
                $validator = "Você já respondeu esse Quiz!";
                $respostas = EducacaoPermanenteRespostas::all();
                return view('educacao_permanente_quiz', compact('unidades','perguntas','quiz','respostas'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            } else {
                $respostas = EducacaoPermanenteRespostasQuiz::create($input);            
                $validator = "Sua Resposta foi cadastrada com sucesso! Obrigado!";
                $respostas = EducacaoPermanenteRespostas::all();
                return view('educacao_permanente_quiz', compact('unidades','perguntas','quiz','respostas'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            }
        }
    }

    public function showPA()
    {
        $unidades = Unidades::all();
        return view('portal_assinaturas', compact('unidades'));
    }

    // Função para Retornar Tela de Manual Farmacêutico
    public function manualFarmacia() 
    {
        $topicos1 = Manual::where('id_menu', 0)->where('tipo', 1)->get(); 
        $topicos2 = Manual::where('id_menu', 0)->where('tipo', 2)->get(); 
        $topicoSelecionado  = '';
        $qtd  = 0;
        $qtd2 = 0;
        return view('manualFarmacia', compact('topicos1', 'topicos2', 'topicoSelecionado', 'qtd', 'qtd2'));
    }
    
    // Função para pesquisar e gerar iframe com PDF do Manual Farmacêutico para ser mostrado na tela
    public function iframeFarmacia(Request $request, $id)
    {
        $input = $request->all();
        $topicos1 = Manual::where('id_link', $id)->where('tipo', 1)->get(); 
        $topicos2 = Manual::where('id_link', $id)->where('tipo', 2)->get(); 
        $topicoSelecionado  = Manual::where('id', $id)->where('tipo', 1)->get();
        $qtd  = sizeof($topicoSelecionado);
        $topicoSelecionado2 = Manual::where('id', $id)->where('tipo', 2)->get();
        $qtd2 = sizeof($topicoSelecionado2); 
        return view('manualFarmacia', compact('topicos1', 'topicos2', 'topicoSelecionado', 'qtd' ,'topicoSelecionado2', 'qtd2'));
    }
}
