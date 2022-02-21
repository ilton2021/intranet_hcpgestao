<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use App\Models\Unidades;
use App\Models\AlterarSenha;
use App\Models\Indicadores;
use App\Models\GrupoIndicadores;
use App\Models\PerfilUser;
use Spatie\Permission\Models\Role;
use DB;
use Str;
use Hash;
use Validator;
use Mail;

class UserController extends Controller
{
	public function __construct(Unidades $unidade)
	{
		$this->unidade = $unidade;
	}
	
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

	public function cadastroUsuarios()
	{
		$usuarios = User::all();
		return view('users/users_cadastro', compact('usuarios'));
	}

	public function usuariosNovo()
	{
		$perfil_users = PerfilUser::all();
		$unidades     = Unidades::all();
		return view('users/users_novo', compact('perfil_users','unidades'));
	}

	public function usuariosAlterar($id)
	{
		$usuarios = User::where('id',$id)->get();
		$perfil_users = PerfilUser::all();
		$unidades = Unidades::all();
		return view('users/users_alterar', compact('usuarios','perfil_users','unidades')); 
	}

	public function usuariosExcluir($id)
	{
		$usuarios = User::where('id',$id)->get();
		return view('users/users_excluir', compact('usuarios'));
	}
	
	public function alterarSenhaUsuario($id)
	{
		$users = User::where('id',$id)->get();
		return view('users/users_resetar_senha', compact('users'));
	}

	public function telaLoginIndicador()
	{
		return view('auth.login_indicador');
	}

	public function telaRegistro()
	{
		return view('auth.register');
	}
	
	public function telaEmail()
	{
		return view('auth.passwords.email');
	}
	
	public function telaReset()
	{
		$token = '';
		return view('auth.passwords.reset', compact('token'));
	}
	
	public function Login(Request $request)
	{	
		$input = $request->all(); 		
		$validator = Validator::make($request->all(), [
			'email'    => 'required|email',
            'password' => 'required'
		]);		
		if ($validator->fails()) {
			return view('auth.login')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input())); 
		} else {
			$email = $input['email'];
			$senha = $input['password'];		
			$user = User::where('email', $email)->get();
			$qtd = sizeof($user); 			
			if ( empty($qtd) ) {
				$validator = 'Login Inválido!';
				return view('auth.login')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input())); 	
			} else {
				$unidades = $this->unidade->all();
				$user = User::find($user[0]->id);
				Auth::login($user);				
				$idU    = Auth::user()->unidade_id;
				$perfil = Auth::user()->perfil;
				if($perfil == "Administrador") {
					return view('home')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input())); 							
				}  else {
					$indicadores 	   = Indicadores::where('id',0)->get();
					if($idU != 7){
						$grupo_indicadores = DB::table('grupo_indicadores')
							->join('indicadores','indicadores.grupo_id','=','grupo_indicadores.id')
							->select('grupo_indicadores.nome','grupo_indicadores.id')
							->where('indicadores.unidade_id',$idU)
							->groupby('grupo_indicadores.nome','grupo_indicadores.id')->get();
					} else {
						$grupo_indicadores = GrupoIndicadores::all();
					}
					return view('indicadores/lista_indicadores', compact('unidades','user','grupo_indicadores','indicadores'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input())); 							
				}
			}
		}
	}

	public function emailReset(Request $request)
	{  
		$input = $request->all(); 
		$email = $input['email'];
		$usuarios = User::where('email',$email)->get();
		$qtd = sizeof($usuarios);
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);	
		if($validator->fails()){
			return view('auth.passwords.email', compact('email','usuarios'))
			->withErrors($validator)
			->withInput(session()->flashInput($request->input()));
		} else {
			
			if($qtd > 0){
				$input['token']   = Str::random('40');
				$input['user_id'] = $usuarios[0]->id;
				$alt_senha = AlterarSenha::where('token',$input['token'])->get();
				$qtdAlt = sizeof($alt_senha);
				if($qtdAlt > 0){
					$validator = 'ESTE TOKEN JÁ FOI CADASTRADO';
					return view('auth.passwords.email', compact('email','usuarios'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$alt = AlterarSenha::where('user_id', $input['user_id'])->get();
					$qtdUser = sizeof($alt);
					if($qtdUser > 0){
						DB::statement('DELETE FROM alterar_senha WHERE user_id = '.$input['user_id']);
					}
					$alt_senha = AlterarSenha::create($input);
					$token = DB::table('alterar_senha')->max('token');
					$email2 = 'ilton.albuquerque@hcpgestao.org.br';
					Mail::send('email.emailReset', ['token' => $token], function($m) use ($email,$email2,$token) {
						$m->from('ilton.albuquerque@hcpgestao.org.br', 'INTRANET HCPGESTÃO');
						$m->subject('Solicitação de Alteração de Senha');
						$m->to($email);
						$m->cc($email2);
					});		
					$validator = 'ABRA SUA CAIXA DE E-MAIL PARA VALIDAR SUA SENHA NOVA';
					return view('auth.passwords.email', compact('email','usuarios'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			}else{ 
				$validator = 'Este E-mail não foi cadastrado na INTRANET do HCPGESTÃO.';
				return view('auth.passwords.email', compact('email','usuarios'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}
	
	public function resetarSenha(Request $request)
	{ 
		$input = $request->all();		
		$token = "";
		$validator = Validator::make($request->all(), [
			'email'    => 'required|email',
            'password' => 'required|same:password_confirmation',
			'token_'   => 'required',
			'password_confirmation' => 'required'
    	]);		
		if ($validator->fails()) {
			return view('auth.passwords/reset', compact('token'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			if(!empty($input['password'])){ 
				$input['password'] = Hash::make($input['password']);
			}else{
				$input = array_except($input,array('password'));    
			}
			$email = $input['email'];
			$token_ = $input['token_'];
			$user = User::where('email',$email)->get();
			$qtd = sizeof($user);
			if($qtd > 0){
				$alt_senha = AlterarSenha::where('token',$token_)->where('user_id',$user[0]->id)->get();
				$qtdAlt = sizeof($alt_senha);
				if($qtdAlt > 0){
					$user = User::find($user[0]->id);
					$user->update($input);
					$validator = 'Senha alterada com sucesso!';
					$unidades  = $this->unidade->all();
					return view('auth.login', compact('unidades','user'))						
						  ->withErrors($validator)
						  ->withInput(session()->flashInput($request->input()));								
				} else {
					$validator = 'Token Inválido!';
					return view('auth.passwords.reset',compact('token'))						
						  ->withErrors($validator)
						  ->withInput(session()->flashInput($request->input()));								
				}
			} else {
				$validator = 'Usuário não existe!';
				$unidades  = Unidades::all();
				$token = '';
				return view('auth.passwords.reset', compact('unidades','user','token'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));								
			}
		}
	}
	
    public function storeUsuarios(Request $request)
    {
		$input = $request->all();
		$perfil_users = PerfilUser::all();
		$unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'name'     		   => 'required',
            'email'    		   => 'required|email|unique:users,email',
            'password' 		   => 'required|same:password_confirmation',
			'password_confirmation' => 'required',
			'perfil' 		   => 'required'
    	]);			 
		if ($validator->fails()) {
			return view('users/users_novo',compact('perfil_users','unidades'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			$input['password'] = Hash::make($input['password']);
			$user = User::create($input);
			$validator = 'Usuário cadastrado com sucesso!';
			$unidades  = Unidades::all();
			$usuarios  = User::all();
			return view('users/users_cadastro', compact('usuarios'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		}
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function alterarUsuarios(Request $request, $id)
    {
        $input = $request->all();
		$unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
            'name'   => 'required',
            'email'  => 'required|email',
			'perfil' => 'required'
        ]);
		if($validator->fails()) {
			$users = User::where('id',$id)->get();
			return view('users/users_cadastro_alterar', compact('users','unidades'))
			->withErrors($validator)
			->withInput(session()->flashInput($request->input()));						
		} else {
			$user = User::find($id);
			$user->update($input);
			$usuarios = User::all();
			$validator = "Usuário alterado com sucesso!!";
			return view('users/users_cadastro', compact('usuarios'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));						
		}
    }

	public function updateSenha(Request $request, $id)
	{
		$input = $request->all(); 
		$users = User::where('id',$id)->get();
		$validator = Validator::make($request->all(), [
			'password' 		   		=> 'required|same:password_confirmation',
			'password_confirmation' => 'required'
    	]);			 
		if ($validator->fails()) {
			return view('users/users_resetar_senha', compact('users'))
					  ->withErrors($validator)
                      ->withInput(session()->flashInput($request->input()));						
		} else {
			$input['password'] = Hash::make($input['password']); 
			$users = User::find($id);
			$users->update($input);
			$users = User::where('id',$id)->get();
			$validator = "Senha alterada com sucesso!!";
			return redirect()->route('alterarUsuario',[$id])
					->withErrors($validator)
					->with('users','validator');
		}	
	}

	public function deleteUsuario($id)
    {
        User::find($id)->delete();
		$validator = "Usuário excluído com sucesso!!";
		$usuarios = User::all();
        return view('users/users_cadastro', compact('usuarios'))
					->withErrors($validator);
    }
}