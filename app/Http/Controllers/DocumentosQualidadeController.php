<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentosQualidade;
use Storage;
use DB;
use Validator;

class DocumentosQualidadeController extends Controller
{
	public function cadastroDocumentos()
	{
		$documentos = DocumentosQualidade::all();
		return view('documentos_qualidade/documentos_qualidade_cadastro', compact('documentos'));
	}

	public function pesquisarDocumentos(Request $request)
	{
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
			$documentos = DocumentosQualidade::where('nome', 'like', '%' . $pesq . '%')->get();
		}
		return view('documentos_qualidade/documentos_qualidade_cadastro', compact('documentos', 'pesq', 'pesq2'));
	}

	public function documentosNovo()
	{
		return view('documentos_qualidade/documentos_qualidade_novo');
	}

	public function storeDocumentos(Request $request)
	{
		$input    = $request->all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if ($request->file('imagem') === NULL) {
			$validator = 'Selecione o arquivo do Documento de Qualidade!';
			return view('documentos_qualidade/documentos_qualidade_novo')
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('documentos_qualidade/documentos_qualidade_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$request->file('imagem')->move('public/storage/documentos_qualidade/', $nome);
					$input['imagem'] = $nome;
					$input['caminho'] = 'documentos_qualidade/' . $nome;
					$documentos = DocumentosQualidade::create($input);
					$documentos = DocumentosQualidade::all();
					$validator = 'Documento de Qualidade Cadastrado com Sucesso!';
					return redirect()->route('cadastroDocumentos')
						->withErrors($validator)
						->with('documentos');
				}
			} else {
				$validator = 'Só é permitido documentos: .pdf ou .PDF!';
				return view('documentos_qualidade/documentos_qualidade_novo')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function documentosAlterar($id)
	{
		$documentos = DocumentosQualidade::where('id', $id)->get();
		return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos'));
	}

	public function updateDocumentos($id, Request $request)
	{
		$input = $request->all();
		$nome1 = "";
		$documentos = DocumentosQualidade::where('id', $id)->get();
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
				]);
				if ($validator->fails()) {
					return view('documentos_qualidade/documentos_qualidade_alterar', compact('documentos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					if ($nome1 != "") {
						$request->file('imagem')->move('public/storage/documentos_qualidade/', $nome1);
						$input['imagem'] = $nome1;
						$input['caminho'] = 'documentos_qualidade/' . $nome1;
					}
					$documentos = DocumentosQualidade::find($id);
					$documentos->update($input);
					$documentos = DocumentosQualidade::all();
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
		$documentos = DocumentosQualidade::where('id', $id)->get();
		return view('documentos_qualidade/documentos_qualidade_excluir', compact('documentos'));
	}

	public function destroyDocumentos($id, Request $request)
	{
		$input = $request->all();
		$data  = DocumentosQualidade::find($id);
		$image_path = public_path() . '/storage/' . $data->caminho;
		unlink($image_path);
		$data->delete();
		$documentos = DocumentosQualidade::all();
		$validator  = 'Documento de Qualidade excluído com sucesso!';
		return redirect()->route('cadastroDocumentos')
			->withErrors($validator)
			->with('documentos');
	}
}
