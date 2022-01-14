<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrupoIndicadores;
use Storage;
use DB;
use Validator;

class GrupoIndicadoresController extends Controller
{
    public function cadastroGrupoIndicadores()
    {
        $grupo_indicadores = GrupoIndicadores::all();
        return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'));
    }

    public function pesquisarGrupoIndicadores(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $grupo_indicadores = GrupoIndicadores::where('nome','like','%'.$pesq.'%')->get();
        } 
        return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores','pesq','pesq2'));
    }

    public function indicadoresGrupoNovo()
    {
        return view('grupo_indicadores/grupo_indicadores_novo');
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
		}else {
			$grupo_indicadores = GrupoIndicadores::create($input);
			$grupo_indicadores = GrupoIndicadores::all();
			$validator = 'Grupo de Indicadores Cadastrado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function indicadoresGrupoAlterar($id)
    {
        $grupo_indicadores = GrupoIndicadores::where('id',$id)->get();
        return view('grupo_indicadores/grupo_indicadores_alterar', compact('grupo_indicadores'));
    }

    public function updateGrupoIndicadores($id, Request $request)
    {
        $input             = $request->all();
	    $grupo_indicadores = GrupoIndicadores::where('id',$id)->get();
		$validator = Validator::make($request->all(), [
            'nome' => 'required|max:255'
        ]);
		if ($validator->fails()) {
			return view('grupo_indicadores/grupo_indicadores_alterar', compact('grupo_indicadores'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$grupo_indicadores = GrupoIndicadores::find($id); 
			$grupo_indicadores->update($input);
	    	$grupo_indicadores = GrupoIndicadores::all();
			$validator ='Grupo de Indicadores Alterado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function indicadoresGrupoExcluir($id)
    {
        $grupo_indicadores = GrupoIndicadores::where('id',$id)->get();
        return view('grupo_indicadores/grupo_indicadores_excluir', compact('grupo_indicadores'));
    }

    public function destroyGrupoIndicadores($id, Request $request)
    {
        GrupoIndicadores::find($id)->delete();
		$grupo_indicadores = GrupoIndicadores::all();
        $validator = 'Grupo de Indicadores excluído com sucesso!';
		return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
