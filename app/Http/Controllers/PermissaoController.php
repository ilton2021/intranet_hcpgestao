<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissao;
use App\Models\User;
use App\Models\PermissaoUser;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Validator;
use DB;

class PermissaoController extends Controller
{
    public function cadastroPermissoes()
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$permissoes = Permissao::all();
            return view('permissao/permissao_cadastro', compact('permissoes'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function cadastroPermissaoNovo()
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			return view('permissao/permissao_novo');
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storePermissoes(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
			'tela' => 'required|max:255',
        ]);
		if ($validator->fails()) {
			return view('permissao/permissao_novo')
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
			$permissoes = Permissao::create($input);
			$permissoes = Permissao::all();
            $id = Permissao::all()->max('id');
            $input['tela'] = $input['tela_'];
			$input['idTabela'] = $id;
			$loggers = Logger::create($input);
			$validator = 'Permissão Cadastrado com Sucesso!';
			return redirect()->route('cadastroPermissoes')
                    ->withErrors($validator)
                    ->with('permissoes', 'validator');
		}
    }

    public function pesquisarPermissoes(Request $request)
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input  = $request->all();  
            if(empty($input['pesq'])) { $input['pesq'] = ""; }
            if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
            $pesq  = $input['pesq'];
            $pesq2 = $input['pesq2']; 
            if($pesq2 == "1") {
                $permissoes = Permissao::where('tela','like','%'.$pesq.'%')->get();
            } else {
                $permissoes = Permissao::all();
            }
            return view('permissao/permissao_cadastro', compact('permissoes','pesq','pesq2'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function permissaoAlterar($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$permissoes = Permissao::where('id',$id)->get();
            return view('permissao/permissao_alterar', compact('permissoes'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function updatePermissoes(Request $request, $id)
    {
        $input      = $request->all();
	    $permissoes = Permissao::where('id',$id)->get();
        $validator  = Validator::make($request->all(), [
			'tela' => 'required|max:255'
        ]);
		if ($validator->fails()) {
			return view('permissao/permissao_alterar', compact('permissoes'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$permissoes = Permissao::find($id); 
			$permissoes->update($input);
	    	$permissoes = Permissao::all();
            $input['idTabela'] = $id;
            $input['tela'] = $input['tela_'];
			$loggers = Logger::create($input);
			$validator ='Permissão Alterado com Sucesso!';
			return redirect()->route('cadastroPermissoes')
                    ->withErrors($validator)
                    ->with('permissoes', 'validator');
		}
    }

    public function permissaoExcluir($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$permissoes = Permissao::where('id',$id)->get();
            return view('permissao/permissao_excluir', compact('permissoes'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyPermissoes(Request $request, $id)
    {
        $input = $request->all();
        $input['idTabela'] = $id;
        $input['tela'] = $input['tela_'];
		$loggers = Logger::create($input);
        Permissao::find($id)->delete();
		$permissoes = Permissao::all();
        $validator = 'Permissão excluído com sucesso!';
		return redirect()->route('cadastroPermissoes')
						->withErrors($validator)
						->with('permissoes', 'validator');
    }

    public function permissaoVincular($id)
    {
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$permissoes = Permissao::where('id',$id)->get();
            $usuarios   = User::all();
            $perm_user = DB::table('permissao_user')
            ->join('permissao','permissao.id','=','permissao_user.permissao_id')
            ->join('users','users.id','=','permissao_user.user_id')
            ->where('permissao_user.permissao_id',$id)
            ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id')->get();
            return view('permissao/permissao_vincular_usuario', compact('permissoes','usuarios','perm_user'));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function storePermissaoUsers(Request $request, $id)
    {
        $input = $request->all();
        $permissoes = Permissao::where('id',$id)->get();
        $usuarios   = User::all();
        $perm_user = DB::table('permissao_user')
        ->join('permissao','permissao.id','=','permissao_user.permissao_id')
        ->join('users','users.id','=','permissao_user.user_id')
        ->where('permissao_user.permissao_id',$id)
        ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id')->get();
        $validator = Validator::make($request->all(), [
			'permissao_id' => 'required',
            'user_id'      => 'required'
        ]);
		if ($validator->fails()) {
			return view('permissao/permissao_vincular_usuario', compact('permissoes','usuarios','perm_user'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}else {
            $permissoes = PermissaoUser::create($input);
            $perm_user = DB::table('permissao_user')
            ->join('permissao','permissao.id','=','permissao_user.permissao_id')
            ->join('users','users.id','=','permissao_user.user_id')
            ->where('permissao_user.permissao_id',$id)
            ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id')->get();
            $permissoes = Permissao::where('id',$id)->get();
            $input['idTabela'] = $id;
            $input['user_id'] = $input['user_id_'];
			$loggers = Logger::create($input);
			$validator  = 'Permissão do Usuário Cadastrado com Sucesso!';
            return view('permissao/permissao_vincular_usuario', compact('permissoes','usuarios','perm_user'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
    }
    
    public function grupoVincularpfuserExcluir($id)
    {   
        echo $id;exit();
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
            $perm_user = DB::table('permissao_user')
            ->join('permissao','permissao.id','=','permissao_user.permissao_id')
            ->join('users','users.id','=','permissao_user.user_id')->where('permissao_user.permissao_id',$id)
            ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id',
            'permissao_user.permissao_id as permissao','permissao_user.user_id as user')->get();
            $permissoes = Permissao::where('id',$id)->get();
            $usuarios   = User::all();
            return view('permissao/permissao_excluir_usuario', compact('permissoes','usuarios','perm_user'))
                        ->withInput(session()->flashInput($request->input()));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function permissaoUserExcluir_(Request $request, $id_p, $id)
    {
        $input = $request->all();
        $id_user = Auth::user()->id;
		$idTela = 13;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if($validacao == "ok") {
			$input = $request->all(); 
            $perm_user = DB::table('permissao_user')
                ->join('permissao','permissao.id','=','permissao_user.permissao_id')
                ->join('users','users.id','=','permissao_user.user_id')
                ->where('permissao_user.id',$id)
                ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id',
                'permissao_user.permissao_id as permissao','permissao_user.user_id as user')->get();
            $qtd = sizeof($perm_user); 
            $permissoes = Permissao::where('id',$perm_user[0]->id)->get();
            $usuarios   = User::all();
            $input['idTabela'] = $id;
            $input['tela'] = 'excluir_vinculo_usuarios';
            $input['user_id'] = Auth::user()->id;
			$loggers = Logger::create($input);
            return view('permissao/permissao_excluir_usuario_', compact('permissoes','usuarios','perm_user'))
                ->withInput(session()->flashInput($request->input()));
		} else {
			$validator = "Você não tem Permissão para acessar esta tela!!!";
			return view('home')
				->withErrors($validator);
		}
    }

    public function destroyPermissaoUser(Request $request, $id_p, $id)
    { 
        $input = $request->all();
        $perm_user = DB::statement('DELETE FROM permissao_user WHERE id = '.$id);
        $perm_user = DB::table('permissao_user')
            ->join('permissao','permissao.id','=','permissao_user.permissao_id')
            ->join('users','users.id','=','permissao_user.user_id')
            ->where('permissao_user.id',$id)   
            ->select('permissao.tela as tela','users.name as usuario','permissao_user.id as id')->get();
        $permissoes = Permissao::all();
        $validator  = "Permissão do Usuário excluída com sucesso!";
        return redirect()->route('cadastroPermissoes')
                    ->withErrors($validator)
                    ->with('destaques', 'validator');
    }
}
