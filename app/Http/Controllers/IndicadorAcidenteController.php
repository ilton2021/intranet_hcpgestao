<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndicadorAcidente;
use App\Models\PartesCorpo;
use App\Models\Setor;
use App\Models\Cargos;
use App\Models\AgenteCausador;
use App\Models\Unidades;
use App\Models\Logger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class IndicadorAcidenteController extends Controller
{
    public function indicadorAcidenteInfo()
    {
        $unidades   = Unidades::all();
        return view('indicador_acidente_info', compact('unidades'));
    }

    public function indicadorAcidente()
    {
        $unidades   = Unidades::all();
        $partes_corpo = PartesCorpo::all();
        $setores    = Setor::orderby('nome')->get();
        $cargos     = Cargos::orderby('nome')->get();
        $agente_c   = AgenteCausador::orderby('descricao')->get();
        return view('indicador_acidente', compact('unidades', 'partes_corpo', 'setores', 'cargos', 'agente_c'));
    }

    public function indicadorAcidenteStore(Request $request)
    {
        $input    = $request->all(); 
        $unidades = Unidades::all();
        $partes_corpo = PartesCorpo::all();
        $setores    = Setor::orderby('nome')->get();
        $cargos     = Cargos::orderby('nome')->get();
        $agente_c   = AgenteCausador::orderby('descricao')->get();
        $validator = Validator::make($request->all(), [
			'nome'                 => 'required|max:255',
            'genero'               => 'required|max:255',
            'setor'                => 'required|max:255',
            'tempo_funcao'         => 'required|max:255',
            'funcao'               => 'required|max:255',
            'idade'                => 'required|max:10',
            'funcao'               => 'required|max:255',
            'data_evento'          => 'required|date',
            'dia_semana'           => 'required|max:255',
            'tipo'                 => 'required|max:255',
            'situacao'             => 'required|max:255',
            'agente_causador'      => 'required|max:255',
            'local_incidente'      => 'required|max:255',
            'horario_acidente'     => 'required|max:255',
            'parte_corpo_atingida' => 'required|max:255',
            'status'               => 'required|max:255',
            'dias_afastamento'     => 'required|max:255',
            'descricao_acidente'   => 'required|max:800'
    	]);
		if ($validator->fails()) {
			return redirect()->route('indicadorAcidente')
                ->withErrors($validator)
                ->with('unidades', 'partes_corpo', 'setores', 'cargos', 'agente_c')
                ->withInput(session()->flashInput($request->input()));
		} else {
            indicadorAcidente::create($input);
            $validator = 'Indicador de Acidente Cadastrado com Sucesso!';
			return redirect()->route('indicadorAcidenteInfo')
                ->withErrors($validator)
                ->with('unidades');
        }
    }
}
