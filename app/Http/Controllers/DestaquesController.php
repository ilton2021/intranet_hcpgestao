<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destaques;
use Validator;
use Storage;

class DestaquesController extends Controller
{
    public function cadastroDestaques(){
        $destaques = Destaques::all();
        return view('destaques/destaques_cadastro', compact('destaques'));
    }

    public function pesquisarDestaques(Request $request){
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $destaques = Destaques::where('titulo','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2"){
            $destaques = Destaques::where('texto','like','%'.$pesq.'%')->get();
        }
        return view('destaques/destaques_cadastro', compact('destaques','pesq','pesq2'));
    }

    public function destaquesNovo(){
        return view('destaques/destaques_novo');
    }

    public function storeDestaques(Request $request){
        $input = $request->all();
		$nome = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione a imagem do Destaque!';
			return view('destaques/destaques_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'jpg' || $extensao == 'png' || $extensao == 'jpeg') {
				$validator = Validator::make($request->all(), [
					'texto'       => 'required|max:8000',
                    'titulo'      => 'required|max:255',
                    'data_inicio' => 'required|date',
                    'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('destaques/destaques_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('../public/storage/destaques/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'destaques/'.$nome; 

					for($a = 2; $a <= 6; $a++){
						if($request->file('imagem'.$a) != NULL) {	
							$nome1 = $_FILES['imagem'.$a]['name'];
							$input['imagem'.$a]  = $nome1; 
							$input['caminho'.$a] = 'destaques/'.$nome.'/'.$nome1; 
							$request->file('imagem'.$a)->move('../public/storage/destaques/',$nome1);
						}
					}

					$destaques = Destaques::create($input);
					$destaques = Destaques::all();
					$validator = 'Destaque Cadastrado com Sucesso!';
					return view('destaques/destaques_cadastro', compact('destaques'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('destaques/destaques_novo')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function destaquesAlterar($id){
        $destaques = Destaques::where('id',$id)->get();
        return view('destaques/destaques_alterar', compact('destaques'));
    }

    public function updateDestaques($id, Request $request){
        $input = $request->all();
		$nome1 = "";
        $destaques = Destaques::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione a imagem do Destaque!!';		
			return view('destaques/destaques_alterar', compact('destaques'))
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
					'texto'       => 'required|max:8000',
                    'titulo'      => 'required|max:255',
                    'data_inicio' => 'required|date',
                    'data_fim'    => 'required|date'
				]);
				if ($validator->fails()) {
					return view('destaques/destaques_alterar', compact('destaques'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/destaques/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'destaques/'.$nome1; 
					} 

					for($a = 2; $a <= 6; $a++){
						if($request->file('imagem'.$a) != "") {
							$nome = $_FILES['imagem'.$a]['name'];
							$input['imagem'.$a]  = $nome; 
							$input['caminho'.$a] = 'destaques/'.$nome; 
							$request->file('imagem'.$a)->move('../public/storage/destaques/',$nome);
						}
					}

					$destaques = Destaques::find($id); 
					$destaques->update($input);
					$destaques = Destaques::all();
					$validator ='Destaque Alterado com Sucesso!';
					return view('destaques/destaques_cadastro', compact('destaques'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('destaques/destaques_alterar', compact('destaques'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function destaquesExcluir($id){
        $destaques = Destaques::where('id',$id)->get();
        return view('destaques/destaques_excluir', compact('destaques'));
    }

    public function destroyDestaques($id, Request $request){
        Destaques::find($id)->delete();
		$input = $request->all();
		$nome = $input['imagem'];
		$pasta = 'public/storage/destaques/'.$nome; 
		Storage::delete($pasta);
		$destaques = Destaques::all();
        $validator = 'Destaque excluído com sucesso!';
		return view('destaques/destaques_cadastro', compact('destaques'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}