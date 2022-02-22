<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use Validator;
use Storage;
use PDOException;

class UnidadesController extends Controller
{
    public function cadastroUnidade()
	{
		$id_user = Auth::user()->id;
		$idTela = 3;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::all();
        	return view('unidades/unidades_cadastro', compact('unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarUnidade(Request $request)
    {  
		$id_user = Auth::user()->id;
		$idTela = 3;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
			if(empty($input['pesq'])) { $input['pesq'] = ""; }
			if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
			$pesq  = $input['pesq'];
			$pesq2 = $input['pesq2']; 
			if($pesq2 == "1") {
				$unidades = Unidades::where('nome','like','%'.$pesq.'%')->get();
			} else if($pesq2 == "2"){
				$unidades = Unidades::where('sigla','like','%'.$pesq.'%')->get();
			}
			return view('unidades/unidades_cadastro', compact('unidades','pesq','pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function unidadeNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 3;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			return view('unidades/unidades_novo');
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeUnidade(Request $request){
        $input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione a imagem da Unidade!';
			return view('unidades/unidades_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'nome'         => 'required|max:255',
					'sigla'        => 'required|max:20',
                    'horario'      => 'required|max:255',
                    'telefone'     => 'required|max:14',
                    'ouvidoria'    => 'required|email',
                    'texto'        => 'required|max:1000',
                    'endereco'     => 'required|max:100'
				]);
				if ($validator->fails()) {
					return view('unidades/unidades_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('public/storage/unidades/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'unidades/'.$nome; 
					$unidade  = Unidades::create($input);
					$unidades = Unidades::all();
					$id = Unidades::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$validator = 'Unidade Cadastrada com Sucesso!';
					return view('unidades/unidades_cadastro', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('unidades/unidades_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function unidadeAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 3;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::where('id',$id)->get();
        	return view('unidades/unidades_alterar', compact('unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		} 
    }

    public function updateUnidade($id, Request $request){
        $input = $request->all();
		$nome1 = "";
        $unidades = Unidades::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione a imagem da Unidade!!';		
			return view('unidades/unidades_alterar', compact('unidades'))
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
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'nome'         => 'required|max:255',
					'sigla'        => 'required|max:20',
                    'horario'      => 'required|max:255',
                    'telefone'     => 'required|max:14',
                    'ouvidoria'    => 'required|email',
                    'texto'        => 'required|max:1000',
                    'endereco'     => 'required|max:100'
				]);
				if ($validator->fails()) {
					return view('unidades/unidades_alterar', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('public/storage/unidades/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'unidades/'.$nome1; 
					} 
					$unidade = Unidades::find($id); 
					$unidade->update($input);
					$unidades = Unidades::all();
					$input['idTabela'] = $id;
					$loggers = Logger::create($input);
					$validator ='Unidade Alterada com Sucesso!';
					return redirect()->route('cadastroUnidade')
						->withErrors($validator)
						->with('unidades');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('unidades/unidades_alterar', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function unidadeExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 3;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::where('id',$id)->get();
        	return view('unidades/unidades_excluir', compact('unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyUnidade($id, Request $request){
        $input = $request->all();
		$data  = Unidades::find($id);
		$image_path = public_path().'/storage/'.$data->caminho;
        unlink($image_path);
        $data->delete();
		try {
			$data->delete();
		} catch (PDOException $e) {
			$unidades = unidades::all();
			$validator = "Não é possivel excluir, existem cadastros relacionados a mesma.";
			return view('unidades/unidades_excluir', compact('unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
		$unidades = Unidades::all();
        $validator = 'Unidade excluída com sucesso!';
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		return redirect()->route('cadastroUnidade')
			->withErrors($validator)
			->with('unidades');
    }
}
