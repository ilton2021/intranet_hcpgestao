<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicadores;
use App\Models\Unidades;
use App\Models\GrupoIndicadores;
use App\Models\Logger;
use App\Models\PerfilUser;
use App\Models\PerfilUserIndica;
use App\Models\GrupoPerfilUser;
use App\Models\UserPerfil;
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
        if ($validacao == "ok") {
            $indicadores = Indicadores::paginate(20);
            $grupo_indicadores = GrupoIndicadores::all();
            $unidades = Unidades::all();
            return view('indicadores/indicadores_cadastro', compact('indicadores', 'grupo_indicadores', 'unidades'));
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
            $grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
            if ($pesq2 == "1") {
                $indicadores = Indicadores::where('nome', 'like', '%' . $pesq . '%')->paginate(20);
            } else if ($pesq2 == "2") {
                $indicadores = Indicadores::where('grupo_id', 'like', '%' . $pesq . '%')->paginate(20);
            } else if ($pesq2 == "3") {
                $indicadores = DB::table('indicadores')
                    ->join('unidades', 'unidades.id', '=', 'indicadores.unidade_id')
                    ->where('unidades.sigla', 'like', '%' . $pesq . '%')
                    ->select(
                        'indicadores.nome as nome',
                        'indicadores.link as link',
                        'indicadores.unidade_id as unidade_id',
                        'indicadores.id as id',
                        'indicadores.grupo_id as grupo_id',
                    )->orderby('nome', 'asc')
                    ->paginate(20);
            } else if ($pesq2 == "4") {
                $indicadores = Indicadores::where('link', 'like', '%' . $pesq . '%')->paginate(20);
            } else {
                $indicadores = Indicadores::paginate(20);
            }
            return view('indicadores/indicadores_cadastro', compact('indicadores', 'pesq', 'pesq2', 'grupo_indicadores', 'unidades'));
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

    public function pesquisarIndicadoresGestores(Request $request)
    {
        $input  = $request->all();
        $unidades = Unidades::all();
        $unidade = Auth::user()->unidade_id;
        if (empty($input['pesq2'])) {
            $input['pesq2'] = "";
        }
        $pesq2 = $input['pesq2'];
        $idU = Auth::user()->unidade_id;
        $idUser = Auth::user()->id;
        if ($pesq2 != "") {
            if ($idU != 1) {
                $user_perfil = UserPerfil::where('users_id', $idUser)->get();
                $perfisUser = array();
                for ($i = 0; $i < sizeof($user_perfil); $i++) {
                    $perfisUser[$i] = $user_perfil[$i]->perfil_id;
                }
                $indicadores = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->whereIn('perfil_user_indica.perfil_id', $perfisUser)
                    ->where('indicadores.grupo_id', $pesq2)
                    ->where('indicadores.unidade_id', $unidade)
                    ->orderBy('indicadores.nome', 'ASC')->get();
                $qtd = sizeof($indicadores);

                $grupo_indicadores = DB::table('grupo_indicadores')
                    ->join('indicadores', 'indicadores.grupo_id', '=', 'grupo_indicadores.id')
                    ->select('grupo_indicadores.nome', 'grupo_indicadores.id')
                    ->where('indicadores.unidade_id', $idU)
                    ->groupby('grupo_indicadores.nome', 'grupo_indicadores.id')
                    ->orderBy('nome', 'ASC')->get();
            } else {
                $user_perfil = UserPerfil::where('users_id', $idUser)->get();
                $perfisUser = array();
                for ($i = 0; $i < sizeof($user_perfil); $i++) {
                    $perfisUser[$i] = $user_perfil[$i]->perfil_id;
                }
                $indicadores = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->whereIn('perfil_user_indica.perfil_id', $perfisUser)
                    ->where('indicadores.grupo_id', $pesq2)
                    ->orderBy('indicadores.nome', 'ASC')->get();
                $qtd = sizeof($indicadores);
            }
            if ($qtd == 0) {
                $grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
                $validator = 'Não existe nenhum Indicador cadastrado nesta Unidade deste Grupo!';
                return view('indicadores/lista_indicadores', compact('indicadores', 'pesq2', 'grupo_indicadores', 'unidades'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            } else {
                $grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
                return view('indicadores/lista_indicadores', compact('indicadores', 'pesq2', 'grupo_indicadores', 'unidades'));
            }
        } else {
            $indicadores = Indicadores::where('id', 0)->get();
            $validator = 'Selecione um Grupo de Indicadores!';
            $grupo_indicadores = GrupoIndicadores::orderby('nome', 'ASC')->get();
            return view('indicadores/lista_indicadores', compact('indicadores', 'pesq2', 'grupo_indicadores', 'unidades'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        }
    }

    public function indicadoresNovo()
    {
        $id_user = Auth::user()->id;
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $unidades = Unidades::all();
            $grupo_indicadores = GrupoIndicadores::all();
            return view('indicadores/indicadores_novo', compact('unidades', 'grupo_indicadores'));
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
            return view('indicadores/indicadores_novo', compact('indicadores', 'grupo_indicadores', 'unidades'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $indicadores = Indicadores::create($input);
            $indicadores = Indicadores::paginate(20);
            $grupo_indicadores = GrupoIndicadores::all();
            $id = Indicadores::all()->max('id');
            $input['idTabela'] = $id;
            $loggers   = Logger::create($input);
            $validator = 'Indicador Cadastrado com Sucesso!';
            return redirect()->route('cadastroIndicadores')
                ->withErrors($validator)
                ->with('indicadores', 'grupo_indicadores', 'unidades');
        }
    }

    public function indicadoresAlterar($id)
    {
        $id_user = Auth::user()->id;
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $indicadores = Indicadores::where('id', $id)->get();
            $unidades    = Unidades::all();
            $grupo_indicadores = GrupoIndicadores::orderby('nome', 'ASC')->get();
            return view('indicadores/indicadores_alterar', compact('indicadores', 'unidades', 'grupo_indicadores'));
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

    public function updateIndicadores($id, Request $request)
    {
        $input       = $request->all();
        $indicadores = Indicadores::where('id', $id)->get();
        $unidades    = Unidades::all();
        $grupo_indicadores = GrupoIndicadores::all();
        $validator = Validator::make($request->all(), [
            'grupo_id' => 'required|max:255',
            'status'   => 'required|max:255',
            'nome'     => 'required|max:255',
            'link'     => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return view('indicadores/indicadores_alterar', compact('indicadores', 'unidades', 'grupo_indicadores'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $indicadores = Indicadores::find($id);
            $indicadores->update($input);
            $indicadores = Indicadores::paginate(20);
            $input['idTabela'] = $id;
            $loggers   = Logger::create($input);
            $validator = 'Indicador Alterado com Sucesso!';
            return redirect()->route('cadastroIndicadores')
                ->withErrors($validator)
                ->with('indicadores', 'grupo_indicadores', 'unidades');
        }
    }

    public function indicadoresExcluir($id)
    {
        $id_user = Auth::user()->id;
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $indicadores = Indicadores::where('id', $id)->get();
            $grupo_indicadores = GrupoIndicadores::all();
            return view('indicadores/indicadores_excluir', compact('indicadores', 'grupo_indicadores'));
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
            ->with('indicadores', 'grupo_indicadores', 'unidades');
    }

    public function indicadorVincular($id)
    {
        $id_user = Auth::user()->id;
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $Indicadores = Indicadores::where('id', $id)->get();
            $perfilUser = PerfilUser::orderby('nome', 'ASC')->get();
            $Indi_pfUser = DB::table('perfil_user_indica')
                ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
                ->where('perfil_user_indica.indicador_id', $id)
                ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
            return view('indicadores/indica_vincular_perf_user', compact('Indicadores', 'perfilUser', 'Indi_pfUser'));
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

    public function storeIndiPerfUsers(Request $request, $id)
    {
        $input = $request->all();
        $Indicadores = Indicadores::where('id', $id)->get();
        $perfilUser = PerfilUser::all();
        $Indi_pfUser = DB::table('perfil_user_indica')
            ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
            ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
            ->where('perfil_user_indica.indicador_id', $id)
            ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
        $validator = Validator::make($request->all(), [
            'grupo_indic_id' => 'required',
            'perfil_user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return view('indicadores/indica_vincular_perf_user', compact('Indicadores', 'perfilUser', 'Indi_pfUser'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $Indicadores = Indicadores::where('id', $id)->get();
            $perfilUser = PerfilUser::all();
            $Indi_pfUser = DB::table('perfil_user_indica')
                ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
                ->where('perfil_user_indica.indicador_id', $id)->where('perfil_user_indica.perfil_id', $input['perfil_user_id'])
                ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();

            if (sizeof($Indi_pfUser) > 0) {
                $Indicadores = Indicadores::where('id', $id)->get();
                $perfilUser = PerfilUser::all();
                $Indi_pfUser = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
                    ->where('perfil_user_indica.indicador_id', $id)
                    ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
                $validator = "Já existe um perfil de usúario vinculado a este grupo de indicador !";
                return view('indicadores/indica_vincular_perf_user', compact('Indicadores', 'perfilUser', 'Indi_pfUser'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            } else {
                $input['perfil_id'] = $input['perfil_user_id'];
                $input['indicador_id'] = $id;
                $IndicaPerfilUser = PerfilUserIndica::create($input);
                $Indi_pfUser_atual = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
                    ->where('perfil_user_indica.indicador_id', $id)
                    ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
                $input['idTabela'] = $Indi_pfUser_atual[0]->id;
                $input['user_id'] = $input['user_id_'];
                $loggers = Logger::create($input);
                $Indicadores = Indicadores::where('id', $id)->get();
                $validator  = 'Vinculo entre indicador e perfil do usuário efetuado com Sucesso!';
                return redirect()->route('indicadorVincular', $id)
                    ->withErrors($validator)
                    ->with('Indicadores', 'perfilUser', 'Indi_pfUser');
            }
        }
    }
    public function indicaVincularExcluir(Request $request, $id, $id_p)
    {
        $input = $request->all();
        $id_user = Auth::user()->id;
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $Indicadores = Indicadores::where('id', $id)->get();
            $perfilUser = PerfilUser::all();
            $Indi_pfUser = DB::table('perfil_user_indica')
                ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
                ->where('perfil_user_indica.indicador_id', $id)->where('perfil_user_indica.perfil_id', $id_p)
                ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
            $qtd = sizeof($Indi_pfUser);
            return view('indicadores/indica_vincular_perf_user_excluir', compact('Indicadores', 'perfilUser', 'Indi_pfUser'))
                ->withInput(session()->flashInput($request->input()));
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
    public function destroyIndUser(Request $request, $id, $id_p)
    {
        $input = $request->all();
        $Indi_pfUser = DB::table('perfil_user_indica')
            ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
            ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
            ->where('perfil_user_indica.indicador_id', $id)->where('perfil_user_indica.perfil_id', $id_p)
            ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
        echo "indicador id: " . $id . "<br><br> perfil id: " . $id_p;
        $input['idTabela'] = $Indi_pfUser[0]->id;
        $Indi_pfUser = DB::statement('DELETE FROM perfil_user_indica WHERE id = ' . $Indi_pfUser[0]->id);
        $input['tela'] = 'excluir_vinculo_indica_PfUser';
        $input['user_id'] = Auth::user()->id;
        $loggers = Logger::create($input);
        $Indi_pfUser = DB::table('perfil_user_indica')
            ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
            ->join('perfil_user', 'perfil_user.id', '=', 'perfil_user_indica.perfil_id')
            ->where('perfil_user_indica.indicador_id', $id)
            ->select('indicadores.nome as indicador', 'perfil_user.nome as perfil', 'perfil_user.id as id_perfil', 'perfil_user_indica.id as id')->get();
        $Indicadores = Indicadores::where('id', $id)->get();
        $perfilUser = PerfilUser::all();
        $validator  = "Perfil Usuário excluído com sucesso!";
        return redirect()->route('indicadorVincular', $id)
            ->withErrors($validator)
            ->with('Indicadores', 'perfilUser', 'Indi_pfUser');
    }

    public function showIndicador($id, $id_g)
    {
        $id_user = Auth::user()->id;
        $unidades = Unidades::all();
        $idTela = 4;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $unidades = Unidades::all();
            $unidade = Auth::user()->unidade_id;
            $idU = Auth::user()->unidade_id;
            $idUser = Auth::user()->id;
            if ($idU != 1) {
                $user_perfil = UserPerfil::where('users_id', $idUser)->get();
                $perfisUser = array();
                for ($i = 0; $i < sizeof($user_perfil); $i++) {
                    $perfisUser[$i] = $user_perfil[$i]->perfil_id;
                }
                $indicadores = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->whereIn('perfil_user_indica.perfil_id', $perfisUser)
                    ->where('indicadores.grupo_id', $id_g)
                    ->where('indicadores.unidade_id', $unidade)
                    ->where('indicadores.id',$id)
                    ->orderBy('indicadores.nome', 'ASC')->get();
                $qtd = sizeof($indicadores);

                $grupo_indicadores = DB::table('grupo_indicadores')
                    ->join('indicadores', 'indicadores.grupo_id', '=', 'grupo_indicadores.id')
                    ->select('grupo_indicadores.nome', 'grupo_indicadores.id')
                    ->where('indicadores.unidade_id', $idU)
                    ->groupby('grupo_indicadores.nome', 'grupo_indicadores.id')
                    ->orderBy('nome', 'ASC')->get();
            } else {
                $user_perfil = UserPerfil::where('users_id', $idUser)->get();
                $perfisUser = array();
                for ($i = 0; $i < sizeof($user_perfil); $i++) {
                    $perfisUser[$i] = $user_perfil[$i]->perfil_id;
                }
                $indicadores = DB::table('perfil_user_indica')
                    ->join('indicadores', 'indicadores.id', '=', 'perfil_user_indica.indicador_id')
                    ->whereIn('perfil_user_indica.perfil_id', $perfisUser)
                    ->where('indicadores.grupo_id', $id_g)
                    ->where('indicadores.id',$id)
                    ->orderBy('indicadores.nome', 'ASC')->get();
                $qtd = sizeof($indicadores);
            }
            if ($qtd == 0) {
                $grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
                $validator = 'Você não tem permissão para acessar!';
                return view('indicadores/lista_indicadores', compact('indicadores', 'grupo_indicadores', 'unidades'))
                    ->withErrors($validator);
            } else {
                $grupo_indicadores = GrupoIndicadores::orderBy('nome', 'ASC')->get();
                return view('indicadores/show_indicador', compact('indicadores', 'grupo_indicadores', 'unidades'));
            }
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
}
