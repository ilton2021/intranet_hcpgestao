<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProtocolosInstitucionais;
use App\Models\SetorDocumento;
use App\Models\Logger;
use App\Models\Unidades;
use App\Models\UserPerfil;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use DB;
use Storage;
use Validator;

class ProtocolosInstitucionaisController extends Controller
{
    public function cadastroProtocolos()
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$protocolos = ProtocolosInstitucionais::paginate(20);
        	return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos'));
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

    public function pesquisarProtocolos(Request $request)
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
			if(empty($input['pesq'])) { $input['pesq'] = ""; }
			if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
			$pesq  = $input['pesq'];
			$pesq2 = $input['pesq2']; 
			if($pesq2 == "1") {
				$protocolos = ProtocolosInstitucionais::where('nome','like','%'.$pesq.'%')->paginate(20);
			} else if($pesq2 == "2"){
				$protocolos = ProtocolosInstitucionais::where('setor','like','%'.$pesq.'%')->paginate(20);
			}
			return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos','pesq','pesq2'));
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

    public function protocolosNovo()
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
			$unidades = Unidades::all();
        	return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores','unidades'));
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

    public function storeProtocolos(Request $request)
    {
        $input    = $request->all();
        $setores  = Setor::all();
		$unidades = Unidades::all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione o arquivo do Protocolo Institucional!';
			return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores','unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores','unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('../public/storage/protocolos_institucionais/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'protocolos_institucionais/'.$nome; 
					$Und = isset($input['unidade_id']);
					if ($Und == true) {
						$und_destaq = implode(',', $input['unidade_id']);
						$input['unidade_id'] = $und_destaq;
					} else {
						$und_destaq = "";
					}
					$protocolos = ProtocolosInstitucionais::create($input);
					$protocolos = ProtocolosInstitucionais::all();
					$id = ProtocolosInstitucionais::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$protocolos = ProtocolosInstitucionais::paginate(20);
					$validator = 'Protocolo Institucional Cadastrado com Sucesso!';
					return redirect()->route('cadastroProtocolos')
						->withErrors($validator)
						->with('protocolos', 'setores');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores','unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function protocolosAlterar($id)
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$protocolos = ProtocolosInstitucionais::where('id',$id)->get();
			$setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
			$unidades   = Unidades::all();
			return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores','unidades'));
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

    public function updateProtocolos($id, Request $request)
    {
        $input = $request->all();
		$nome1 = "";
        $setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
        $protocolos = ProtocolosInstitucionais::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione o arquivo do Protocolo Institucional!';	
			return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($request->file('imagem') !== null) {
			   $nome1 = $_FILES['imagem']['name'];
			   $extensao = pathinfo($nome1, PATHINFO_EXTENSION);
			} else {
			   $nome2 = $input['imagem_'];	
			   $extensao = pathinfo($nome2, PATHINFO_EXTENSION);
			}			
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255',
            	]);
				if ($validator->fails()) {
					return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/protocolos_institucionais/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'protocolos_institucionais/'.$nome1; 
					} 
					$protocolos = ProtocolosInstitucionais::find($id); 
					$protocolos->update($input);
					$protocolos = ProtocolosInstitucionais::all();
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$protocolos = ProtocolosInstitucionais::paginate(20);
					$validator ='Protocolo Institucional Alterado com Sucesso!';
					return redirect()->route('cadastroProtocolos')
						->withErrors($validator)
						->with('protocolos', 'setores');
				}
			} else {
				$validator = 'Só é permitido arquivos: .pdf!';
				return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function protocolosExcluir($id)
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$protocolos = ProtocolosInstitucionais::where('id',$id)->get();
        	return view('protocolos_institucionais/protocolos_institucionais_excluir', compact('protocolos'));
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

    public function destroyProtocolos($id, Request $request)
    {
        $input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		$data    = ProtocolosInstitucionais::find($id);
		$image_path = public_path().'/storage/'.$data->caminho;
        unlink($image_path);
        $data->delete();
		$protocolos = ProtocolosInstitucionais::paginate(20);
        $validator = 'Protocolo Institucional excluído com sucesso!';
		return redirect()->route('cadastroProtocolos')
			->withErrors($validator)
			->with('protocolos', 'setores');
    }
}
