<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilUser;
use App\Models\UserPerfil;
use App\Models\PerfilUserIndica;
use App\Http\Controllers\PermissaoController;
use App\Models\Logger;
use Storage;
use DB;
use Validator;
use Auth;

class PerfilUserController extends Controller
{
	public function cadastroPerfilUsuarios()
	{
		$id_user = Auth::user()->id;
		$idTela = 15;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$perfil_users = PerfilUser::all();
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'));
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

	public function pesquisarPerfilUsuarios(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 15;
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
				$perfil_users = PerfilUser::where('nome', 'like', '%' . $pesq . '%')->get();
			}
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users', 'pesq', 'pesq2'));
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

	public function usuariosPerfilNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 15;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			return view('perfil_users/perfil_users_novo');
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

	public function storePerfilUsuarios(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('perfil_users/perfil_users_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$perfil_users = PerfilUser::create($input);
			$perfil_users = PerfilUser::all();
			$validator = 'Perfil do Usuário Cadastrado com Sucesso!';
			$id = PerfilUser::all()->max('id');
			$input['idTabela'] = $id;
			$input['user_id']  = $input['user_id_'];
			$loggers = Logger::create($input);
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function usuariosPerfilAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 15;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$perfil_users = PerfilUser::where('id', $id)->get();
			return view('perfil_users/perfil_users_alterar', compact('perfil_users'));
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

	public function updatePerfilUsuarios($id, Request $request)
	{
		$input   = $request->all();
		$perfil_users = PerfilUser::where('id', $id)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('perfil_users/perfil_users_alterar', compact('perfil_users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$perfil_users = PerfilUser::find($id);
			$perfil_users->update($input);
			$perfil_users = PerfilUser::all();
			$input['idTabela'] = $id;
			$input['user_id']  = $input['user_id_'];
			$loggers = Logger::create($input);
			$validator = 'Perfil do Usuário Alterado com Sucesso!';
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function usuariosPerfilExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 15;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$perfil_users = PerfilUser::where('id', $id)->get();
			return view('perfil_users/perfil_users_excluir', compact('perfil_users'));
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

	public function destroyPerfilUsuarios($id, Request $request)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$input['user_id']  = $input['user_id_'];
		$loggers = Logger::create($input);
		$UserPerfil = UserPerfil::where('perfil_id', $id)->get();
		$indicadorPerfil = PerfilUserIndica::where('perfil_id', $id)->get();
		if (sizeof($UserPerfil) == 0 && $indicadorPerfil == 0) {
			PerfilUser::find($id)->delete();
			$perfil_users = PerfilUser::all();
			$validator = 'Perfil do Usuário excluído com sucesso!';
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$perfil_users = PerfilUser::all();
			$validator = 'Não foi possivel excluir, existem usuários e/ou indicadores vinculados a este perfil !';
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}
}
