<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mural;
use App\Models\Unidades;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use Validator;
use Storage;

class MuralController extends Controller
{
	public function cadastroMural()
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$murais = Mural::all();
			return view('mural_avisos/mural_cadastro', compact('murais'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
	}

	public function pesquisarMural(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();
			if (empty($input['pesq'])) {
				$input['pesq'] = "";
			}
			if (empty($input['pesq2'])) {
				$input['pesq2'] = "";
			}
			$pesq  = $input['pesq'];
			$pesq2 = $input['pesq2'];
			if ($pesq2 == "1") {
				$murais = Mural::where('titulo', 'like', '%' . $pesq . '%')->get();
			} else if ($pesq2 == "2") {
				$murais = Mural::where('texto', 'like', '%' . $pesq . '%')->get();
			}
			return view('mural_avisos/mural_cadastro', compact('murais', 'pesq', 'pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
	}

	public function muralNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::all();
			return view('mural_avisos/mural_novo', compact('unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
	}

	public function storeMural(Request $request)
	{
		$unidades = Unidades::all();
		$input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if ($request->file('imagem') === NULL) {
			$validator = 'Selecione a imagem do Mural de Avisos!';
			return view('mural_avisos/mural_novo', compact('unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:1000',
					'titulo'      => 'required|max:255',
					'data_inicio' => 'required|date',
					'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('mural_avisos/mural_novo', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					//Verificação de unidades
					$Und = isset($input['unidade_id']);
					if ($Und == true) {
						$und_destaq = implode(',', $input['unidade_id']);
						$input['unidade_id'] = $und_destaq;
					} else {
						$und_destaq = "";
					}
					$request->file('imagem')->move('public/storage/mural_avisos/', $nome);
					$input['imagem'] = $nome;
					$input['caminho'] = 'mural_avisos/' . $nome;
					$murais = Mural::create($input);
					$murais = Mural::all();
					$id 	= Mural::all()->max('id');
					$input['idTabela'] = $id;
					$loggers = Logger::create($input);
					$validator = 'Mural de Aviso Cadastrado com Sucesso!';
					return redirect()->route('cadastroMural')
						->withErrors($validator)
						->with('murais', 'validator');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('mural_avisos/mural_novo', compact('unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function muralAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::all();
			$murais = Mural::where('id', $id)->get();
			$und_atual = explode(',', $murais[0]->unidade_id);
			return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
	}

	public function updateMural($id, Request $request)
	{
		$unidades = Unidades::all();
		$input = $request->all();
		$murais = Mural::where('id', $id)->get();
		$und_atual = explode(',', $murais[0]->unidade_id);
		$nome1 = "";
		if ($request->file('imagem') === NULL && $input['imagem_'] == "") {
			$validator = 'Selecione a imagem do Mural de Avisos!!';
			return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($request->file('imagem') !== null) {
				$nome1 = $_FILES['imagem']['name'];
				$extensao = pathinfo($nome1, PATHINFO_EXTENSION);
			} else {
				$nome2 = $input['imagem_'];
				$extensao = pathinfo($nome2, PATHINFO_EXTENSION);
			}
			if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:1000',
					'titulo'      => 'required|max:255',
					'data_inicio' => 'required|date',
					'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					if ($nome1 != "") {
						$request->file('imagem')->move('public/storage/mural_avisos/', $nome1);
						$input['imagem'] = $nome1;
						$input['caminho'] = 'mural_avisos/' . $nome1;
					}
					//Verificação de unidades
					$Und = isset($input['unidade_id']);
					if ($Und == true) {
						$und_destaq = implode(',', $input['unidade_id']);
						$input['unidade_id'] = $und_destaq;
					} else {
						$und_destaq = "";
					}
					$murais = Mural::find($id);
					$murais->update($input);
					$murais = Mural::all();
					$input['idTabela'] = $id;
					$loggers = Logger::create($input);
					$validator = 'Mural de Avisos Alterado com Sucesso!';
					return redirect()->route('cadastroMural')
						->withErrors($validator)
						->with('murais', 'validator');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function muralExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$murais = Mural::where('id', $id)->get();
			return view('mural_avisos/mural_excluir', compact('murais'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
	}

	public function destroyMural($id, Request $request)
	{
		$input = $request->all();
		$data  = Mural::find($id);
		$image_path = public_path() . '/storage/' . $data->caminho;
		unlink($image_path);
		$data->delete();
		$murais = Mural::all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		$validator = 'Mural de Avisos excluído com sucesso!';
		return redirect()->route('cadastroMural')
			->withErrors($validator)
  			->with('murais');
	}
}
