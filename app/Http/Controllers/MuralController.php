<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mural;
use App\Models\Unidades;
use App\Models\UserPerfil;
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
		if ($validacao == "ok") {
			$murais = Mural::paginate(20);
			return view('mural_avisos/mural_cadastro', compact('murais'));
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
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
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
				$murais = Mural::where('titulo', 'like', '%' . $pesq . '%')->paginate(20);
			} else if ($pesq2 == "2") {
				$murais = Mural::where('texto', 'like', '%' . $pesq . '%')->paginate(20);
			}
			return view('mural_avisos/mural_cadastro', compact('murais', 'pesq', 'pesq2'));
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

	public function muralNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$unidades = Unidades::all();
			return view('mural_avisos/mural_novo', compact('unidades'));
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

	public function storeMural(Request $request)
	{
		$unidades = Unidades::all();
		$input = $request->all();
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
			$Und = isset($input['unidade_id']);
			if ($Und == true) {
				$und_destaq = implode(',', $input['unidade_id']);
				$input['unidade_id'] = $und_destaq;
			} else {
				$und_destaq = "";
			}
			if ($input['tipo'] == 1) {
				$nome = $_FILES['imagem']['name'];
				$extensao = pathinfo($nome, PATHINFO_EXTENSION);
				if ($request->file('imagem') === NULL) {
					$validator = 'Selecione a imagem do Mural de Avisos!';
					return view('mural_avisos/mural_novo', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
						$request->file('imagem')->move('../public/storage/mural_avisos/', $nome);
						$input['imagem'] = $nome;
						$input['caminho'] = 'mural_avisos/' . $nome;
					} else {
						$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
						return view('mural_avisos/mural_novo', compact('unidades'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					}
				}
				$input['videominiatura'] = "";
				$input['video'] = "";
			} else {
				if (isset($input['video'])) {
					if ($input['videoFotoPadrao'] == 2 && $request->file('videominiatura')) {
						$nome = $_FILES['videominiatura']['name'];
						$extensao = pathinfo($nome, PATHINFO_EXTENSION);
						if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
							$rand = rand(0, 9999);
							$nome = $input['titulo'] . $rand . ".jpg";
							$request->file('videominiatura')->move('../public/storage/mural_avisos/videos/miniaturas/', $nome);
							$input['videominiatura'] = 'mural_avisos/videos/miniaturas/' . $nome;
						} else {
							$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
							return view('mural_avisos/mural_novo', compact('unidades'))
								->withErrors($validator)
								->withInput(session()->flashInput($request->input()));
						}
					} else {
						$input['videominiatura'] = "";
					}

					$link = explode(" ", $input['video']);
					for ($i = 0; $i < sizeof($link); $i++) {
						if (strpos($link[$i], 'src="') !== false) {
							$video = $link[$i];
						}
					}
					if (isset($video)) {
						$video = explode('"', $video);
						$video =  $video[1];
						$input['video'] = $video;
						$input['imagem'] = "";
						$input['caminho'] = "";
					} else {
						$validator = 'O link precisa ser do tipo incorporado, verifique o manual.';
						return view('mural_avisos/mural_novo', compact('unidades'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					}
				} else {
					$validator = 'O link incorporado do video não foi inserido';
					return view('mural_avisos/mural_novo', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			}
			$murais = Mural::create($input);
			$murais = Mural::all();
			$id 	= Mural::all()->max('id');
			$input['idTabela'] = $id;
			$loggers = Logger::create($input);
			$murais = Mural::paginate(20);
			$validator = 'Mural de Aviso Cadastrado com Sucesso!';
			return redirect()->route('cadastroMural')
				->withErrors($validator)
				->with('murais', 'validator');
		}
	}

	public function muralAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$murais = Mural::where('id', $id)->get();
			if (sizeof($murais) == 0) {
				$validator = "Aviso não localizado.";
				return redirect()->route('cadastroMural')
					->withErrors($validator)
					->with('perfil_user', 'validator');
			} else {
				$unidades = Unidades::all();
				$und_atual = explode(',', $murais[0]->unidade_id);
				return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'));
			}
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

	public function updateMural($id, Request $request)
	{
		$unidades = Unidades::all();
		$input = $request->all();
		$murais = Mural::where('id', $id)->get();
		if (sizeof($murais) == 0) {
			$validator = "Aviso não localizado.";
			return redirect()->route('cadastroMural')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		} else {
			$und_atual = explode(',', $murais[0]->unidade_id);
			$validator = Validator::make($request->all(), [
				'texto'       => 'required|max:800',
				'titulo'      => 'required|max:255',
				'data_inicio' => 'required|date',
				'data_fim'    => 'required|date'
			]);
			if ($validator->fails()) {
				return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				if ($input['tipo'] == 1) {
					$input['videominiatura'] = $murais[0]->videominiatura;
					$input['video'] = $murais[0]->video;
					if ($murais[0]->caminho == "") {
						if ($request->file('imagem')) {
							$nome = $_FILES['imagem']['name'];
							$extensao = pathinfo($nome, PATHINFO_EXTENSION);
							if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
								$rand = rand(0, 9999);
								$nome = $input['titulo'] . $rand . "." . $extensao;
								$request->file('imagem')->move('../public/storage/mural_avisos/', $nome);
								$input['imagem'] = $nome;
								$input['caminho'] = 'mural_avisos/' . $nome;
							} else {
								$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
								return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
									->withErrors($validator)
									->withInput(session()->flashInput($request->input()));
							}
						} else {
						$validator = 'Você precisar escolher uma imagem.';
						return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
						}
					} 
				} else {
					$input['caminho'] = $murais[0]->caminho;
					$input['imagem'] = $murais[0]->imagem;
					if ($input['videoFotoPadrao'] == 2 && $request->file('videominiatura')) {
						$nome = $_FILES['videominiatura']['name'];
						$extensao = pathinfo($nome, PATHINFO_EXTENSION);
						$rand = rand(0, 9999);
						$nome = $input['titulo'] . $rand . ".jpg";
						if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
							$request->file('videominiatura')->move('../public/storage/mural_avisos/videos/miniaturas/', $nome);
							$input['videominiatura'] = 'mural_avisos/videos/miniaturas/' . $nome;
						} else {
							$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
							return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
								->withErrors($validator)
								->withInput(session()->flashInput($request->input()));
						}
					} else {
						$input['videominiatura'] = "";
					}
					if ($murais[0]->video !== $input['video']) {
						if (isset($input['video'])) {
							$link = explode(" ", $input['video']);
							for ($i = 0; $i < sizeof($link); $i++) {
								if (strpos($link[$i], 'src="') !== false) {
									$video = $link[$i];
								}
							}
							if (isset($video)) {
								$video = explode('"', $video);
								$video =  $video[1];
								$input['video'] = $video;
								$input['imagem'] = "";
								$input['caminho'] = "";
							} else {
								$validator = 'O link precisa ser do tipo incorporado, verifique o manual.';
								return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
									->withErrors($validator)
									->withInput(session()->flashInput($request->input()));
							}
						} else {
							$validator = 'Você precisa inserir o link incorporado do video';
							return view('mural_avisos/mural_alterar', compact('murais', 'unidades', 'und_atual'))
								->withErrors($validator)
								->withInput(session()->flashInput($request->input()));
						}
					}
				}
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
				$murais = Mural::paginate(20);
				$validator = 'Mural de Avisos Alterado com Sucesso!';
				return redirect()->route('cadastroMural')
					->withErrors($validator)
					->with('murais', 'validator');
			}
		}
	}

	public function muralExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela  = 1;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$murais = Mural::where('id', $id)->get();
			if (sizeof($murais) == 0) {
				$validator = 'Aviso não localizado.';
				return redirect()->route('cadastroMural')
					->withErrors($validator)
					->with('murais', 'validator');
			} else {
				return view('mural_avisos/mural_excluir', compact('murais'));
			}
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

	public function destroyMural($id, Request $request)
	{
		$input = $request->all();
		$data  = Mural::find($id);
		$input['status'] = 0;
		$data->update($input);
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		$validator = 'Mural de Avisos excluído com sucesso!';
		return redirect()->route('cadastroMural')
			->withErrors($validator)
			->with('murais');
	}
}
