<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destaques;
use App\Models\Unidades;
use App\Models\Logger;
use App\Models\UserPerfil;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Validator;
use Storage;

class DestaquesController extends Controller
{
	public function cadastroDestaques()
	{
		$id_user = Auth::user()->id;
		$idTela = 2;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$destaques = Destaques::paginate(20);
			return view('destaques/destaques_cadastro', compact('destaques'));
		} else {
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

	public function pesquisarDestaques(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 2;
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
				$destaques = Destaques::where('titulo', 'like', '%' . $pesq . '%')->paginate(20);
			} else if ($pesq2 == "2") {
				$destaques = Destaques::where('texto', 'like', '%' . $pesq . '%')->paginate(20);
			}
			$destaques = Destaques::paginate(20);
			return view('destaques/destaques_cadastro', compact('destaques', 'pesq', 'pesq2'));
		} else {
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

	public function destaquesNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 2;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$unidades = Unidades::all();
			return view('destaques/destaques_novo', compact('unidades'));
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

	public function storeDestaques(Request $request)
	{
		$unidades = Unidades::all();
		$input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if ($request->file('imagem') === NULL) {
			$validator = 'Selecione a imagem do Destaque!';
			return view('destaques/destaques_novo', compact('unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:8000',
					'titulo'      => 'required|max:255',
					'data_inicio' => 'required|date',
					'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('destaques/destaques_novo', compact('unidades'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$request->file('imagem')->move('public/storage/destaques/', $nome);
					$input['imagem'] = $nome;
					$input['caminho'] = 'destaques/' . $nome;
					for ($a = 2; $a <= 6; $a++) {
						if ($request->file('imagem' . $a) != NULL) {
							$nome1 = $_FILES['imagem' . $a]['name'];
							$input['imagem' . $a]  = $nome1;
							$input['caminho' . $a] = 'destaques/' . $nome1;
							$request->file('imagem' . $a)->move('public/storage/destaques/', $nome1);
						} else {
							$input['imagem' . $a]  = "";
							$input['caminho' . $a] = "";
						}
					}
					//Verificação de unidades
					$Und = isset($input['unidade_id']);
					if ($Und == true) {
						$und_destaq = implode(',', $input['unidade_id']);
						$input['unidade_id'] = $und_destaq;
					} else {
						$und_destaq = "";
					}
					$destaques = Destaques::create($input);
					$destaques = Destaques::all();
					$id = Destaques::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$destaques = Destaques::paginate(20);
					$validator = 'Destaque Cadastrado com Sucesso!';
					return redirect()->route('cadastroDestaques')
						->withErrors($validator)
						->with('destaques', 'validator');
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('destaques/destaques_novo', compact('unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function destaquesAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 2;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$unidades = Unidades::all();
			$destaques = Destaques::where('id', $id)->get();
			$und_atual = explode(',', $destaques[0]->unidade_id);
			return view('destaques/destaques_alterar', compact('destaques', 'unidades', 'und_atual'));
		} else {
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

	public function updateDestaques($id, Request $request)
	{
		$unidades = Unidades::all();
		$destaques = Destaques::where('id', $id)->get();
		$und_atual = explode(',', $destaques[0]->unidade_id);
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'texto'       => 'required|max:8000',
			'titulo'      => 'required|max:255',
			'data_inicio' => 'required|date',
			'data_fim'    => 'required|date'
		]);
		if ($validator->fails()) {
			return view('destaques/destaques_alterar', compact('destaques', 'unidades', 'und_atual'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($request->file('imagem') !== NULL) {
				$nome1 = $_FILES['imagem']['name'];
				$extensao = strtolower(pathinfo($nome1, PATHINFO_EXTENSION));
				if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
					$request->file('imagem')->move('public/storage/destaques/', $nome1);
					$input['imagem'] = $nome1;
					$input['caminho'] = 'destaques/' . $nome1;
				} else {
					$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
					return view('destaques/destaques_alterar', compact('destaques', 'unidades', 'und_atual'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} elseif ($input['imagem_'] !== NULL) {
				$nome2 = $input['imagem_'];
				$extensao = strtolower(pathinfo($nome2, PATHINFO_EXTENSION));
				if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
					$input['imagem'] = $nome2;
					$input['caminho'] = 'destaques/' . $nome2;
				}
			} else {
				$validator = 'Selecione a imagem principal do Destaque!!';
				return view('destaques/destaques_alterar', compact('destaques', 'unidades', 'und_atual'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
			//Verificação de imagens secundárias
			$extenIncor = array();
			for ($a = 2; $a <= 6; $a++) {
				$imagem = $_FILES['imagem' . $a]['name'];
				if ($request->file('imagem' . $a) != "") {
					$extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
					if ($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
						$nome = $_FILES['imagem' . $a]['name'];
						$input['imagem' . $a]  = $imagem;
						$input['caminho' . $a] = 'destaques/' . $imagem;
						$request->file('imagem' . $a)->move('public/storage/destaques/', $imagem);
					} else {
						$extenIncor[$a] = $a;
					}
				} else {
					if (isset($input['imagem' . $a . '_']) == false) {
						$input['imagem' . $a] = "";
						$input['caminho' . $a] = "";
					}
				}
			}
			//Verificação de erros de extensão das imagens secundárias
			if (sizeof($extenIncor) > 0) {
				$validator = 'As extencoes das imagens ' . implode(", ", $extenIncor) . 'está(ão) incorreto(as) Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('destaques/destaques_alterar', compact('destaques', 'unidades', 'und_atual'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
			//Verificação de unidades
			$Und = isset($input['unidade_id']);
			if ($Und == true) {
				$und_destaq = implode(',', $input['unidade_id']);
				$input['unidade_id'] = $und_destaq;
			}
			$destaques = Destaques::find($id);
			$destaques->update($input);
			$destaques = Destaques::all();
			$input['idTabela'] = $id;
			$loggers = Logger::create($input);
			$destaques = Destaques::paginate(20);
			$validator = 'Destaque Alterado com Sucesso!';
			return redirect()->route('cadastroDestaques')
				->withErrors($validator)
				->with('destaques', 'validator');
		}
	}

	public function destaquesExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 2;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$destaques = Destaques::where('id', $id)->get();
			return view('destaques/destaques_excluir', compact('destaques'));
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

	public function destroyDestaques($id, Request $request)
	{
		$input = $request->all();
		$data = Destaques::find($id);
		$image_path = public_path() . '/storage/' . $data->caminho;
		unlink($image_path);
		$data->delete();
		$destaques = Destaques::all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		$destaques = Destaques::paginate(20);
		$validator = 'Destaque excluído com sucesso!';
		return redirect()->route('cadastroDestaques')
			->withErrors($validator)
			->with('destaques');
	}
}
