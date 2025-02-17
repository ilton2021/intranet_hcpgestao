<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emails;
use App\Models\Unidades;
use App\Models\Setor;
use App\Models\UserPerfil;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Storage;
use DB;
use Validator;

class EmailsController extends Controller
{
	public function cadastroEmails()
	{
		$id_user = Auth::user()->id;
		$idTela = 6;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$emails   = Emails::paginate(20);
			$unidades = Unidades::all();
			$setores  = Setor::all();
			return view('emails/emails_cadastro', compact('emails', 'unidades', 'setores'));
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

	public function pesquisarEmails(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 6;
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
				$emails = Emails::where('nome', 'like', '%' . $pesq . '%')->paginate(20);
			} else if ($pesq2 == "2") {
				$emails = Emails::where('email', 'like', '%' . $pesq . '%')->paginate(20);
			} else if ($pesq2 == "3") {
				$emails = DB::table('emails')
					->join('unidades', 'unidades.id', '=', 'emails.unidade_id')
					->where('unidades.sigla', 'like', '%' . $pesq . '%')
					->select('emails.nome as nome', 'emails.email as email', 'emails.id as id', 'emails.unidade_id as unidade_id')
					->orderby('emails.nome', 'asc')
					->paginate(20);
			}
			$unidades = Unidades::all();
			return view('emails/emails_cadastro', compact('emails', 'pesq', 'pesq2', 'unidades'));
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

	public function pesqEmailsUnidade($id, Request $request) 
	{
		$input = $request->all();
		if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
		if($pesq2 == "nome") {
			$emails = Emails::where('unidade_id',$id)->where('nome','like','%'.$pesq.'%')->get();
		} else if($pesq2 == "email") {
			$emails = Emails::where('unidade_id',$id)->where('email','like','%'.$pesq.'%')->get();
		} else {
			$emails = Emails::where('unidade_id',$id)->orderby('nome','ASC')->get();
		}
		$unidades = Unidades::all();
        $unidade  = Unidades::where('id',$id)->get();
        return view('emails/emails_unidade', compact('emails','unidade','unidades'));
	}

	public function emailsNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 6;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$unidades = Unidades::all();
			$setores = setor::orderBy('nome', 'ASC')->get();
			return view('emails/emails_novo', compact('unidades', 'setores'));
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

	public function storeEmails(Request $request)
	{
		$input = $request->all();
		$unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
			'email' => 'required|max:255|email'
		]);
		if ($validator->fails()) {
			return view('emails/emails_novo', compact('unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$emails = Emails::create($input);
			$emails = Emails::all();
			$id = Emails::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$emails = Emails::paginate(20);
			$validator = 'E-mail Cadastrado com Sucesso!';
			return redirect()->route('cadastroEmails')
				->withErrors($validator)
				->with('emails', 'unidades');
		}
	}

	public function emailsAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 6;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$emails = Emails::where('id', $id)->get();
			$unidades = Unidades::all();
			$setores = Setor::all();
			return view('emails/emails_alterar', compact('emails', 'unidades', 'setores'));
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

	public function updateEmails($id, Request $request)
	{
		$input    = $request->all();
		$emails   = Emails::where('id', $id)->get();
		$unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
			'email' => 'required|max:255|email'
		]);
		if ($validator->fails()) {
			return view('emails/emails_alterar', compact('emails', 'unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$emails = Emails::find($id);
			$emails->update($input);
			$emails = Emails::all();
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$emails = Emails::paginate(20);
			$validator = 'E-mail Alterado com Sucesso!';
			return redirect()->route('cadastroEmails')
				->withErrors($validator)
				->with('emails', 'unidades');
		}
	}

	public function emailsExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 6;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$emails = Emails::where('id', $id)->get();
			return view('emails/emails_excluir', compact('emails'));
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

	public function destroyEmails($id, Request $request)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers   = Logger::create($input);
		Emails::find($id)->delete();
		$emails = Emails::paginate(20);
		$validator = 'E-mail excluído com sucesso!';
		return redirect()->route('cadastroEmails')
			->withErrors($validator)
			->with('emails', 'unidades');
	}

	public function emailsUnidade($id)
	{
		$unidades = Unidades::all();
		$emails = Emails::where('unidade_id', $id)->orderby('nome', 'ASC')->get();
		$unidade = Unidades::where('id', $id)->get();
		return view('emails/emails_unidade', compact('emails', 'unidade', 'unidades'));
	}
}
