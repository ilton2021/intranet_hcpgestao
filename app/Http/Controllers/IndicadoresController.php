<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicadores;
use App\Models\Unidades;
use App\Models\GrupoIndicadores;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Storage;
use DB;
use Validator;

class IndicadoresController extends Controller
{
    public function cadastroIndicadores()
    {
        $id_user = Auth::user()->id;
		$idTela = 4;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$indicadores = Indicadores::paginate(20);
            $grupo_indicadores = GrupoIndicadores::all();
            $unidades = Unidades::all();
            return view('indicadores/indicadores_cadastro', compact('indicadores','grupo_indicadores','unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function telaIndicador($id)
    {
        $indicadores = Indicadores::where('id', $id)->get();
        return view('indicadores/lista_indicador', compact('indicadores'));
    }

    public function pesquisarIndicadores(Request $request)
    {
        $id_user = Auth::user()->id;
        $unidades = Unidades::all();
		$idTela = 4;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            $grupo_indicadores = GrupoIndicadores::all();
            if ($pesq2 == "1") {
                $indicadores = Indicadores::where('nome', 'like', '%' . $pesq . '%')->paginate(20);
            } else if ($pesq2 == "2") {
                $indicadores = Indicadores::where('grupo_id', 'like', '%' . $pesq . '%')->paginate(20);
            } else if ($pesq2 == "3") {
                $unidade = Unidades::where('nome', 'like', '%' . $pesq . '%')->get();
                $qtd = sizeof($unidade);
                if($qtd == 0){
                    $indicadores = Indicadores::paginate(20);
                } else {
                    $indicadores = Indicadores::where('unidade_id','like','%'.$unidade[0]->id.'%')->paginate(20);
                }
            } else {
                $indicadores = Indicadores::paginate(20);
            }
            return view('indicadores/indicadores_cadastro', compact('indicadores','pesq','pesq2','grupo_indicadores','unidades'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function pesquisarIndicadoresGestores(Request $request)
    {
        $input  = $request->all();  
        $unidade = Auth::user()->unidade_id;
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
      	$pesq2 = $input['pesq2']; 
        $idU = Auth::user()->unidade_id;
        if($pesq2 != "") {
             if($idU != 7){
                $indicadores = Indicadores::where('grupo_id',$pesq2)->where('unidade_id',$unidade)->get();
                $qtd = sizeof($indicadores);
                $grupo_indicadores = DB::table('grupo_indicadores')
					->join('indicadores','indicadores.grupo_id','=','grupo_indicadores.id')
					->select('grupo_indicadores.nome','grupo_indicadores.id')
                    ->where('indicadores.unidade_id',$idU)
            		->groupby('grupo_indicadores.nome','grupo_indicadores.id')->get();
            } else {
                $indicadores = Indicadores::where('grupo_id',$pesq2)->get();
                $qtd = sizeof($indicadores);
                $grupo_indicadores = GrupoIndicadores::all();
            }
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
        $id_user = Auth::user()->id;
		$idTela = 4;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::all();
            $grupo_indicadores = GrupoIndicadores::all();
            return view('indicadores/indicadores_novo', compact('unidades','grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeIndicadores(Request $request)
    {
        $input     = $request->all();
        $unidades  = Unidades::all();
        $grupo_indicadores = GrupoIndicadores::all();
		$validator = Validator::make($request->all(), [
			'grupo_id' => 'required|max:255',
            'status'   => 'required|max:255',
            'nome'     => 'required|max:255',
            'link'     => 'required|max:255'
    	]);
		if ($validator->fails()) {
			return view('indicadores/indicadores_novo', compact('indicadores', 'grupo_indicadores','unidades'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$indicadores = Indicadores::create($input);
			$indicadores = Indicadores::paginate(20);
            $grupo_indicadores = GrupoIndicadores::all();
            $id = Indicadores::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator = 'Indicador Cadastrado com Sucesso!';
			return redirect()->route('cadastroIndicadores')
                ->withErrors($validator)
                ->with('indicadores', 'grupo_indicadores','unidades');
		}
	}

    public function indicadoresAlterar($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 4;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$indicadores = Indicadores::where('id',$id)->get();
            $unidades    = Unidades::all();
            $grupo_indicadores = GrupoIndicadores::orderby('nome','ASC')->get();
            return view('indicadores/indicadores_alterar', compact('indicadores','unidades','grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
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
	    	$indicadores = Indicadores::paginate(20);
            $input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$validator ='Indicador Alterado com Sucesso!';
			return redirect()->route('cadastroIndicadores')
                ->withErrors($validator)
                ->with('indicadores', 'grupo_indicadores','unidades');
		}
    }

    public function indicadoresExcluir($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 4;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$indicadores = Indicadores::where('id',$id)->get();
            $grupo_indicadores = GrupoIndicadores::all();
            return view('indicadores/indicadores_excluir', compact('indicadores','grupo_indicadores'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyIndicadores($id, Request $request)
    {
        $input = $request->all();
        $unidades = Unidades::all();
        $input['idTabela'] = $id;
		$loggers = Logger::create($input);
        Indicadores::find($id)->delete();
		$indicadores       = Indicadores::paginate(20);
        $grupo_indicadores = GrupoIndicadores::all();
        $validator         = 'Indicador excluído com sucesso!';
		return redirect()->route('cadastroIndicadores')
            ->withErrors($validator)
            ->with('indicadores', 'grupo_indicadores','unidades');
    }
}
