<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProtocolosInstitucionais;
use App\Models\Setor;
use App\Models\Logger;
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
			$protocolos = ProtocolosInstitucionais::all();
        	return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
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
				$protocolos = ProtocolosInstitucionais::where('nome','like','%'.$pesq.'%')->get();
			} else if($pesq2 == "2"){
				$protocolos = ProtocolosInstitucionais::where('setor','like','%'.$pesq.'%')->get();
			}
			return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos','pesq','pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function protocolosNovo()
    {
		$id_user = Auth::user()->id;
		$idTela = 11;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = Setor::all();
        	return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeProtocolos(Request $request)
    {
        $input    = $request->all();
        $setores  = Setor::all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione o arquivo do Protocolo Institucional!';
			return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('public/storage/protocolos_institucionais/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'protocolos_institucionais/'.$nome; 
					$protocolos = ProtocolosInstitucionais::create($input);
					$protocolos = ProtocolosInstitucionais::all();
					$id = ProtocolosInstitucionais::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$validator = 'Protocolo Institucional Cadastrado com Sucesso!';
					return redirect()->route('cadastroProtocolos')
						->withErrors($validator)
						->with('protocolos', 'setores');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
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
			$setores    = Setor::all();
			return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updateProtocolos($id, Request $request)
    {
        $input = $request->all();
		$nome1 = "";
        $setores    = Setor::all();
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
					  $request->file('imagem')->move('public/storage/protocolos_institucionais/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'protocolos_institucionais/'.$nome1; 
					} 
					$protocolos = ProtocolosInstitucionais::find($id); 
					$protocolos->update($input);
					$protocolos = ProtocolosInstitucionais::all();
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
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
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
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
		$protocolos = ProtocolosInstitucionais::all();
        $validator = 'Protocolo Institucional excluído com sucesso!';
		return redirect()->route('cadastroProtocolos')
			->withErrors($validator)
			->with('protocolos', 'setores');
    }
}
