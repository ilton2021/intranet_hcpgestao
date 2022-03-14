<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Models\UserPerfil;
use App\Http\Controllers\PermissaoController;
use DB;
use Validator;

class SetoresController extends Controller
{
    public function cadastroSetores()
    {
        $id_user = Auth::user()->id;
		$idTela = 9;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = Setor::paginate(20);
            return view('setores/setores_cadastro', compact('setores'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function pesquisarSetores(Request $request)
    {
        $id_user = Auth::user()->id;
		$idTela = 9;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            if($pesq2 == "1") {
                $setores = Setor::where('nome','like','%'.$pesq.'%')->paginate(20);;
            } 
            return view('setores/setores_cadastro', compact('setores','pesq','pesq2'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function setoresNovo()
    {
        $id_user = Auth::user()->id;
		$idTela = 9;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			return view('setores/setores_novo');
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function storeSetores(Request $request)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
    	]);
		if ($validator->fails()) {
			return view('setores/setores_novo')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$setores = Setor::create($input);
			$setores = Setor::all();
			$id = Setor::all()->max('id');
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$setores = Setor::paginate(20);
			$validator = 'Setor Cadastrado com Sucesso!';
			return redirect()->route('cadastroSetores')
                ->withErrors($validator)
                ->with('setores');
		}
	}

    public function setoresAlterar($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 9;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = Setor::where('id',$id)->get();
            return view('setores/setores_alterar', compact('setores'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function updateSetores($id, Request $request)
    {
        $input   = $request->all();
	    $setores = Setor::where('id',$id)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
        ]);
		if ($validator->fails()) {
			return view('setores/setores_alterar', compact('setores'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$setores = Setor::find($id); 
			$setores->update($input);
	    	$setores = Setor::all();
			$input['idTabela'] = $id;
			$loggers   = Logger::create($input);
			$setores = Setor::paginate(20);
			$validator ='Setor Alterado com Sucesso!';
			return redirect()->route('cadastroSetores')
                ->withErrors($validator)
                ->with('setores');
		}
    }

    public function setoresExcluir($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 9;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$setores = Setor::where('id',$id)->get();
            return view('setores/setores_excluir', compact('setores'));
		} else {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return redirect()->route('home')
				->withErrors($validator)
				->with('perfil_user', 'validator');
		}
    }

    public function destroySetores($id, Request $request)
    {
		$input = $request->all();
		$input['idTabela'] = $id;
		$loggers = Logger::create($input);
        Setor::find($id)->delete();
		$input = $request->all();
		$setores = Setor::paginate(20);
        $validator = 'Setor excluído com sucesso!';
		return redirect()->route('cadastroSetores')
            ->withErrors($validator)
            ->with('setores');
    }
}
