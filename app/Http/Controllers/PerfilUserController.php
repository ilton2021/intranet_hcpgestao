<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PerfilUser;
use Storage;
use DB;
use Validator;

class PerfilUserController extends Controller
{
    public function cadastroPerfilUsuarios()
    {
        $perfil_users = PerfilUser::all();
        return view('perfil_users/perfil_users_cadastro', compact('perfil_users'));
    }

    public function pesquisarPerfilUsuarios(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $perfil_users = PerfilUser::where('nome','like','%'.$pesq.'%')->get();
        } 
        return view('perfil_users/perfil_users_cadastro', compact('perfil_users','pesq','pesq2'));
    }

    public function usuariosPerfilNovo()
    {
        return view('perfil_users/perfil_users_novo');
    }

    public function storePerfilUsuarios(Request $request)
    {
        $input = $request->all();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
    	]);
		if ($validator->fails()) {
			return view('perfil_users/perfil_users_novo')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$perfil_users = PerfilUser::create($input);
			$perfil_users = PerfilUser::all();
			$validator = 'Perfil do Usuário Cadastrado com Sucesso!';
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function usuariosPerfilAlterar($id)
    {
        $perfil_users = PerfilUser::where('id',$id)->get();
        return view('perfil_users/perfil_users_alterar', compact('perfil_users'));
    }

    public function updatePerfilUsuarios($id, Request $request)
    {
        $input   = $request->all();
	    $perfil_users = PerfilUser::where('id',$id)->get();
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:255',
        ]);
		if ($validator->fails()) {
			return view('perfil_users/perfil_users_alterar', compact('perfil_users'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$perfil_users = PerfilUser::find($id); 
			$perfil_users->update($input);
	    	$perfil_users = PerfilUser::all();
			$validator ='Perfil do Usuário Alterado com Sucesso!';
			return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function usuariosPerfilExcluir($id)
    {
        $perfil_users = PerfilUser::where('id',$id)->get();
        return view('perfil_users/perfil_users_excluir', compact('perfil_users'));
    }

    public function destroyPerfilUsuarios($id, Request $request)
    {
        PerfilUser::find($id)->delete();
		$perfil_users = PerfilUser::all();
        $validator = 'Perfil do Usuário excluído com sucesso!';
		return view('perfil_users/perfil_users_cadastro', compact('perfil_users'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }

}
