<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PermissaoController;
use App\Models\Unidades;
use App\Models\User;
use App\Models\AlterarSenha;
use App\Models\Indicadores;
use App\Models\GrupoIndicadores;
use App\Models\PerfilUser;
use App\Models\PerfilUserIndica;
use App\Models\UserPerfil;
use App\Models\Logger;
use App\Models\PassHash;
use Spatie\Permission\Models\Role;
use DB;
use Str;
use Hash;
use Validator;
use Mail;
use Auth;

class UserController extends Controller
{
	public function __construct(Unidades $unidade)
	{
		$this->unidade = $unidade;
	}

	public function index(Request $request)
	{
		$data = User::orderBy('id', 'DESC')->paginate(5);
		return view('users.index', compact('data'))
			->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function create()
	{
		$roles = Role::pluck('name', 'name')->all();
		return view('users.create', compact('roles'));
	}

	public function cadastroUsuarios()
	{
		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$usuarios = DB::table('user_perfil')
				->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
				->join('users', 'users.id', '=', 'user_perfil.users_id')
				->join('unidades', 'users.unidade_id', '=', 'unidades.id')
				->select(
					'users.id as id',
					'users.name as name',
					'users.email as email',
					'unidades.sigla as unidade',
					DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
				)
				->groupBy('id', 'name', 'email', 'unidade')
				->orderby('name', 'asc')
				->get();
			return view('users/users_cadastro', compact('usuarios'));
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

	public function pesquisarUsuarios(Request $request)
	{

		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$input  = $request->all();
			if (empty($input['pesq'])) {
				$input['pesq'] = "";
			}
			if (empty($input['pesq2'])) {
				$input['pesq2'] = "";
			}
			$pesq  = $input['pesq'];
			$pesq2 = $input['pesq2'];
			if ($pesq2 == "1") {
				$usuarios = DB::table('user_perfil')
					->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
					->join('users', 'users.id', '=', 'user_perfil.users_id')
					->join('unidades', 'users.unidade_id', '=', 'unidades.id')
					->where('users.name', 'like', '%' . $pesq . '%')
					->select(
						'users.id as id',
						'users.name as name',
						'users.email as email',
						'unidades.sigla as unidade',
						DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
					)
					->groupBy('id', 'name', 'email', 'unidade')
					->orderby('name', 'asc')
					->get();
			} elseif ($pesq2 == "2") {
				$usuarios = DB::table('user_perfil')
					->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
					->join('users', 'users.id', '=', 'user_perfil.users_id')
					->join('unidades', 'users.unidade_id', '=', 'unidades.id')
					->where('users.email', 'like', '%' . $pesq . '%')
					->select(
						'users.id as id',
						'users.name as name',
						'users.email as email',
						'unidades.sigla as unidade',
						DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
					)
					->groupBy('id', 'name', 'email', 'unidade')
					->orderby('name', 'asc')
					->get();
			} elseif ($pesq2 == "3") {
				$usuarios = DB::table('user_perfil')
					->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
					->join('users', 'users.id', '=', 'user_perfil.users_id')
					->join('unidades', 'users.unidade_id', '=', 'unidades.id')
					->where('perfil_user.nome', 'like', '%' . $pesq . '%')
					->select(
						'users.id as id',
						'users.name as name',
						'users.email as email',
						'unidades.sigla as unidade',
						DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
					)
					->groupBy('id', 'name', 'email', 'unidade')
					->orderby('name', 'asc')
					->get();
			} elseif ($pesq2 == "4") {
				$usuarios = DB::table('user_perfil')
					->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
					->join('users', 'users.id', '=', 'user_perfil.users_id')
					->join('unidades', 'users.unidade_id', '=', 'unidades.id')
					->where('unidades.sigla', 'like', '%' . $pesq . '%')
					->select(
						'users.id as id',
						'users.name as name',
						'users.email as email',
						'unidades.sigla as unidade',
						DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
					)
					->groupBy('id', 'name', 'email', 'unidade')
					->orderby('name', 'asc')
					->get();
			} else {
				$usuarios = DB::table('user_perfil')
					->join('perfil_user', 'perfil_user.id', '=', 'user_perfil.perfil_id')
					->join('users', 'users.id', '=', 'user_perfil.users_id')
					->join('unidades', 'users.unidade_id', '=', 'unidades.id')
					->select(
						'users.id as id',
						'users.name as name',
						'users.email as email',
						'unidades.sigla as unidade',
						DB::raw("(GROUP_CONCAT(perfil_user.nome SEPARATOR ' | ')) as perfil")
					)
					->groupBy('id', 'name', 'email', 'unidade')
					->orderby('name', 'asc')
					->get();
			}
			return view('users/users_cadastro', compact('usuarios', 'pesq', 'pesq2'));
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

	public function usuariosNovo()
	{
		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$perfil_users = PerfilUser::all();
			$unidades     = Unidades::all();
			return view('users/users_novo', compact('perfil_users', 'unidades'));
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

	public function usuariosAlterar($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$perfil_id = UserPerfil::where('users_id', $id)->get();
			$perfil_idA = array();
			for ($i = 0; $i < sizeof($perfil_id); $i++) {
				$perfil_idA[$i] = $perfil_id[$i]->perfil_id;
			}
			$usuarios = User::where('id', $id)->get();
			$perfil_users = PerfilUser::all();
			$unidades = Unidades::all();
			return view('users/users_alterar', compact('usuarios', 'perfil_users', 'unidades', 'perfil_idA'));
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

	public function usuariosExcluir($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$usuarios = User::where('id', $id)->get();
			return view('users/users_excluir', compact('usuarios'));
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

	public function alterarSenhaUsuario($id)
	{
		$id_user = Auth::user()->id;
		$idTela = 5;
		$validacao = PermissaoUserController::Permissao($id_user, $idTela);
		if ($validacao == "ok") {
			$users = User::where('id', $id)->get();
			return view('users/users_resetar_senha', compact('users'));
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
		$unidades = Unidades::all();
		return view('auth.passwords.reset', compact('token','unidades'));
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
			$email   = $input['email'];
			$user    = User::where('email', $email)->get();
			$qtdUser = sizeof($user);
			if($qtdUser > 0) {
				if (PassHash::check_password($user[0]->password, $_POST['password'])) {
					$unidades = $this->unidade->all();
					$user 	  = User::find($user[0]->id);
					Auth::login($user);
					$idU    = Auth::user()->unidade_id;
					$user_perfil = UserPerfil::where('users_id', $user->id)->get();
					$perfisHome = array(1, 2, 3, 19, 21, 22); //Administrador, comunicação, qualidade, Controle de veiculos.
					$qtdHome = 0;
					for ($i = 0; $i < sizeof($user_perfil); $i++) {
						if (in_array($user_perfil[$i]->perfil_id, $perfisHome)) {
							$qtdHome = $qtdHome + 1;
						}
					}
					if ($qtdHome > 0) {
						$perfil_user = array();
						for ($i = 0; $i < sizeof($user_perfil); $i++) {
							$perfil_user[$i] = $user_perfil[$i]->perfil_id;
						}
						return view('home', compact('perfil_user'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					} else {
						$indicadores = Indicadores::where('id', 0)->get();
						if ($idU != 1) {
							$grupo_indicadores = DB::table('grupo_indicadores')
								->join('indicadores', 'indicadores.grupo_id', '=', 'grupo_indicadores.id')
								->select('grupo_indicadores.nome', 'grupo_indicadores.id', 'indicadores.link as link', 
										 'indicadores.nome as nomeInd', 'indicadores.status as status', 'indicadores.exibe')
								->where('indicadores.unidade_id', $idU)
								->groupby('grupo_indicadores.nome', 'grupo_indicadores.id', 'indicadores.link', 
								'indicadores.nome', 'indicadores.status', 'indicadores.exibe')
								->orderby('indicadores.nome')->get(); 
						} else {
							$grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
						}
						return view('indicadores/lista_indicadores', compact('unidades', 'user', 'grupo_indicadores', 'indicadores'))
							->withErrors($validator)
							->withInput(session()->flashInput($request->input()));
					}
				} else {
					$validator = 'Login Inválido!';
					return view('auth.login')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Usuário não cadastrado!';
					return view('auth.login')
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function emailReset(Request $request)
	{
		$input = $request->all();
		$email = $input['email'];
		$usuarios = User::where('email', $email)->get();
		$qtd = sizeof($usuarios);
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
		]);
		if ($validator->fails()) {
			return view('auth.passwords.email', compact('email', 'usuarios'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			if ($qtd > 0) {
				$input['token']   = Str::random('40');
				$input['user_id'] = $usuarios[0]->id;
				$alt_senha = AlterarSenha::where('token', $input['token'])->get();
				$qtdAlt = sizeof($alt_senha);
				if ($qtdAlt > 0) {
					$validator = 'ESTE TOKEN JÁ FOI CADASTRADO';
					return view('auth.passwords.email', compact('email', 'usuarios'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$alt = AlterarSenha::where('user_id', $input['user_id'])->get();
					$qtdUser = sizeof($alt);
					if ($qtdUser > 0) {
						DB::statement('DELETE FROM alterar_senha WHERE user_id = ' . $input['user_id']);
					}
					$alt_senha = AlterarSenha::create($input);
					$token  = DB::table('alterar_senha')->where('user_id',$input['user_id'])->max('token');
					$email2 = 'portal@hcpgestao.org.br';
					Mail::send('email.emailReset', ['token' => $token], function ($m) use ($email, $email2, $token) {
						$m->from('portal@hcpgestao.org.br', 'INTRANET HCPGESTÃO');
						$m->subject('Solicitação de Alteração de Senha');
						$m->to($email);
						$m->cc($email2);
					});
					$validator = 'ABRA SUA CAIXA DE E-MAIL PARA VALIDAR SUA SENHA NOVA';
					return view('auth.passwords.email', compact('email', 'usuarios'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Este E-mail não foi cadastrado na INTRANET do HCPGESTÃO.';
				return view('auth.passwords.email', compact('email', 'usuarios'))
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
			if (!empty($input['password'])) {
				$input['password'] = Hash::make($input['password']);
			} else {
				$input = array_except($input, array('password'));
			}
			$email  = $input['email'];
			$token_ = $input['token_'];
			$user   = User::where('email', $email)->get();
			$qtd    = sizeof($user);
			if ($qtd > 0) {
				$alt_senha = AlterarSenha::where('token', $token_)->where('user_id', $user[0]->id)->get();
				$qtdAlt = sizeof($alt_senha);
				if ($qtdAlt > 0) {
					$user = User::find($user[0]->id);
					$user->update($input);
					$validator = 'Senha alterada com sucesso!';
					$unidades  = $this->unidade->all();
					return view('auth.login', compact('unidades', 'user'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				} else {
					$validator = 'Token Inválido!';
					return view('auth.passwords.reset', compact('token'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
				}
			} else {
				$validator = 'Usuário não existe!';
				$unidades  = Unidades::all();
				$token = '';
				return view('auth.passwords.reset', compact('unidades', 'user', 'token'))
					->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
			}
		}
	}

	public function storeUsuarios(Request $request)
	{
		$input = $request->all();
		$perfil_users = PerfilUser::all();
		$unidades  = Unidades::all();
		$validator = Validator::make($request->all(), [
			'name'     		   => 'required',
			'email'    		   => 'required|email|unique:users,email',
			'password' 		   => 'required|same:password_confirmation',
			'password_confirmation' => 'required',
			'perfil_id' 		   => 'required'
		]);
		if ($validator->fails()) {
			return view('users/users_novo', compact('perfil_users', 'unidades'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$input['password'] = Hash::make($input['password']);
			$input['perfil'] = "";
			$user = User::create($input);
			$validator = 'Usuário cadastrado com sucesso!';
			$unidades  = Unidades::all();
			$usuarios  = User::all();
			$id = User::all()->max('id');
			$input['idTabela'] = $id;
			$loggers = Logger::create($input);
			$input['users_id'] = $id;
			$perfil_user = $input['perfil_id'];
			for ($i = 0; $i < sizeof($perfil_user); $i++) {
				$input['perfil_id'] = $perfil_user[$i];
				$User_perfil = UserPerfil::create($input);
			}
			return redirect()->route('cadastroUsuarios')
				->withErrors($validator)
				->with('usuarios', 'validator');
		}
	}

	public function show($id)
	{
		$user = User::find($id);
		return view('users.show', compact('user'));
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::pluck('name', 'name')->all();
		$userRole = $user->roles->pluck('name', 'name')->all();
		return view('users.edit', compact('user', 'roles', 'userRole'));
	}

	public function alterarUsuarios(Request $request, $id)
	{
		$input = $request->all();
		$unidades  = Unidades::all();
		$perfil_users = PerfilUser::all();
		$users_id = UserPerfil::where('users_id', $id)->get();
		$users_idA = array();
		for ($i = 0; $i < sizeof($users_id); $i++) {
			$users_idA[$i] = $users_id[$i]->perfil_id;
		}
		$validator = Validator::make($request->all(), [
			'name'   => 'required',
			'email'  => 'required|email',
			'perfil_id' => 'required'
		]);
		if ($validator->fails()) {
			$usuarios = User::where('id', $id)->get();
			$perfil_users = PerfilUser::all();
			$unidades = Unidades::all();
			return view('users/users_alterar', compact('usuarios', 'perfil_users', 'unidades', 'users_idA'))
				->withErrors($validator)
				->withInput(session()->flashInput($request->input()));
		} else {
			$user = User::find($id);
			$user->update($input);
			$perfil_user = $input['perfil_id'];
			$perfil_id = UserPerfil::where('users_id', $id)->get();
			$perfil_idA = array();
			for ($i = 0; $i < sizeof($perfil_id); $i++) {
				$perfil_idA[$i] = $perfil_id[$i]->perfil_id;
			}
			for ($i = 0; $i < sizeof($perfil_idA); $i++) {
				if (in_array($perfil_idA[$i], $perfil_user) == false) {
					UserPerfil::where('users_id', $user->id)->where('perfil_id', $perfil_idA[$i])->delete();
				}
			}
			$perfil_id = UserPerfil::where('users_id', $id)->get();
			$perfil_idA = array();
			for ($i = 0; $i < sizeof($perfil_id); $i++) {
				$perfil_idA[$i] = $perfil_id[$i]->perfil_id;
			}
			for ($i = 0; $i < sizeof($perfil_user); $i++) {
				if (in_array($perfil_user[$i], $perfil_idA) == false) {
					$input['users_id'] = $id;
					$input['perfil_id'] = $perfil_user[$i];
					$User_perfil = UserPerfil::create($input);
				}
			}
			$usuarios = User::all();
			$validator = "Usuário alterado com sucesso!!";
			$input['idTabela'] = $id;
			$loggers = Logger::create($input);
			return redirect()->route('cadastroUsuarios')
				->withErrors($validator)
				->with('usuarios', 'validator');
		}
	}

	public function updateSenha(Request $request, $id)
	{
		$input = $request->all();
		$users = User::where('id', $id)->get();
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
			$users = User::where('id', $id)->get();
			$validator = "Senha alterada com sucesso!!";
			return redirect()->route('alterarUsuario', [$id])
				->withErrors($validator)
				->with('users', 'validator');
		}
	}

	public function deleteUsuario(Request $request, $id)
	{
		$input = $request->all();
		$input['idTabela'] = $id;
		$input['user_id']  = $input['user_id_'];
		$loggers = Logger::create($input);
		UserPerfil::where('users_id', $id)->delete();
		User::find($id)->delete();
		$validator = "Usuário excluído com sucesso!!";
		$usuarios  = User::all();
		return redirect()->route('cadastroUsuarios')
			->withErrors($validator)
			->with('usuarios', 'validator');
	}
}
