<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\consideracoesFinais;
use App\Models\SetoresForm;
use DB;
use Validator;

class ConsideracoesGraphicController extends Controller
{
    public function consideracoesFinaisGraphic()
    {
        $pergunta1a = consideracoesFinais::where('pergunta',1)->where('resposta','a')->get();
        $perg1a = sizeof($pergunta1a);
        $pergunta1b = consideracoesFinais::where('pergunta',1)->where('resposta','b')->get();
        $perg1b = sizeof($pergunta1b);
        $pergunta1c = consideracoesFinais::where('pergunta',1)->where('resposta','c')->get();
        $perg1c = sizeof($pergunta1c);
        $pergunta1d = consideracoesFinais::where('pergunta',1)->where('resposta','d')->get();
        $perg1d = sizeof($pergunta1d);
        $pergunta1e = consideracoesFinais::where('pergunta',1)->where('resposta','e')->get();
        $perg1e = sizeof($pergunta1e);
        $departamentos = SetoresForm::all();
        $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e; 
        return view('form/graphics/consideracoesFinaisGraphics', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e','departamentos', 'total'));
    }

    public function pesqConsideracoesFinais(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta1a = consideracoesFinais::where('pergunta',1)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg1a = sizeof($pergunta1a);
            $pergunta1b = consideracoesFinais::where('pergunta',1)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg1b = sizeof($pergunta1b);
            $pergunta1c = consideracoesFinais::where('pergunta',1)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg1c = sizeof($pergunta1c);
            $pergunta1d = consideracoesFinais::where('pergunta',1)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg1d = sizeof($pergunta1d);
            $pergunta1e = consideracoesFinais::where('pergunta',1)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg1e = sizeof($pergunta1e);
            $departamentos = SetoresForm::all();
            $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e; 
            return view('form/graphics/consideracoesFinaisGraphics', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e','departamentos','total'));
        } else {
            return redirect()->route('consideracoesFinaisGraphic');
        }
    }

    public function consideracoesFinaisGraphic2()
    {
        $respostas = consideracoesFinais::all();
        $qtd       = sizeof($respostas);
        $qtd1 = 0; $qtd2 = 0; $qtd3 = 0; $qtd4 = 0; $qtd5 = 0; 
        $qtd6 = 0; $qtd7 = 0; $qtd8 = 0; $qtd9 = 0; $qtd10 = 0;
        for ($i = 0; $i < $qtd; $i++) {
            if (str_contains($respostas[$i]->sair_hss, "1")) { $qtd1 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "2")) { $qtd2 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "3")) { $qtd3 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "4")) { $qtd4 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "5")) { $qtd5 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "6")) { $qtd6 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "7")) { $qtd7 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "8")) { $qtd8 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "9")) { $qtd9 += 1; }
            if (str_contains($respostas[$i]->sair_hss, "10")) { $qtd10 += 1; }
		}
        $departamentos = SetoresForm::all();
        return view('form/graphics/consideracoesFinaisGraphics2', 
            compact('qtd', 'qtd1', 'qtd2', 'qtd3', 'qtd4', 'qtd5', 'qtd6', 'qtd7', 'qtd8', 'qtd9', 'qtd10', 'departamentos'));
    }

    public function pesqConsideracoesFinais2(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $respostas = consideracoesFinais::where('departamento_id',$pesq)->get();
            $qtd       = sizeof($respostas);
            $qtd1 = 0; $qtd2 = 0; $qtd3 = 0; $qtd4 = 0; $qtd5 = 0; 
            $qtd6 = 0; $qtd7 = 0; $qtd8 = 0; $qtd9 = 0; $qtd10 = 0;
            for ($i = 0; $i < $qtd; $i++) {
                if (str_contains($respostas[$i]->sair_hss, "1")) { $qtd1 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "2")) { $qtd2 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "3")) { $qtd3 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "4")) { $qtd4 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "5")) { $qtd5 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "6")) { $qtd6 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "7")) { $qtd7 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "8")) { $qtd8 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "9")) { $qtd9 += 1; }
                if (str_contains($respostas[$i]->sair_hss, "10")) { $qtd10 += 1; }
    
            }
            $departamentos = SetoresForm::all();
            $total = $qtd1 + $qtd2 + $qtd3 + $qtd4 + $qtd5 + $qtd6 + $qtd7 + $qtd8 + $qtd9 + $qtd10; 
            return view('form/graphics/consideracoesFinaisGraphics2', 
                compact('qtd', 'qtd1', 'qtd2', 'qtd3', 'qtd4', 'qtd5', 'qtd6', 'qtd7', 'qtd8', 'qtd9', 'qtd10', 'departamentos', 'total'));
        } else {
            return redirect()->route('consideracoesFinaisGraphic2');
        }
    }

    public function consideracoesFinaisGraphic3()
    {
        $respostas = consideracoesFinais::all();
        $qtd       = sizeof($respostas);
        $qtdC1 = 0; $qtdC2 = 0; $qtdC3 = 0; $qtdC4 = 0; $qtdC5 = 0; 
        $qtdC6 = 0; $qtdC7 = 0; $qtdC8 = 0; $qtdC9 = 0; $qtdC10 = 0;
		for ($i = 0; $i < $qtd; $i++) {
            if (str_contains($respostas[$i]->continuar_hss, "1")) { $qtdC1 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "2")) { $qtdC2 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "3")) { $qtdC3 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "4")) { $qtdC4 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "5")) { $qtdC5 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "6")) { $qtdC6 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "7")) { $qtdC7 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "8")) { $qtdC8 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "9")) { $qtdC9 += 1; }
            if (str_contains($respostas[$i]->continuar_hss, "10")) { $qtdC10 += 1; }
		}
        $departamentos = SetoresForm::all();
        return view('form/graphics/consideracoesFinaisGraphics3', 
            compact('qtd', 'qtdC1', 'qtdC2', 'qtdC3', 'qtdC4', 'qtdC5', 'qtdC6', 'qtdC7', 'qtdC8', 'qtdC9', 'qtdC10', 'departamentos'));
    }

    public function pesqConsideracoesFinais3(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $respostas = consideracoesFinais::where('departamento_id',$pesq)->get();
            $qtd       = sizeof($respostas);
            $qtdC1 = 0; $qtdC2 = 0; $qtdC3 = 0; $qtdC4 = 0; $qtdC5 = 0; 
            $qtdC6 = 0; $qtdC7 = 0; $qtdC8 = 0; $qtdC9 = 0; $qtdC10 = 0;
            for ($i = 0; $i < $qtd; $i++) {
                if (str_contains($respostas[$i]->continuar_hss, "1")) { $qtdC1 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "2")) { $qtdC2 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "3")) { $qtdC3 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "4")) { $qtdC4 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "5")) { $qtdC5 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "6")) { $qtdC6 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "7")) { $qtdC7 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "8")) { $qtdC8 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "9")) { $qtdC9 += 1; }
                if (str_contains($respostas[$i]->continuar_hss, "10")) { $qtdC10 += 1; }
            }
            $departamentos = SetoresForm::all();
            return view('form/graphics/consideracoesFinaisGraphics3', 
                compact('qtd', 'qtdC1', 'qtdC2', 'qtdC3', 'qtdC4', 'qtdC5', 'qtdC6', 'qtdC7', 'qtdC8', 'qtdC9', 'qtdC10', 'departamentos'));
        } else {
            return redirect()->route('consideracoesFinaisGraphic3');
        }
    }
}
