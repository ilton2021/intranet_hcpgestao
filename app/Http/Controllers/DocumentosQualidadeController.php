<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentosQualidade;
use App\Models\Logger;
use App\Models\UserPerfil;
use App\Models\Unidades;
use App\Models\SetorDocumento;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Storage;
use DB;
use Validator;

class DocumentosQualidadeController extends Controller
{
	public function cadastroDocumentos()
	{
		$id_user = Auth::user()->id;
		$idTela = 10;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$documentos = DocumentosQualidade::paginate(20);
			return view('documentos_qualidade/documentos_qualidade_cadastro', compact('documentos'));
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

	public function pesquisarDocumentos(Request $request)
	{
		$id_user = Auth::user()->id;
		$idTela = 10;
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
				$documentos = DocumentosQualidade::where('nome', 'like', '%' . $pesq . '%')->paginate(20);
			}
			return view('documentos_qualidade/documentos_qualidade_cadastro', compact('documentos', 'pesq', 'pesq2'));
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

	public function documentosNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 10;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$unidades = Unidades::all();
			$setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
			return view('documentos_qualidade/documentos_qualidade_novo', compact('unidades', 'setores'));
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

	public function storeDocumentos(Request $request)
	{
		$input    = $request->all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		$setor 	  = $input['setor_id'];
		$unidade  = SetorDocumento::select('unidade_id as unidade_id')->where('id', $setor)->get();
		if ($request->file('imagem') === NULL) {
			$validator = 'Selecione o arquivo do Documento de Qualidade!';
			return view('documentos_qualidade/documentos_qualidade_novo', compact('setor'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('documentos_qualidade/documentos_qualidade_novo', compact('setor'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$request->file('imagem')->move('../public/storage/documentos_qualidade/', $nome);
					$input['imagem'] = $nome;
					$input['caminho'] = 'documentos_qualidade/' . $nome;
					$documentos = DocumentosQualidade::create($input);
					$documentos = DocumentosQualidade::all();
					$id = DocumentosQualidade::all()->max('id');
					$input['idTabela'] = $id;
					$loggers   = Logger::create($input);
					$documentos = DocumentosQualidade::paginate(20);
					$validator = 'Documento de Qualidade Cadastrado com Sucesso!';
					return redirect()->route('cadastroDocumentos')
						->withErrors($validator)
						->with('documentos');
				}
			} else {
				$validator = 'Só é permitido documentos: .pdf ou .PDF!';
				return view('documentos_qualidade/documentos_qualidade_novo', compact('setor'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function documentosAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 10;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$documentos = DocumentosQualidade::where('id', $id)->get();
			$und_atual  = explode(',', $documentos[0]->unidade_id);
			$unidades   = Unidades::all();
			$setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
			return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos','und_atual','unidades', 'setores'));
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

	public function updateDocumentos($id, Request $request)
	{
		$input = $request->all();
		$nome1 = "";
		$documentos = DocumentosQualidade::where('id', $id)->get();
		$setor = $input['setor_id'];
		$unidade = SetorDocumento::select('unidade_id as unidade_id')->where('id', $setor)->get();
		$input['unidade_id'] = $unidade[0]->unidade_id;
		if ($request->file('imagem') === NULL && $input['imagem_'] == "") {
			$validator = 'Selecione o arquivo do Documento de Qualidade!';
			return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos'))
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
			if ($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255',
					'setor_id' => 'required'
				]);
				if ($validator->fails()) {
					return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					if ($nome1 != "") {
						$request->file('imagem')->move('../public/storage/documentos_qualidade/', $nome1);
						$input['imagem'] = $nome1;
						$input['caminho'] = 'documentos_qualidade/' . $nome1;
					}
					$documentos = DocumentosQualidade::find($id);
					$documentos->update($input);
					$input['idTabela'] = $id;
					$loggers    = Logger::create($input);
					$documentos = DocumentosQualidade::paginate(20);
					$validator  = 'Documento de Qualidade Alterado com Sucesso!';
					return redirect()->route('cadastroDocumentos')
						->withErrors($validator)
						->with('documentos');
				}
			} else {
				$validator = 'Só é permitido arquivos: .pdf!';
				return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function documentosExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 10;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$documentos = DocumentosQualidade::where('id', $id)->get();
			$setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
				->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->get();
			return view('documentos_qualidade/documentos_qualidade_excluir', compact('documentos', 'setores'));
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

	public function destroyDocumentos($id, Request $request)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
		$data    = DocumentosQualidade::find($id);
		$image_path = public_path() . '/storage/' . $data->caminho;
		unlink($image_path);
		$data->delete();
		$documentos = DocumentosQualidade::paginate(20);
		$validator  = 'Documento de Qualidade excluído com sucesso!';
		return redirect()->route('cadastroDocumentos')
			->withErrors($validator)
			->with('documentos');
	}
}
