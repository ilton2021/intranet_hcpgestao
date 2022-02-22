<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissao;
use App\Models\PermissaoUser;
use Illuminate\Support\Facades\Auth;

class PermissaoUserController extends Controller
{
    public static function Permissao($id, $idTela)
	{
        $user = Auth::user()->id;
        $permissao_users = PermissaoUser::where('user_id', $user)->where('permissao_id',$idTela)->get();
		$qtd = sizeof($permissao_users);
		$validacao = '';
		for($i = 0; $i < $qtd; $i++) {
			if($permissao_users[$i]->user_id == Auth::user()->id) {
				$validacao = 'ok';
				break;
			} else {
				$validacao = 'erro';
			}
		}
        return $validacao;
    }
}
