<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use App\Models\AvaliacaoExperiencia;
use App\Models\Logger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AvaliacaoExperienciaController extends Controller
{
    public function avaliacaoExp()
    {
        $unidades   = Unidades::all();
        return view('avaliacao_experiencia', compact('unidades'));
    }

    public function avaliacaoExpStore(Request $request)
    {
        $input    = $request->all(); 
        $unidades = Unidades::all();
        $validator = Validator::make($request->all(), [
			'colaborador'  => 'required|max:255',
            'vaga'         => 'required|max:255',
            'gestor'       => 'required|max:255',
            'unidade'      => 'required|max:255',
            'continuidade' => 'required|max:255',
            'resultado'    => 'required|max:255'
    	]);
		if ($validator->fails()) {
			return redirect()->route('avaliacaoExp')
                ->withErrors($validator)
                ->with('unidades');
		} else {
            $avaliacaoExp = AvaliacaoExperiencia::create($input);
			$avaliacaoExp = AvaliacaoExperiencia::all();
			$id 	      = AvaliacaoExperiencia::all()->max('id');
            $validator    = 'Avaliação de Experiência Cadastrado com Sucesso!';
            $nome         = $input['gestor'];
            $colaborador  = $input['colaborador'];
            $email1       = 'verusca.santos@hcpgestao.org.br';
            $email2       = 'rita.tavares@hcpgestao.org.br';
            Mail::send([], [], function($m) use ($email1,$email2,$colaborador,$nome) {
				$m->from('portal@hcpgestao.org.br', 'Portal Intranet');
				$m->subject('Avaliação de Experiência');
				$m->setBody('O Gestor: '.$nome.' respondeu a avaliação de: '.$colaborador.'. Acesse a Intranet para visualizar! Acesse: http://10.0.0.12/login');
				$m->to($email1);
                $m->cc($email2);
			});
			return redirect()->route('avaliacaoExp')
                ->withErrors($validator)
                ->with('unidades');
        }
    }

    public function cadastroAvaliacaoExp()
    {
        $unidades  = Unidades::all();
        $avaliacao = AvaliacaoExperiencia::all();
        return view('avaliacao_experiencia/avaliacao_experiencia_cadastro', compact('unidades','avaliacao'));
    }

    public function pesquisarAvaliacaoExp(Request $request)
    {
        $input    = $request->all();
        $unidades = Unidades::all();
		if (empty($input['pesq'])) { $input['pesq'] = ""; }
		if (empty($input['pesq2'])) { $input['pesq2'] = ""; }
		$pesq  = $input['pesq'];
		$pesq2 = $input['pesq2'];
		if ($pesq2 == "1") {
			$avaliacao = AvaliacaoExperiencia::where('colaborador','like','%'.$pesq.'%')->get();
		} else if ($pesq2 == "2") {
			$avaliacao = AvaliacaoExperiencia::where('vaga','like','%'.$pesq.'%')->get();
		} else if ($pesq2 == "3") {
            $avaliacao = AvaliacaoExperiencia::where('gestor','like','%'.$pesq.'%')->get();
        } else {
            $avaliacao = AvaliacaoExperiencia::all();
        }
		return view('avaliacao_experiencia/avaliacao_experiencia_cadastro', compact('avaliacao','unidades','pesq','pesq2'));
    }

    public function excluirAvaliacaoExp($id)
    {
        $unidades  = Unidades::all();
        $avaliacao = AvaliacaoExperiencia::where('id',$id)->get();
        return view('avaliacao_experiencia/avaliacao_experiencia_excluir', compact('unidades','avaliacao'));
    }

    public function destroyAvaliacaoExp($id, Request $request)
    {
        $unidades  = Unidades::all();
        $input     = $request->all();
		$input['idTabela'] = $id;
		$loggers   = Logger::create($input);
        AvaliacaoExperiencia::find($id)->delete();
		$avaliacao = AvaliacaoExperiencia::paginate(20);
        $validator = 'Avaliação de Experiência excluído com sucesso!';
        $avaliacao = AvaliacaoExperiencia::all();
		return redirect()->route('cadastroAvaliacaoExp')
            ->withErrors($validator)
            ->with('unidades','avaliacao');
    }
}
