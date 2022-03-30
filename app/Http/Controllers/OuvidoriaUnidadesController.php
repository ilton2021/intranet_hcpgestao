<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OuvidoriaUnidades;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Models\UserPerfil;
use App\Http\Controllers\PermissaoController;
use Validator;
use DB;
use Storage;

class OuvidoriaUnidadesController extends Controller
{
	public function cadastroOuvidorias()
	{
		$id_user = Auth::user()->id;
		$idTela = 8;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$ouvidorias = OuvidoriaUnidades::paginate(20);
			return view('ouvidoria_unidades/ouvidoria_unidades_cadastro', compact('ouvidorias'));
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

	public function pesquisarOuvidorias(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 8;
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
				$ouvidorias = OuvidoriaUnidades::where('nome', 'like', '%' . $pesq . '%')->paginate(20);
			}
			return view('ouvidoria_unidades/ouvidoria_unidades_cadastro', compact('ouvidorias', 'pesq', 'pesq2'));
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

	public function ouvidoriasNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 8;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			return view('ouvidoria_unidades/ouvidoria_unidades_novo');
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

	public function storeOuvidorias(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('ouvidoria_unidades/ouvidoria_unidades_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$ouvidorias = OuvidoriaUnidades::create($input);
			$ouvidorias = OuvidoriaUnidades::all();
			$id = OuvidoriaUnidades::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$ouvidorias = OuvidoriaUnidades::paginate(20);
			$validator = 'Ouvidoria da Unidade Cadastrado com Sucesso!';
			return redirect()->route('cadastroOuvidorias')
				->withErrors($validator)
				->with('ouvidorias');
		}
	}

	public function ouvidoriasAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 8;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
			return view('ouvidoria_unidades/ouvidoria_unidades_alterar', compact('ouvidorias'));
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

	public function updateOuvidorias($id, Request $request)
	{
		$input   = $request->all();
		$ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
		]);
		if ($validator->fails()) {
			return view('ouvidoria_unidades/ouvidoria_unidades_alterar', compact('ouvidorias'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$ouvidorias = OuvidoriaUnidades::find($id);
			$ouvidorias->update($input);
			$ouvidorias = OuvidoriaUnidades::all();
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$ouvidorias = OuvidoriaUnidades::paginate(20);
			$validator = 'Ouvidoria da Unidade Alterado com Sucesso!';
			return redirect()->route('cadastroOuvidorias')
				->withErrors($validator)
				->with('ouvidorias');
		}
	}

	public function ouvidoriasExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 8;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
			return view('ouvidoria_unidades/ouvidoria_unidades_excluir', compact('ouvidorias'));
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

	public function destroyOuvidorias($id, Request $request)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers   = Logger::create($input);
		OuvidoriaUnidades::find($id)->delete();
		$input = $request->all();
		$ouvidorias = OuvidoriaUnidades::all();
		$ouvidorias = OuvidoriaUnidades::paginate(20);
		$validator = 'Ouvidoria da Unidade excluído com sucesso!';
		return redirect()->route('cadastroOuvidorias')
			->withErrors($validator)
			->with('ouvidorias');
	}
}
