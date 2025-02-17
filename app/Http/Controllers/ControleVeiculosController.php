<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destaques;
use App\Models\Mural;
use App\Models\Unidades;
use App\Models\ControleVeiculos;
use App\Models\Logger;
use App\Models\UserPerfil;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissaoController;
use Illuminate\Support\Facades\Validator;

class ControleVeiculosController extends Controller
{

    public function showVeiculos()
    {
        $veiculos = ControleVeiculos::paginate(10);

        return view('veiculos.showVeiculos', compact('veiculos'));
    }

    public function pesquisaVeiculos(Request $request)
    {
        $input = $request->all();
        if (isset($input['pesq'])) {
            $veiculos = ControleVeiculos::where($input['pesq2'], 'like', '%' . $input['pesq'] . '%')->paginate(10);
            return view('veiculos.showVeiculos', compact('veiculos'));
        } else {
            $veiculos = ControleVeiculos::paginate(10);
            return redirect()->route('showVeiculos');
        }
    }

    public function storeVeiculo($id, Request $request)
    {
        $input = $request->all();
        $murais = Mural::where('status', 1)->get();
        $destaques = Destaques::where('status', 1)->get();
        $und_Princ = Unidades::where('id', $id)->get();
        $muraisDaUnd = array();
        for ($i = 0; $i < sizeof($murais); $i++) {
            $und_atuais = explode(",", $murais[$i]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais) || in_array(1, $und_atuais)) {
                array_push($muraisDaUnd, $murais[$i]->id);
            }
        }
        $destaDaUnd = array();
        for ($u = 0; $u < sizeof($destaques); $u++) {
            $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais2) || in_array(1, $und_atuais2)) {
                array_push($destaDaUnd, $destaques[$u]->id);
            }
        }
        $destaques = Destaques::where('status', 1)->get();
        $murais = Mural::where('status', 1)->get();
        $unidades = Unidades::all();
        $unidade = Unidades::where('id', $id)->get();
        $und_Matriz = Unidades::where('id', 1)->get();
        $id_und =  $unidade[0]->id;
        $validator = Validator::make($request->all(), [
            'setor'       => 'required|max:255',
            'funcao'      => 'required|max:255',
            'nome'        => 'required|max:255',
            'telefone'    => 'required|max:255',
            'placa'       => 'required|max:255',
            'cor'         => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return view('unidade', compact('unidade', 'unidades', 'murais', 'destaques', 'destaDaUnd', 'muraisDaUnd', 'und_Matriz', 'id_und'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {

            $input['placa'] = strtoupper($input['placa']);
            $Veiculo = ControleVeiculos::where('placa', $input['placa'])->get();
            if (sizeof($Veiculo) == 0) {
                if ($input['tipo'] == "carro") {
                    $input['marcamodelo'] = $input['marca'];
                } else {
                    $input['marcamodelo'] = $input['marcaMoto'];
                }
                $input['unidade_id'] = $id;
                $veiculo = ControleVeiculos::create($input);
                $validator = 'Veiculo Cadastrado com Sucesso!';
                return redirect()->route('unidade', $id)
                    ->withErrors($validator)
                    ->with('validator');
            } else {
                $validator = "Já existe um veiculo com essa placa cadastrado !";
                return view('unidade', compact('unidade', 'unidades', 'murais', 'destaques', 'destaDaUnd', 'muraisDaUnd', 'und_Matriz', 'id_und'))
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            }
        }
    }
}
