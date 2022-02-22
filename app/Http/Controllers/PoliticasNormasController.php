<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticasNormas;
use App\Models\Setor;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Validator;
use Storage;

class PoliticasNormasController extends Controller
{
    public function cadastroPoliticas()
    {
		$id_user = Auth::user()->id;
		$idTela = 12;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$politicas = PoliticasNormas::all();
        	return view('politicas_normas/politicas_normas_cadastro', compact('politicas'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarPoliticas(Request $request)
    {
		$id_user = Auth::user()->id;
		$idTela = 12;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
			if(empty($input['pesq'])) { $input['pesq'] = ""; }
			if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
			$pesq  = $input['pesq'];
			$pesq2 = $input['pesq2']; 
			if($pesq2 == "1") {
				$politicas = PoliticasNormas::where('nome','like','%'.$pesq.'%')->get();
			} else if($pesq2 == "2"){
				$politicas = PoliticasNormas::where('setor','like','%'.$pesq.'%')->get();
			}
			return view('politicas_normas/politicas_normas_cadastro', compact('politicas','pesq','pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function politicasNovo()
    {
		$id_user = Auth::user()->id;
		$idTela = 12;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = Setor::all();
        	return view('politicas_normas/politicas_normas_novo', compact('setores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storePoliticas(Request $request)
    {
        $input    = $request->all();
        $setores  = Setor::all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione o arquivo da Política e Normas!';
			return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('public/storage/politicas_normas/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'politicas_normas/'.$nome; 
					$politicas = PoliticasNormas::create($input);
					$politicas = PoliticasNormas::all();
					$id = PoliticasNormas::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$validator = 'Políticas e Normas Cadastrado com Sucesso!';
					return redirect()->route('cadastroPoliticas', 'setores')
						->withErrors($validator)
						->with('politicas');
				}
			} else {
				$validator = 'Só é permitido arquivos: .pdf!';		
				return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function politicasAlterar($id)
    {
		$id_user = Auth::user()->id;
		$idTela = 12;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$politicas = PoliticasNormas::where('id',$id)->get();
			$setores   = Setor::all();
			return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updatePoliticas($id, Request $request)
    {
        $input = $request->all();
		$nome1 = "";
        $setores   = Setor::all();
        $politicas = PoliticasNormas::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione o arquivo da Política e Normas!';	
			return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'))
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
					return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('public/storage/politicas_normas/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'politicas_normas/'.$nome1; 
					} 
					$politicas = PoliticasNormas::find($id); 
					$politicas->update($input);
					$politicas = PoliticasNormas::all();
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$validator ='Polícitas e Normas Alterado com Sucesso!';
					return redirect()->route('cadastroPoliticas')
						->withErrors($validator)
						->with('politicas','setores');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('politicas_normas/politicas_normas_alterar', compact('politicas'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function politicasExcluir($id)
    {
		$id_user = Auth::user()->id;
		$idTela = 12;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$politicas = PoliticasNormas::where('id',$id)->get();
        	return view('politicas_normas/politicas_normas_excluir', compact('politicas'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyPoliticas($id, Request $request)
    {
        $input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
	    $data    = PoliticasNormas::find($id);
	    $image_path = public_path().'/storage/'.$data->caminho;
	    unlink($image_path);
	    $data->delete();
		$politicas = PoliticasNormas::all();
        $validator = 'Políticas e Normas excluído com sucesso!';
		return redirect()->route('cadastroPoliticas')
			->withErrors($validator)
			->with('politicas');
    }
}