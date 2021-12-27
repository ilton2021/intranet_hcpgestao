<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoliticasNormas;
use App\Models\Setor;
use Validator;
use Storage;

class PoliticasNormasController extends Controller
{
    public function cadastroPoliticas()
    {
        $politicas = PoliticasNormas::all();
        return view('politicas_normas/politicas_normas_cadastro', compact('politicas'));
    }

    public function pesquisarPoliticas(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $politicas = PoliticasNormas::where('nome','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2"){
            $politicas = PoliticasNormas::where('setor','like','%'.$pesq.'%')->get();
        }
        return view('politicas_normas/politicas_normas_cadastro', compact('politicas','pesq','pesq2'));
    }

    public function politicasNovo()
    {
        $setores = Setor::all();
        return view('politicas_normas/politicas_normas_novo', compact('setores'));
    }

    public function storePoliticas(Request $request)
    {
        $input    = $request->all();
        $setores  = Setor::all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione o arquivo da Política e Normas!';
			return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('../public/storage/politicas_normas/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'politicas_normas/'.$nome; 
					$politicas = PoliticasNormas::create($input);
					$politicas = PoliticasNormas::all();
					$validator = 'Políticas e Normas Cadastrado com Sucesso!';
					return view('politicas_normas/politicas_normas_cadastro', compact('politicas'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('politicas_normas/politicas_normas_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function politicasAlterar($id)
    {
        $politicas = PoliticasNormas::where('id',$id)->get();
        $setores   = Setor::all();
        return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'));
    }

    public function updatePoliticas($id, Request $request)
    {
        $input = $request->all();
		$nome1 = "";
        $setores   = Setor::all();
        $politicas = PoliticasNormas::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione o arquivo da Política e Normas!';	
			return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'))
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
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255',
            	]);
				if ($validator->fails()) {
					return view('politicas_normas/politicas_normas_alterar', compact('politicas','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/politicas_normas/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'politicas_normas/'.$nome1; 
					} 
					$politicas = PoliticasNormas::find($id); 
					$politicas->update($input);
					$politicas = PoliticasNormas::all();
					$validator ='Polícitas e Normas Alterado com Sucesso!';
					return view('politicas_normas/politicas_normas_cadastro', compact('politicas','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('politicas_normas/politicas_normas_alterar', compact('politicas'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function politicasExcluir($id)
    {
        $politicas = PoliticasNormas::where('id',$id)->get();
        return view('politicas_normas/politicas_normas_excluir', compact('politicas'));
    }

    public function destroyPoliticas($id, Request $request)
    {
        PoliticasNormas::find($id)->delete();
		$input = $request->all();
		$nome = $input['imagem'];
		$pasta = 'public/storage/politicas_normas/'.$nome; 
		Storage::delete($pasta);
		$politicas = PoliticasNormas::all();
        $validator = 'Políticas e Normas excluído com sucesso!';
		return view('politicas_normas/politicas_normas_cadastro', compact('politicas'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}