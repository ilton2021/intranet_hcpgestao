<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manual;
use App\Models\ManualFarmacia;
use App\Models\Topico;
use App\Models\Subtopicos;
use App\Models\Subtopico2;
use App\Models\Arquivo;
use App\Models\Unidades;
use App\Models\UserPerfil;
use App\Http\Controllers\PermissaoUserController;
use App\Http\Controllers\PerfilUserController;
use Validator;
use DB;
use Auth;

class ManuaisController extends Controller
{
    public function listaManuais()
    {
        $id_user = Auth::user()->id;
		$idTela  = 20;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$manuais = Manual::all();
            return view('manuais/lista_manuais', compact('manuais'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function pesquisarMural(Request $request)
    {  
		$id_user = Auth::user()->id;
		$idTela  = 20;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
			if(empty($input['pesq_nome'])) { $input['pesq_nome'] = ""; }
            if(empty($input['pesq_tipo'])) { $input['pesq_tipo'] = ""; }
			if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
			$pesq_nome = $input['pesq_nome'];
            $pesq_tipo = $input['pesq_tipo'];
			$pesq2 = $input['pesq2'];
			if ($pesq2 == "1") { 
                if($pesq_nome == "" && $pesq_tipo == "") { 
                    $manuais = Manual::all();
                } else if ($pesq_nome != "") {
                    $manuais = Manual::where('titulo','like','%'.$pesq_nome.'%')->get();
                } else if ($pesq_tipo != "") {
                    $manuais = Manual::where('titulo','like','%'.$pesq_tipo.'%')->get();
                }
			} else if ($pesq2 == "2") {
				$manuais = Manual::where('tipo','like','%'.$pesq_tipo.'%')->get();
			}
			return view('manuais/lista_manuais', compact('manuais'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function novoManual()
    {
        $id_user = Auth::user()->id;
		$idTela  = 20;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$menusManuais = Manual::where('tipo_doc', 2)->get(); 
            $unidades     = Unidades::where('id', 7)->get();
            return view('manuais/novo_manual', compact('unidades', 'menusManuais'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function storeManual(Request $request)
    { 
        $input = $request->all();
        if($input['tipo_doc'] == 1) {
            $nome = $_FILES['arquivo']['name'];
            $input['arquivo'] = $nome;
            if($request->file('arquivo') === NULL) {
                $validator = 'Insira um arquivo para que o Manual seja validado!';
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput(session()->flashInput($request->input()));
            } else {
                $extensao = pathinfo($nome, PATHINFO_EXTENSION);
                if ($extensao == 'pdf' || $extensao == 'html'){
                    $validator = Validator::make($request->all(), [
                        'titulo' => 'required|max:255'
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput(session()->flashInput($request->input()));
                    } else {
                        if($input['tipo'] == 1) { $pasta = 'manualFarmacia'; } else { $pasta = 'manualInstitucional'; }
                        $request->file('arquivo')->move('storage/manual/'.$pasta.'/', $nome);
                        $input['nome_arq'] = $nome; 
                        $input['caminho'] = 'manual/'.$pasta.'/'.$nome; 
                        $manual    = Manual::create($input);
                        $validator = 'Manual da Farmácia criado com Sucesso.';
                        $manuais   = Manual::all();
                        return redirect()->route('listaManuais', compact('manuais'))->withErrors($validator);
                    }
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                       ->withErrors($validator)
                       ->withInput(session()->flashInput($request->input()));
            } else {
                $manual    = Manual::create($input);
                $validator = 'Manual da Farmácia criado com Sucesso.';
                $manuais   = Manual::all();
                return redirect()->route('listaManuais', compact('manuais'))->withErrors($validator);
            }
        }
    }

    public function alterarManual($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 20;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
            $menusManuais = Manual::where('tipo_doc', 2)->get(); 
			$manual       = Manual::where('id', $id)->get();
            return view('manuais/alterar_manual', compact('manual','menusManuais'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function updateManual(Request $request, $id)
    {
        $input = $request->all();
        if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
            return redirect()->route('listaManuais')
                    ->withErrors($validator)
                    ->with('manuais');
        } else {
            if($request->file('imagem') !== null) {
                $nome = $_FILES['imagem']['name'];
                $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            } else {
                $nome = $input['imagem_'];	
                $extensao = pathinfo($nome, PATHINFO_EXTENSION);
            }			
            if ($extensao == 'pdf' || $extensao == 'html'){
                $validator = Validator::make($request->all(), [
                    'titulo' => 'required|max:255'
                ]);
                if ($validator->fails()) {
                    return redirect()->route('listaManuais')
                           ->withErrors($validator)
                           ->with('manuais');
                } else {
                    if($nome != "") {
                        if($input['tipo'] == 1) { $pasta = 'manualFarmacia'; } else { $pasta = 'manualInstitucional'; }
                        $request->file('imagem')->move('storage/manual/'.$pasta.'/', $nome);
                        $input['nome_arq'] = $nome; 
                        $input['caminho'] = 'manual/'.$pasta.'/'.$nome; 
                    } 
                    $manuais = Manual::find($id);
                    $manuais->update($input);
                    $manuais   = Manual::all();
                    $validator ='Manual Alterada com Sucesso!';
                    return redirect()->route('listaManuais', compact('manuais'))->withErrors($validator);
                }
            } else {
                $validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
                return redirect()->route('listaManuais')
                        ->withErrors($validator)
                        ->with('manuais');
            }
        }
    }

    public function excluirManual($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 20;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
            $menusManuais = Manual::where('tipo_doc', 2)->get(); 
            $manual = Manual::where('id', $id)->get();
            return view('manuais/excluir_manual', compact('manual','menusManuais'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function destroyManual($id, Request $request)
    {
        $input = $request->all();
        $topico = Manual::find($id)->delete();
        $topicos = Manual::all();
        $validator = 'Manual deletado com sucesso.';
        return redirect()->route('listaManuais')
                ->withErrors($validator)
                ->with('topicos');
    }
}
