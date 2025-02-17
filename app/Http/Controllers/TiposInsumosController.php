<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiposInsumos;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use DB;
use Validator;

class TiposInsumosController extends Controller
{
    public function cadastroTiposInsumos($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$tiposInsumos = TiposInsumos::where('tipo_refeicao',$id)->get();
            return view('tipos_insumos/tipos_insumos_cadastro', compact('tiposInsumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarTiposInsumos($id, Request $request)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            if($pesq2 == "1") {
                $tiposInsumos = TiposInsumos::where('nome','like','%'.$pesq.'%')
												->where('tipo_refeicao',$id)->get();
            } 
            return view('tipos_insumos/tipos_insumos_cadastro', compact('tiposInsumos','pesq','pesq2','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function tiposInsumosNovo($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			return view('tipos_insumos/tipos_insumos_novo', compact('id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeTiposInsumos($id, Request $request)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
    	]);
		if ($validator->fails()) {
			return view('tipos_insumos/tipos_insumos_novo', compact('id'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$tiposInsumos = TiposInsumos::create($input);
			$tiposInsumos = TiposInsumos::all();
			$id_ti 		  = TiposInsumos::all()->max('id');
			$input['idTabela'] = $id_ti;
			$loggers   = Logger::create($input);
			$validator = 'Tipo de Insumo Cadastrado com Sucesso!';
			return redirect()->route('cadastroTiposInsumos', $id)
                ->withErrors($validator)
                ->with('tiposInsumos');
		}
	}

    public function tiposInsumosAlterar($id, $id_ti)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$tiposInsumos = TiposInsumos::where('id',$id_ti)->get();
            return view('tipos_insumos/tipos_insumos_alterar', compact('tiposInsumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updateTiposInsumos($id, $id_ti, Request $request)
    {
        $input = $request->all();
	    $tiposInsumos = TiposInsumos::where('id',$id_ti)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
        ]);
		if ($validator->fails()) {
			return view('tipos_insumos/tipos_insumos_alterar', compact('tiposInsumos','id'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$tiposInsumos = TiposInsumos::find($id_ti); 
			$tiposInsumos->update($input);
	    	$tiposInsumos = TiposInsumos::all();
			$input['idTabela'] = $id_ti;
			$loggers   = Logger::create($input);
			$validator ='Tipo de Insumo Alterado com Sucesso!';
			return redirect()->route('cadastroTiposInsumos', $id)
                ->withErrors($validator)
                ->with('tiposInsumos');
		}
    }

    public function tiposInsumosExcluir($id, $id_ti)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$tiposInsumos = TiposInsumos::where('id',$id_ti)->get();
            return view('tipos_insumos/tipos_insumos_excluir', compact('tiposInsumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyTiposInsumos($id, $id_ti, Request $request)
    {
		$input = $request->all();
		$input['idTabela'] = $id_ti;
		$loggers = Logger::create($input);
        TiposInsumos::find($id_ti)->delete();
		$input = $request->all();
		$tiposInsumos = TiposInsumos::all();
        $validator = 'Tipo de Insumo excluído com sucesso!';
		return redirect()->route('cadastroTiposInsumos', $id)
            ->withErrors($validator)
            ->with('tiposInsumos');
    }
}
