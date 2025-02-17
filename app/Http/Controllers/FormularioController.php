<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use App\Models\SetoresForm;
use App\Models\InicioForm;
use App\Models\SobreVoce;
use App\Models\ondeTrabalha;
use App\Models\SeuGestor;
use App\Models\consideracoesFinais;
use DB;
use Validator;

class FormularioController extends Controller
{
    // Função para Retornar Tela para Iniciar Formulário
    public function iniciarForm()
    {
        $unidades = Unidades::where('id', 7)->get();
        $setores  = SetoresForm::all();
        return view('form/inicio', compact('unidades', 'setores'));
    }

    // Função para Enviar dados da unidade pela qual o colaborador faz parte
    public function storeIniciarForm(Request $request)
    {
        $input        = $request->all(); 
        $departamento = $input['departamento'];
        $iniForm  = InicioForm::where('departamento', $departamento)->get();
        $qtd      = sizeof($iniForm);
        $setores  = SetoresForm::where('departamento', $departamento)->get();
        $qtdSetor = $setores[0]->quantidade;

        if ($qtd > $qtdSetor) 
        {
            $validator = 'Quantidade de Questionário respondidos ultrapassou a Quantidade de Funcionários no Setor!';
            $unidades = Unidades::where('id', 7)->get();
            $setores  = SetoresForm::all();
            return view('form/inicio', compact('unidades','setores'))
            ->withErrors($validator)
            ->withInput(session()->flashInput($request->input()));
        } else {
            $inicioForm   = InicioForm::create($input);
            $validator    = 'Pesquisa Iniciada. Responda as Perguntas a seguir.';
            $dpto         = $input['departamento'];
            $departamento = SetoresForm::where('departamento', $dpto)->get();
            return redirect()->route('sobreVoce', [$departamento[0]->id]);
        }
    }

    // Função para Retornar Tela de Perguntas Sobre Você
    public function sobreVoce($id)
    {
        $departamento = SetoresForm::where('id', $id)->get();
        return view('form/pergunta/sobreVoce', compact('departamento'));
    }

    // Função para Salvar Respostas das Perguntas Sobre Você
    public function storeSobreVoce($id, Request $request)
    {
        $input = $request->all();
        $input['departamento_id'] = $id;
        $departamento = SetoresForm::where('id', $id)->get();
        for($a=1; $a<=13; $a++) {
            if (array_key_exists('resposta'.$a, $input) != True){
                $validator = 'Por favor, responda todas as perguntas!';
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            }
        }
        for($b = 1; $b <= 13; $b++) {
            $input['pergunta'] = $input['pergunta'.$b];
            $input['resposta'] = $input['resposta'.$b];
            $sobreVoce = SobreVoce::create($input);
        }
        $validator2   = 'Respostas "Sobre Você" Enviadas!';
        $departamento = SetoresForm::where('id', $id)->get();
        return redirect()->route('ondeTrabalha', [$id])->withErrors($validator2);
    }

    // Função para Retornar Tela para Perguntas Onde Trabalha
    public function ondeTrabalha($id)
    {
        $departamento = SetoresForm::where('id', $id)->get();
        return view('form/pergunta/ondeTrabalha', compact('departamento'));
    }

    // Função para Enviar Respostas Onde Trabalha
    public function storeOndeTrabalha($id, Request $request)
    {
        $input = $request->all();
        $input['departamento_id'] = $id;
        $departamento = SetoresForm::where('id', $id)->get();
        for($a = 1; $a <= 12; $a++){
            if (array_key_exists('resposta'.$a, $input) != True){
                $validator = 'Por favor, responda todas as perguntas!';
                return view('form/pergunta/ondeTrabalha', compact('departamento'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
            }
        }
        for($b=1; $b<=12; $b++){
            $input['pergunta'] = $input['pergunta'.$b];
            $input['resposta'] = $input['resposta'.$b];
            $ondeTrabalha = ondeTrabalha::create($input);
        }
        
        $validator2 = 'Respostas "Onde Trabalha" Enviadas!';
        return redirect()->route('seuGestor', [$id])->withErrors($validator2);
    }

    // Função para Retornar Tela de Perguntas Seu Gestor
    public function seuGestor($id)
    {
        $departamento = SetoresForm::where('id', $id)->get();
        return view('form/pergunta/seuGestor', compact('departamento'));
    }

    // Função para Enviar Respostas Seu Gestor
    public function storeSeuGestor($id, Request $request)
    {
        $input = $request->all();
        $input['departamento_id'] = $id;
        $departamento = SetoresForm::where('id', $id)->get();
        for ($a = 1; $a <= 5; $a++) {
            if (array_key_exists('resposta'.$a, $input) != True) {
                $validator = 'Por favor, responda todas as perguntas!';
                return view('form/pergunta/seuGestor', compact('departamento'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
            }
        }
        for ($b = 1; $b <= 5; $b++) {
            $input['pergunta'] = $input['pergunta'.$b];
            $input['resposta'] = $input['resposta'.$b];
            $ondeTrabalha = seuGestor::create($input);
        }
        $validator2 = 'Respostas "Seu Gestor" Enviadas!';
        return redirect()->route('consideracoesFinais', [$id])->withErrors($validator2);
    }

    // Função para Retornar Tela de Perguntas Considerações Finais
    public function consideracoesFinais($id)
    {
        $departamento = SetoresForm::where('id', $id)->get();
        return view('form/pergunta/consideracoesFinais', compact('departamento'));
    }

    // Função para Enviar Respotas Considerações Finais
    public function storeConsideracoesFinais($id, Request $request)
    {
        $input = $request->all();
        $input['departamento_id'] = $id;
        $departamento = SetoresForm::where('id', $id)->get();
        $validator = Validator::make($request->all(), [
            'pergunta' => 'required',
            'resposta' => 'required',
            'sair_hss' => 'required|max:255',
            'continuar_hss' => 'required|max:255'
        ]);
        if ($validator->fails()){
            $validator2 = 'Selecione uma das opções';
            return view('form/pergunta/consideracoesFinais', compact('departamento'))
                ->withErrors($validator2)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $sair_hss      = implode('; ', $input['sair_hss']);
            $continuar_hss = implode('; ', $input['continuar_hss']);
            $input['sair_hss']      = $sair_hss;
            $input['continuar_hss'] = $continuar_hss;
            $consideracoesFinais = ConsideracoesFinais::create($input);
            $validator3 = 'Respostas "Considerações Finais" Enviadas!';
            return redirect()->route('finalForm', [$id])->withErrors($validator3);
        }
    }

    // Função para Retornar Tela de Final de Formulário
    public function finalForm()
    {
        return view('form/finalForm');
    }
}