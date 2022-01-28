<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mural;
use Validator;
use Storage;

class MuralController extends Controller
{
    public function cadastroMural(){
        $murais = Mural::all();
        return view('mural_avisos/mural_cadastro', compact('murais'));
    }  

    public function pesquisarMural(Request $request){
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $murais = Mural::where('titulo','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2"){
            $murais = Mural::where('texto','like','%'.$pesq.'%')->get();
        }
        return view('mural_avisos/mural_cadastro', compact('murais','pesq','pesq2'));
    }

    public function muralNovo(){
        return view('mural_avisos/mural_novo');
    }
 
    public function storeMural(Request $request){
        $input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione a imagem do Mural de Avisos!';
			return view('mural_avisos/mural_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:1000',
                    'titulo'      => 'required|max:255',
                    'data_inicio' => 'required|date',
                    'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('mural_avisos/mural_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('public/storage/mural_avisos/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'mural_avisos/'.$nome; 
					$murais = Mural::create($input);
					$murais = Mural::all();
					$validator = 'Mural de Aviso Cadastrado com Sucesso!';
					return view('mural_avisos/mural_cadastro', compact('murais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('mural_avisos/mural_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function muralAlterar($id){
        $murais = Mural::where('id',$id)->get();
        return view('mural_avisos/mural_alterar', compact('murais'));
    }

    public function updateMural($id, Request $request){
        $input = $request->all();
		$nome1 = "";
        $murais = Mural::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione a imagem do Mural de Avisos!!';		
			return view('mural_avisos/mural_alterar', compact('murais'))
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
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:1000',
                    'titulo'      => 'required|max:255',
                    'data_inicio' => 'required|date',
                    'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('mural_avisos/mural_alterar', compact('murais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('public/storage/mural_avisos/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'mural_avisos/'.$nome1; 
					} 
					$murais = Mural::find($id); 
					$murais->update($input);
					$murais = Mural::all();
					$validator ='Mural de Avisos Alterado com Sucesso!';
					return view('mural_avisos/mural_cadastro', compact('murais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('mural_avisos/mural_alterar', compact('murais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function muralExcluir($id){
        $murais = Mural::where('id',$id)->get();
        return view('mural_avisos/mural_excluir', compact('murais'));
    }

    public function destroyMural($id, Request $request){
        $input = $request->all();
		$data  = Mural::find($id);
		$image_path = public_path().'/storage/'.$data->caminho;
        unlink($image_path);
        $data->delete();
		$murais = Mural::all();
        $validator = 'Mural de Avisos excluído com sucesso!';
		return view('mural_avisos/mural_cadastro', compact('murais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
