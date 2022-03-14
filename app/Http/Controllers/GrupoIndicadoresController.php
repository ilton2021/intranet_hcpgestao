<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrupoIndicadores;
use App\Models\PerfilUser;
use App\Models\GrupoPerfilUser;
use App\Models\UserPerfil;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use Storage;
use DB;
use Validator;

class GrupoIndicadoresController extends Controller
{
	public function cadastroGrupoIndicadores()
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::all();
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'));
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

	public function pesquisarGrupoIndicadores(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
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
				$grupo_indicadores = GrupoIndicadores::where('nome', 'like', '%' . $pesq . '%')->get();
			}
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores', 'pesq', 'pesq2'));
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

	public function indicadoresGrupoNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			return view('grupo_indicadores/grupo_indicadores_novo');
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

	public function storeGrupoIndicadores(Request $request)
	{
		$input     = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255|unique:grupo_indicadores,nome'
		]);
		if ($validator->fails()) {
			return view('grupo_indicadores/grupo_indicadores_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$grupo_indicadores = GrupoIndicadores::create($input);
			$grupo_indicadores = GrupoIndicadores::all();
			$id = GrupoIndicadores::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator = 'Grupo de Indicadores Cadastrado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function indicadoresGrupoAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::where('id', $id)->get();
			return view('grupo_indicadores/grupo_indicadores_alterar', compact('grupo_indicadores'));
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

	public function updateGrupoIndicadores($id, Request $request)
	{
		$input             = $request->all();
		$grupo_indicadores = GrupoIndicadores::where('id', $id)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255'
		]);
		if ($validator->fails()) {
			return view('grupo_indicadores/grupo_indicadores_alterar', compact('grupo_indicadores'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$grupo_indicadores = GrupoIndicadores::find($id);
			$grupo_indicadores->update($input);
			$grupo_indicadores = GrupoIndicadores::all();
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator = 'Grupo de Indicadores Alterado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		}
	}

	public function indicadoresGrupoExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::where('id', $id)->get();
			return view('grupo_indicadores/grupo_indicadores_excluir', compact('grupo_indicadores'));
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

	public function destroyGrupoIndicadores($id, Request $request)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		GrupoIndicadores::find($id)->delete();
		$grupo_indicadores = GrupoIndicadores::all();
		$validator = 'Grupo de Indicadores excluído com sucesso!';
		return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
			->withErrors($validator)
			->withInput(session()->flashInput($request->input()));
	}

	public function grupoVincular($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupoIndica = GrupoIndicadores::where('id', $id)->get();
			$perfilUser = PerfilUser::all();
			$gpIndi_pfUser = DB::table('grupo_perfil_user')
				->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
				->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
				->where('grupo_perfil_user.grupo_indic_id', $id)
				->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'grupo_perfil_user.id as id')->get();
			return view('grupo_indicadores/grupo_indica_vincular_perf_user', compact('grupoIndica', 'perfilUser', 'gpIndi_pfUser'));
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

	public function storeGpIndiPerfUsers(Request $request, $id)
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'grupo_indic_id' => 'required',
			'perfil_user_id' => 'required'
		]);
		if ($validator->fails()) {
			return view('grupo_indicadores/grupo_indica_vincular_perf_user', compact('grupoIndica', 'perfilUser', 'gpIndi_pfUser'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$grupoIndica = GrupoIndicadores::where('id', $id)->get();
			$perfilUser = PerfilUser::all();
			$gpIndi_pfUser = DB::table('grupo_perfil_user')
				->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
				->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
				->where('grupo_perfil_user.grupo_indic_id', $id)->where('grupo_perfil_user.perfil_user_id', $input['perfil_user_id'])
				->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'grupo_perfil_user.id as id')->get();

			if (sizeof($gpIndi_pfUser) > 0) {
				$grupoIndica = GrupoIndicadores::where('id', $id)->get();
				$perfilUser = PerfilUser::all();
				$gpIndi_pfUser = DB::table('grupo_perfil_user')
					->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
					->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
					->where('grupo_perfil_user.grupo_indic_id', $id)
					->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'grupo_perfil_user.id as id')->get();
				$validator = "Já existe um perfil de usúario vinculado a este grupo de indicador !";
				return view('grupo_indicadores/grupo_indica_vincular_perf_user', compact('grupoIndica', 'perfilUser', 'gpIndi_pfUser'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} else {
				$grupoIndica = GrupoPerfilUser::create($input);
				$grup_pfuser_atual = DB::table('grupo_perfil_user')
					->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
					->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
					->where('grupo_perfil_user.grupo_indic_id', $id)->where('grupo_perfil_user.perfil_user_id', $input['perfil_user_id'])
					->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'grupo_perfil_user.id as id')->get();
				$grupoIndica = GrupoIndicadores::where('id', $id)->get();
				$input['idTabela'] = $grup_pfuser_atual[0]->id;
				$input['user_id'] = $input['user_id_'];
				$loggers = Logger::create($input);
				$validator  = 'Permissão do Usuário Cadastrado com Sucesso!';
				return redirect()->route('grupoVincular', $id)
					->withErrors($validator)
					->with('grupoIndica', 'perfilUser', 'gpIndi_pfUser');
			}
		}
	}

	public function grupoVincularExcluir($id, Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupoIndica = GrupoIndicadores::where('id', $id)->get();
			$perfilUser = PerfilUser::all();
			$gpIndi_pfUser = DB::table('grupo_perfil_user')
				->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
				->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
				->where('grupo_perfil_user.grupo_indic_id', $id)
				->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'perfil_user.id as perfil_ID', 'grupo_perfil_user.id as id')->get();
			return view('grupo_indicadores/grupo_indica_Desvincular_perf_user', compact('grupoIndica', 'perfilUser', 'gpIndi_pfUser'));
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

	public function grupoVincularExcluir_(Request $request, $id, $id_p)
	{
		$input = $request->all();
		$id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$grupoIndica = GrupoIndicadores::where('id', $id)->get();
			$perfilUser = PerfilUser::all();
			$gpIndi_pfUser = DB::table('grupo_perfil_user')
				->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
				->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
				->where('grupo_perfil_user.grupo_indic_id', $id)->where('grupo_perfil_user.perfil_user_id', $id_p)
				->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'perfil_user.id as perfil_ID', 'grupo_perfil_user.id as id')->get();
			$qtd = sizeof($gpIndi_pfUser);
			return view('grupo_indicadores/grupo_indica_Desvincular_perf_user_', compact('grupoIndica', 'perfilUser', 'gpIndi_pfUser'))
				->withInput(session()->flashInput($request->input()));
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

	public function destroyGpIndUser(Request $request, $id, $id_p)
	{
		$input = $request->all();
		$gpIndi_pfUser = DB::table('grupo_perfil_user')
			->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
			->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
			->where('grupo_perfil_user.grupo_indic_id', $id)->where('grupo_perfil_user.perfil_user_id', $id_p)
			->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'perfil_user.id as perfil_ID', 'grupo_perfil_user.id as id')->get();
		$input['idTabela'] = $gpIndi_pfUser[0]->id;
		$gpIndi_pfUser = DB::statement('DELETE FROM grupo_perfil_user WHERE id = ' . $gpIndi_pfUser[0]->id);
		$input['tela'] = 'excluir_vinculo_GPindica_PfUser';
		$input['user_id'] = Auth::user()->id;
		$loggers = Logger::create($input);
		$gpIndi_pfUser = DB::table('grupo_perfil_user')
			->join('grupo_indicadores', 'grupo_indicadores.id', '=', 'grupo_perfil_user.grupo_indic_id')
			->join('perfil_user', 'perfil_user.id', '=', 'grupo_perfil_user.perfil_user_id')
			->where('grupo_perfil_user.grupo_indic_id', $id)
			->select('grupo_indicadores.nome as grupo_indicador', 'perfil_user.nome as perfil', 'perfil_user.id as perfil_ID', 'grupo_perfil_user.id as id')->get();
		$grupoIndica = GrupoIndicadores::where('id', $id)->get();
		$perfilUser = PerfilUser::all();
		$validator  = "Perfil Usuário excluído com sucesso!";
		return redirect()->route('grupoVincularExcluir', $id)
			->withErrors($validator)
			->with('grupoIndica', 'perfilUser', 'gpIndi_pfUser');
	}
}
