<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use DB;
use Validator;

class SetoresController extends Controller
{
    public function cadastroSetores()
    {
        $setores = Setor::all();
        return view('setores/setores_cadastro', compact('setores'));
    }

    public function pesquisarSetores(Request $request)
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
            $setores = Setor::where('nome', 'like', '%' . $pesq . '%')->get();
        }
        return view('setores/setores_cadastro', compact('setores', 'pesq', 'pesq2'));
    }

    public function setoresNovo()
    {
        return view('setores/setores_novo');
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
        } else {
            $setores = Setor::create($input);
            $setores = Setor::all();
            $validator = 'Setor Cadastrado com Sucesso!';
            return redirect()->route('cadastroSetores')
                ->withErrors($validator)
                ->with('setores');
        }
    }

    public function setoresAlterar($id)
    {
        $setores = Setor::where('id', $id)->get();
        return view('setores/setores_alterar', compact('setores'));
    }

    public function updateSetores($id, Request $request)
    {
        $input   = $request->all();
        $setores = Setor::where('id', $id)->get();
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return view('setores/setores_alterar', compact('setores'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $setores = Setor::find($id);
            $setores->update($input);
            $setores = Setor::all();
            $validator = 'Setor Alterado com Sucesso!';
            return redirect()->route('cadastroSetores')
                ->withErrors($validator)
                ->with('setores');
        }
    }

    public function setoresExcluir($id)
    {
        $setores = Setor::where('id', $id)->get();
        return view('setores/setores_excluir', compact('setores'));
    }

    public function destroySetores($id, Request $request)
    {
        Setor::find($id)->delete();
        $setores = Setor::all();
        $validator = 'Setor excluído com sucesso!';
        return redirect()->route('cadastroSetores')
            ->withErrors($validator)
            ->with('setores');
    }
}
