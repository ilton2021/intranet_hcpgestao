<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardapiosDia;
use App\Models\Unidades;
use App\Models\Insumos;
use App\Models\UserPerfil;
use App\Models\QuestionarioRefeicao;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\PermissaoController;
use DB;
use Validator;

class CardapiosDiaController extends Controller
{
	// Função Tela de Escolha do Tipo de Cárdapio
	public function cadastroCardapiosDiaInicio()
    {
        $id_user    = Auth::user()->id;
		$idTela     = 18;
		$validacao  = PermissaoUserController::Permissao($id_user, $idTela);
		$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
        $perfil_user = array();
        for ($i = 0; $i < sizeof($UserPerfil); $i++) {
            $perfil_user[$i] = $UserPerfil[$i]->perfil_id;
        }
		if($validacao == "ok") {
			$cardapiosDia = DB::table('cardapios_dia')
			                 ->join('unidades','unidades.id','=','cardapios_dia.unidade_id')
							 ->join('insumos','insumos.id','=','cardapios_dia.insumos_1_id')
							 ->select('cardapios_dia.*','unidades.nome as unidNome','insumos.nome as nomeInsumo')
							 ->where('inativa',0)->get();
			$insumos = Insumos::all();
            return view('cardapios_dia/cardapios_dia_inicio_cadastro', compact('cardapiosDia','insumos','perfil_user'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home', compact('perfil_user'))->withErrors($validator);
		
		}
    }

	// Função Tela de Cadastro de Cardápio
    public function cadastroCardapiosDia($id)
    {
        $id_user = Auth::user()->id;
		$id_und  = Auth::user()->unidade_id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$cardapiosDia = DB::table('cardapios_dia')
			                 ->join('unidades','unidades.id','=','cardapios_dia.unidade_id')
							 ->join('insumos','insumos.id','=','cardapios_dia.insumos_1_id')
							 ->select('cardapios_dia.*','unidades.nome as unidNome','insumos.nome as nomeInsumo')
							 ->where('inativa',0)->where('cardapios_dia.tipo_refeicao',$id)
							 ->where('unidade_id',$id_und)->get();
			$insumos = Insumos::all();
            return view('cardapios_dia/cardapios_dia_cadastro', compact('cardapiosDia','insumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

	// Função Pesquisar na Tela do Cadastro de Cardápio
    public function pesquisarCardapiosDia($id, Request $request)
    {
        $id_user = Auth::user()->id;
		$id_und  = Auth::user()->unidade_id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            if($pesq != "") {
                $cardapiosDia = CardapiosDia::where('dia',$pesq)->where('unidade_id',$id_und)
									->where('cardapios_dia.tipo_refeicao',$id)->where('inativa',0)->get();
            } else {
				$cardapiosDia = DB::table('cardapios_dia')
			                 ->join('unidades','unidades.id','=','cardapios_dia.unidade_id')
							 ->join('insumos','insumos.id','=','cardapios_dia.insumos_1_id')
							 ->select('cardapios_dia.*','unidades.nome as unidNome','insumos.nome as nomeInsumo')
							 ->where('inativa',0)->where('cardapios_dia.tipo_refeicao',$id)
							 ->where('unidade_id',$id_und)->get();
			}
			$insumos = Insumos::all();
            return view('cardapios_dia/cardapios_dia_cadastro', compact('cardapiosDia','pesq','pesq2','id','insumos'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function cardapiosDiaNovo($id)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$unidades = Unidades::all();
			$insumos = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
			return view('cardapios_dia/cardapios_dia_novo', compact('unidades','insumos','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storeCardapiosDia($id, Request $request)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
			'dia' 		 => 'required|date',
			'unidade_id' => 'required|integer'
    	]);
		$unidades = Unidades::all();
		if ($validator->fails()) { 
			$insumos  = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
			return view('cardapios_dia/cardapios_dia_novo', compact('unidades','insumos','id'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$dia     = $input['dia'];
			$unidade = $input['unidade_id'];
			$valida  = CardapiosDia::where('dia',$dia)->where('unidade_id',$unidade)->where('tipo_refeicao',$id)->where('inativa',0)->get();
			
			$validacao = true;
			if($input['insumos_2_id'] != NULL){
				if($input['insumos_1_id'] == $input['insumos_2_id']) {
					$validacao = false;
				}				
			}
			if($input['insumos_3_id'] != NULL){
				if($input['insumos_1_id'] == $input['insumos_3_id']) {
					$validacao = false;
				}				
			}
			if($input['insumos_2_id'] != NULL && $input['insumos_3_id'] != NULL){
				if($input['insumos_2_id'] == $input['insumos_3_id']) {
					$validacao = false;
				}
			}
			if($validacao == false) {
				$insumos  = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
				$validator = 'Carnes repetidas, tente novamente!!';
				return view('cardapios_dia/cardapios_dia_novo', compact('unidades','insumos','id'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			} 
			
			if($input['insumos_4_id'] != NULL && $input['insumos_11_id'] != NULL) {
				if($input['insumos_4_id'] == $input['insumos_11_id']) {
				    $insumos  = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
					$validator = 'Feijão repetido, tente novamente!!';
					return view('cardapios_dia/cardapios_dia_novo', compact('unidades','insumos','id'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			}
			$qtdCard = sizeof($valida);
			if($qtdCard > 0) {
				$unidades = Unidades::all();
				$insumos  = DB::table('insumos')
							->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
							->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
				$validator = 'O Cardápio deste dia já foi cadastrado!!';
				return view('cardapios_dia/cardapios_dia_novo', compact('unidades','insumos','id'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			} else {
				$input['tipo_refeicao'] = $id;
				$input['inativa'] = 0;
				$cardapiosDia = CardapiosDia::create($input);
				$cardapiosDia = CardapiosDia::all();
				$id_c = CardapiosDia::all()->max('id');
				$input['idTabela'] = $id_c;
				$loggers   = Logger::create($input);
				$validator = 'Cardápio do Dia Cadastrado com Sucesso!';
				return redirect()->route('cadastroCardapiosDia', $id)
					->withErrors($validator)
					->with('cardapiosDia');
			}
		}
	}

    public function cardapiosDiaAlterar($id, $id_c)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$cardapiosDia = CardapiosDia::where('id',$id_c)->get();
			$insumos = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
			$unidades = Unidades::all();
            return view('cardapios_dia/cardapios_dia_alterar', compact('cardapiosDia','insumos','unidades','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updateCardapiosDia($id, $id_c, Request $request)
    {
        $input = $request->all();
	    $cardapiosDia = CardapiosDia::where('id',$id_c)->get();
		$unidades  = Unidades::all();
		$validator = Validator::make($request->all(), [
			'dia' 		 => 'required|date',
			'unidade_id' => 'required|integer'
        ]);
		if ($validator->fails()) {
			$insumos = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
			return view('cardapios_dia/cardapios_dia_alterar', compact('cardapiosDia','insumos','unidades','id'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			if($input['insumos_1_id'] == $input['insumos_2_id'] || $input['insumos_1_id'] == $input['insumos_3_id'] || ($input['insumos_2_id'] == $input['insumos_3_id'] && ($input['insumos_2_id'] != NULL && $input['insumos_3_id'] != NULL))) {
				$insumos  = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
				$validator = 'Carnes repetidas, tente novamente!!';
				return view('cardapios_dia/cardapios_dia_alterar', compact('unidades','insumos','cardapiosDia','id'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
			$cardapiosDia = CardapiosDia::find($id_c); 
			$cardapiosDia->update($input);
	    	$cardapiosDia = CardapiosDia::all();
			$input['idTabela'] = $id_c;
			$loggers   = Logger::create($input);
			$validator ='Cardápio do Dia Alterado com Sucesso!';
			return redirect()->route('cadastroCardapiosDia', $id)
                ->withErrors($validator)
                ->with('cardapiosDia');
		}
    }

    public function cardapiosDiaExcluir($id, $id_c)
    {
        $id_user = Auth::user()->id;
		$idTela  = 18;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$cardapiosDia = CardapiosDia::where('id',$id_c)->get();
			$insumos = DB::table('insumos')
						->join('tipos_insumos','tipos_insumos.id','=','insumos.tipos_insumos_id')
						->select('insumos.*','tipos_insumos.nome as nomeTipo')->get();
			$unidades = Unidades::all();
            return view('cardapios_dia/cardapios_dia_excluir', compact('cardapiosDia','insumos','unidades','id'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyCardapiosDia($id, $id_c, Request $request)
    {
		$input = $request->all();
		$input['idTabela'] = $id_c;
		$loggers = Logger::create($input);
		DB::statement('UPDATE cardapios_dia SET inativa = 1 WHERE id = '.$id_c.';');
		$input = $request->all();
		$cardapiosDia = CardapiosDia::all();
        $validator = 'Cardápio do Dia excluído com sucesso!';
		return redirect()->route('cadastroCardapiosDia', $id)
            ->withErrors($validator)
            ->with('cardapiosDia');
    }

	public function questCardapio($id, Request $request) 
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'resposta1' => 'required|max:1',
			'resposta4' => 'required|max:1000'
        ]);
		if ($validator->fails()) {
			return redirect()->route('cardapio',$id)
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		} else {
			$unidade = Unidades::where('id',$id)->get();
			$input['unidade_id'] = $unidade[0]->id;
			$input['dia'] = date('Y-m-d', strtotime('now'));
			$questionario = QuestionarioRefeicao::create($input);
			$validator    = 'Cardápio avaliado com sucesso!';
			$error	      = 'Mensagem enviada com sucesso!';
			return redirect()->route('cardapio', $id)->withErrors($validator)->with($error);
		}
	} 

	public function avaliacaoCardapio($id)
	{
		$id_u  = Auth::user()->unidade_id;
		$quest = QuestionarioRefeicao::where('tipo_refeicao',$id)->where('unidade_id',$id_u)->get();
		$qtd   = sizeof($quest); 
		$r1 = 0; $r2 = 0; $r3 = 0; 
		for($a = 0; $a < $qtd; $a++) {
			if($quest[$a]->resposta1 == 1) {
				$r1 += 1;
			} else if($quest[$a]->resposta1 == 2) {
				$r2 += 1;
			} else if($quest[$a]->resposta1 == 3) {
				$r3 += 1;
			} 
			if($quest[$a]->resposta2 == 1) {
				$r1 += 1;
			} else if($quest[$a]->resposta2 == 2) {
				$r2 += 1;
			} else if($quest[$a]->resposta2 == 3) {
				$r3 += 1;
			} 
			if($quest[$a]->resposta3 == 1) {
				$r1 += 1;
			} else if($quest[$a]->resposta3 == 2) {
				$r2 += 1;
			} else if($quest[$a]->resposta3 == 3) {
				$r3 += 1;
			} 
		}
		$unidades = Unidades::all();
		return view('cardapios_dia/cardapios_dia_graficos', compact('unidades','quest','r1','r2','r3','qtd','id'));
	}
}
