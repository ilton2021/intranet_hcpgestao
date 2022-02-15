<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ramais;
use App\Models\Unidades;
use Validator;
use DB;
use Storage;

class RamaisController extends Controller
{
    public function cadastroRamais()
    {
        $ramais = Ramais::all();
        return view('ramais/ramais_cadastro', compact('ramais'));
    }

    public function pesquisarRamais(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $ramais = Ramais::where('nome','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2") {
            $ramais = Ramais::where('telefone','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "3") {
            $ramais = Ramais::where('unidade','like','%'.$pesq.'%')->get();
        }
        return view('ramais/ramais_cadastro', compact('ramais','pesq','pesq2'));
    }

    public function ramaisNovo()
    {
        $unidades = Unidades::all();
        return view('ramais/ramais_novo', compact('unidades'));
    }

    public function storeRamais(Request $request)
    {
        $input = $request->all();
        $unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'nome'     => 'required|max:255',
            'telefone' => 'required|max:255'
    	]);
		if ($validator->fails()) {
			return view('ramais/ramais_novo', compact('ramais'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$ramais = Ramais::create($input);
			$ramais = Ramais::all();
			$validator = 'Ramal Cadastrado com Sucesso!';
			return view('ramais/ramais_cadastro', compact('ramais'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function ramaisAlterar($id)
    {
        $ramais = Ramais::where('id',$id)->get();
        $unidades = Unidades::all();
        return view('ramais/ramais_alterar', compact('ramais','unidades'));
    }

    public function updateRamais($id, Request $request)
    {
        $input    = $request->all();
	    $ramais   = Ramais::where('id',$id)->get();
        $unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'nome'     => 'required|max:255',
            'telefone' => 'required|max:255'
        ]);
		if ($validator->fails()) {
			return view('ramais/ramais_alterar', compact('ramais','unidades'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$ramais = Ramais::find($id); 
			$ramais->update($input);
	    	$ramais = Ramais::all();
			$validator ='Ramal Alterado com Sucesso!';
			return view('ramais/ramais_cadastro', compact('ramais'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function ramaisExcluir($id)
    {
        $ramais = Ramais::where('id',$id)->get();
        return view('ramais/ramais_excluir', compact('ramais'));
    }

    public function destroyRamais($id, Request $request)
    {
        Ramais::find($id)->delete();
		$ramais = Ramais::all();
        $validator = 'Ramal excluído com sucesso!';
		return view('ramais/ramais_cadastro', compact('ramais'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }

    public function ramaisUnidade($id)
    {
        $unidades = Unidades::all();
        $ramais = Ramais::where('unidade_id',$id)->get();
        $unidade = Unidades::where('id',$id)->get();
        return view('ramais/ramais_unidade', compact('ramais','unidade','unidades'));
    }
}
