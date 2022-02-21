<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OuvidoriaUnidades;
use Validator;
use DB;
use Storage;

class OuvidoriaUnidadesController extends Controller
{
    public function cadastroOuvidorias()
    {
        $ouvidorias = OuvidoriaUnidades::all();
        return view('ouvidoria_unidades/ouvidoria_unidades_cadastro', compact('ouvidorias'));
    }

    public function pesquisarOuvidorias(Request $request)
    {
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
            $ouvidorias = OuvidoriaUnidades::where('nome', 'like', '%' . $pesq . '%')->get();
        }
        return view('ouvidoria_unidades/ouvidoria_unidades_cadastro', compact('ouvidorias', 'pesq', 'pesq2'));
    }

    public function ouvidoriasNovo()
    {
        return view('ouvidoria_unidades/ouvidoria_unidades_novo');
    }

    public function storeOuvidorias(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return view('ouvidoria_unidades/ouvidoria_unidades_novo')
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $ouvidorias = OuvidoriaUnidades::create($input);
            $ouvidorias = OuvidoriaUnidades::all();
            $validator = 'Ouvidoria da Unidade Cadastrado com Sucesso!';
            return redirect()->route('cadastroOuvidorias')
                ->withErrors($validator)
                ->with('ouvidorias');
        }
    }

    public function ouvidoriasAlterar($id)
    {
        $ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
        return view('ouvidoria_unidades/ouvidoria_unidades_alterar', compact('ouvidorias'));
    }

    public function updateOuvidorias($id, Request $request)
    {
        $input   = $request->all();
        $ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return view('ouvidoria_unidades/ouvidoria_unidades_alterar', compact('ouvidorias'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $ouvidorias = OuvidoriaUnidades::find($id);
            $ouvidorias->update($input);
            $ouvidorias = OuvidoriaUnidades::all();
            $validator = 'Ouvidoria da Unidade Alterado com Sucesso!';
            return redirect()->route('cadastroOuvidorias')
                ->withErrors($validator)
                ->with('ouvidorias');
        }
    }

    public function ouvidoriasExcluir($id)
    {
        $ouvidorias = OuvidoriaUnidades::where('id', $id)->get();
        return view('ouvidoria_unidades/ouvidoria_unidades_excluir', compact('ouvidorias'));
    }

    public function destroyOuvidorias($id, Request $request)
    {
        OuvidoriaUnidades::find($id)->delete();
        $input = $request->all();
        $ouvidorias = OuvidoriaUnidades::all();
        $validator = 'Ouvidoria da Unidade excluído com sucesso!';
        return redirect()->route('cadastroOuvidorias')
            ->withErrors($validator)
            ->with('ouvidorias');
    }
}
