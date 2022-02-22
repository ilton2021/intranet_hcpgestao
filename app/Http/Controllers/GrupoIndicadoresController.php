<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrupoIndicadores;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use Storage;
use DB;
use Validator;

class GrupoIndicadoresController extends Controller
{
    public function cadastroGrupoIndicadores()
    {
        $id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::all();
            return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarGrupoIndicadores(Request $request)
    {
        $id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            if($pesq2 == "1") {
                $grupo_indicadores = GrupoIndicadores::where('nome','like','%'.$pesq.'%')->get();
            } 
            return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores','pesq','pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function indicadoresGrupoNovo()
    {
        $id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			return view('grupo_indicadores/grupo_indicadores_novo');
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
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
			$id = GrupoIndicadores::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator = 'Grupo de Indicadores Cadastrado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function indicadoresGrupoAlterar($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::where('id',$id)->get();
            return view('grupo_indicadores/grupo_indicadores_alterar', compact('grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
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
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator ='Grupo de Indicadores Alterado com Sucesso!';
			return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function indicadoresGrupoExcluir($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 14;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$grupo_indicadores = GrupoIndicadores::where('id',$id)->get();
            return view('grupo_indicadores/grupo_indicadores_excluir', compact('grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyGrupoIndicadores($id, Request $request)
    {
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
        GrupoIndicadores::find($id)->delete();
		$grupo_indicadores = GrupoIndicadores::all();
        $validator = 'Grupo de Indicadores excluído com sucesso!';
		return view('grupo_indicadores/grupo_indicadores_cadastro', compact('grupo_indicadores'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
