<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProtocolosInstitucionais;
use App\Models\Setor;
use DB;
use Storage;
use Validator;

class ProtocolosInstitucionaisController extends Controller
{
    public function cadastroProtocolos()
    {
        $protocolos = ProtocolosInstitucionais::all();
        return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos'));
    }

    public function pesquisarProtocolos(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $protocolos = ProtocolosInstitucionais::where('nome','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2"){
            $protocolos = ProtocolosInstitucionais::where('setor','like','%'.$pesq.'%')->get();
        }
        return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos','pesq','pesq2'));
    }

    public function protocolosNovo()
    {
        $setores = Setor::all();
        return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'));
    }

    public function storeProtocolos(Request $request)
    {
        $input    = $request->all();
        $setores  = Setor::all();
		$nome     = $_FILES['imagem']['name'];
		$extensao = pathinfo($nome, PATHINFO_EXTENSION);
		if($request->file('imagem') === NULL) {	
			$validator = 'Selecione o arquivo do Protocolo Institucional!';
			return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
		} else {
			if($extensao == 'pdf' || $extensao == 'PDF') {
				$validator = Validator::make($request->all(), [
					'nome' => 'required|max:255'
				]);
				if ($validator->fails()) {
					return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					$request->file('imagem')->move('../public/storage/protocolos_institucionais/', $nome);
					$input['imagem'] = $nome; 
					$input['caminho'] = 'protocolos_institucionais/'.$nome; 
					$protocolos = ProtocolosInstitucionais::create($input);
					$protocolos = ProtocolosInstitucionais::all();
					$validator = 'Protocolo Institucional Cadastrado com Sucesso!';
					return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';		
				return view('protocolos_institucionais/protocolos_institucionais_novo', compact('setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function protocolosAlterar($id)
    {
        $protocolos = ProtocolosInstitucionais::where('id',$id)->get();
        $setores    = Setor::all();
        return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'));
    }

    public function updateProtocolos($id, Request $request)
    {
        $input = $request->all();
		$nome1 = "";
        $setores    = Setor::all();
        $protocolos = ProtocolosInstitucionais::where('id',$id)->get();
		if($request->file('imagem') === NULL && $input['imagem_'] == "") {	
			$validator = 'Selecione o arquivo do Protocolo Institucional!';	
			return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'))
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
					return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}else {
					if($nome1 != "") {
					  $request->file('imagem')->move('../public/storage/protocolos_institucionais/', $nome1);
					  $input['imagem'] = $nome1; 
					  $input['caminho'] = 'protocolos_institucionais/'.$nome1; 
					} 
					$protocolos = ProtocolosInstitucionais::find($id); 
					$protocolos->update($input);
					$protocolos = ProtocolosInstitucionais::all();
					$validator ='Protocolo Institucional Alterado com Sucesso!';
					return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos','setores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Só é permitido imagens: .jpg, .jpeg ou .png!';
				return view('protocolos_institucionais/protocolos_institucionais_alterar', compact('protocolos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
    }

    public function protocolosExcluir($id)
    {
        $protocolos = ProtocolosInstitucionais::where('id',$id)->get();
        return view('protocolos_institucionais/protocolos_institucionais_excluir', compact('protocolos'));
    }

    public function destroyProtocolos($id, Request $request)
    {
        ProtocolosInstitucionais::find($id)->delete();
		$input = $request->all();
		$nome = $input['imagem'];
		$pasta = 'public/storage/protocolos_institucionais/'.$nome; 
		Storage::delete($pasta);
		$protocolos = ProtocolosInstitucionais::all();
        $validator = 'Protocolo Institucional excluído com sucesso!';
		return view('protocolos_institucionais/protocolos_institucionais_cadastro', compact('protocolos'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
