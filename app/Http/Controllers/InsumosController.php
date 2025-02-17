<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insumos;
use App\Models\TiposInsumos;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use DB;
use Validator;

class InsumosController extends Controller
{
    public function cadastroInsumos($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$insumos = DB::table('insumos')->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
							->select('insumos.*','tipos_insumos.nome as nomeTp')
							->where('insumos.tipo_refeicao',$id)->get();
            return view('insumos/insumos_cadastro', compact('insumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarInsumos($id, Request $request)
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
				$insumos = DB::table('insumos')->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
							->select('insumos.*','tipos_insumos.nome as nomeTp')
							->where('insumos.nome','like','%'.$pesq.'%')
							->where('insumos.tipo_refeicao',$id)->get();
            } else if($pesq2 == "2") {
				$insumos = DB::table('insumos')->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
							->select('insumos.*','tipos_insumos.nome as nomeTp')
							->where('tipos_insumos.nome','like','%'.$pesq.'%')
							->where('insumos.tipo_refeicao',$id)->get();
			} else {
				$insumos = DB::table('insumos')->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
							->select('insumos.*','tipos_insumos.nome as nomeTp')
							->where('insumos.tipo_refeicao',$id)->get();
			}
            return view('insumos/insumos_cadastro', compact('insumos','pesq','pesq2','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function insumosNovo($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$tiposInsumos = TiposInsumos::where('tipo_refeicao',$id)->get();
			return view('insumos/insumos_novo', compact('tiposInsumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeInsumos($id, Request $request)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
    	]);
		if ($validator->fails()) {
			return view('insumos/insumos_novo', compact('id'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$input['tipo_refeicao'] = $id;
			$insumos = Insumos::create($input);
			$insumos = Insumos::all();
			$id_in = Insumos::all()->max('id');
			$input['idTabela'] = $id_in;
			$loggers   = Logger::create($input);
			$validator = 'Insumo Cadastrado com Sucesso!';
			return redirect()->route('cadastroInsumos',$id)
                ->withErrors($validator)
                ->with('insumos');
		}
	}

    public function insumosAlterar($id, $id_i)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$insumos      = Insumos::where('id',$id_i)->get();
			$tiposInsumos = TiposInsumos::all();
            return view('insumos/insumos_alterar', compact('insumos','tiposInsumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updateInsumos($id, $id_i, Request $request)
    {
        $input   = $request->all();
	    $insumos = Insumos::where('id',$id_i)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
        ]);
		if ($validator->fails()) {
			return view('insumos/insumos_alterar', compact('insumos','id'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$insumos = Insumos::find($id_i); 
			$insumos->update($input);
	    	$insumos = Insumos::all();
			$input['idTabela'] = $id_i;
			$loggers   = Logger::create($input);
			$validator ='Insumo Alterado com Sucesso!';
			return redirect()->route('cadastroInsumos',$id)
                ->withErrors($validator)
                ->with('insumos');
		}
    }

    public function insumosExcluir($id, $id_i)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$insumos = Insumos::where('id',$id_i)->get();
            return view('insumos/insumos_excluir', compact('insumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyInsumos($id, $id_i, Request $request)
    {
		$input = $request->all();
		$input['idTabela'] = $id_i;
		$loggers = Logger::create($input);
        Insumos::find($id_i)->delete();
		$input = $request->all();
		$insumos = Insumos::all();
        $validator = 'Insumo excluído com sucesso!';
		return redirect()->route('cadastroInsumos',$id)
            ->withErrors($validator)
            ->with('insumos');
    }
}
