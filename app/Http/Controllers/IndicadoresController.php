<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicadores;
use App\Models\Unidades;
use App\Models\GrupoIndicadores;
use Storage;
use DB;
use Validator;
use Auth;

class IndicadoresController extends Controller
{
    public function cadastroIndicadores()
    {
        $indicadores = Indicadores::paginate(20);
        $grupo_indicadores = GrupoIndicadores::all();
        return view('indicadores/indicadores_cadastro', compact('indicadores','grupo_indicadores'));
    }

    public function pesquisarIndicadores(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        $grupo_indicadores = GrupoIndicadores::all();
        if($pesq2 == "1") {
            $indicadores = Indicadores::where('nome','like','%'.$pesq.'%')->paginate(20);
        } else if($pesq2 == "2") {
            $indicadores = Indicadores::where('grupo_id','like','%'.$pesq.'%')->paginate(20);
        } else if($pesq2 == "3") {
            $unidade = Unidades::where('nome','like','%'.$pesq.'%')->get();
            $qtd = sizeof($unidade);
            if($qtd == 0){
                $indicadores = Indicadores::paginate(20);
            } else {
                $indicadores = Indicadores::where('unidade_id','like','%'.$unidade[0]->id.'%')->paginate(20);
            }
        } else {
            $indicadores = Indicadores::paginate(20);
        }
        return view('indicadores/indicadores_cadastro', compact('indicadores','pesq','pesq2','grupo_indicadores'));
    }

    public function pesquisarIndicadoresGestores(Request $request)
    {
        $input  = $request->all();  
        $unidade = Auth::user()->unidade_id;
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
      	$pesq2 = $input['pesq2']; 
        if($pesq2 != "") {
            $indicadores = Indicadores::where('grupo_id',$pesq2)->where('unidade_id',$unidade)->get();
            $qtd = sizeof($indicadores);
            $grupo_indicadores = GrupoIndicadores::orderby('nome','ASC')->get();
            if($qtd == 0) {
                $validator = 'Não existe nenhum Indicador cadastrado nesta Unidade deste Grupo!';
                return view('indicadores/lista_indicadores', compact('indicadores','pesq2','grupo_indicadores'))
                  ->withErrors($validator)
				  ->withInput(session()->flashInput($request->input()));
            } else {
                return view('indicadores/lista_indicadores', compact('indicadores','pesq2','grupo_indicadores'));
            }
        } else {
            $indicadores = Indicadores::where('id',0)->get();
            $validator = 'Selecione um Grupo de Indicadores!';
            $grupo_indicadores = GrupoIndicadores::orderby('nome','ASC')->get();
            return view('indicadores/lista_indicadores', compact('indicadores','pesq2','grupo_indicadores'))
                ->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
        }
    }

    public function indicadoresNovo()
    {
        $unidades = Unidades::all();
        $grupo_indicadores = GrupoIndicadores::all();
        return view('indicadores/indicadores_novo', compact('unidades','grupo_indicadores'));
    }

    public function storeIndicadores(Request $request)
    {
        $input     = $request->all();
        $unidades  = Unidades::all();
		$validator = Validator::make($request->all(), [
			'grupo'  => 'required|max:255',
            'status' => 'required|max:255',
            'nome'   => 'required|max:255',
            'link'   => 'required|max:255'
    	]);
		if ($validator->fails()) {
			return view('indicadores/indicadores_novo', compact('indicadores'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$indicadores = Indicadores::create($input);
			$indicadores = Indicadores::all();
            $grupo_indicadores = GrupoIndicadores::all();
			$validator = 'Indicador Cadastrado com Sucesso!';
			return view('indicadores/indicadores_cadastro', compact('indicadores','grupo_indicadores'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function indicadoresAlterar($id)
    {
        $indicadores = Indicadores::where('id',$id)->get();
        $unidades    = Unidades::all();
        $grupo_indicadores = GrupoIndicadores::orderby('nome','ASC')->get();
        return view('indicadores/indicadores_alterar', compact('indicadores','unidades','grupo_indicadores'));
    }

    public function updateIndicadores($id, Request $request)
    {
        $input       = $request->all();
	    $indicadores = Indicadores::where('id',$id)->get();
        $unidades    = Unidades::all();
        $grupo_indicadores = GrupoIndicadores::all();
		$validator = Validator::make($request->all(), [
			'grupo_id' => 'required|max:255',
            'status'   => 'required|max:255',
            'nome'     => 'required|max:255',
            'link'     => 'required|max:255'
        ]);
		if ($validator->fails()) {
			return view('indicadores/indicadores_alterar', compact('indicadores','unidades','grupo_indicadores'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$indicadores = Indicadores::find($id); 
			$indicadores->update($input);
	    	$indicadores = Indicadores::all();
			$validator ='Indicador Alterado com Sucesso!';
			return view('indicadores/indicadores_cadastro', compact('indicadores','grupo_indicadores'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function indicadoresExcluir($id)
    {
        $indicadores = Indicadores::where('id',$id)->get();
        $grupo_indicadores = GrupoIndicadores::all();
        return view('indicadores/indicadores_excluir', compact('indicadores','grupo_indicadores'));
    }

    public function destroyIndicadores($id, Request $request)
    {
        Indicadores::find($id)->delete();
		$indicadores       = Indicadores::all();
        $grupo_indicadores = GrupoIndicadores::all();
        $validator         = 'Indicador excluído com sucesso!';
		return view('indicadores/indicadores_cadastro', compact('indicadores','grupo_indicadores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
