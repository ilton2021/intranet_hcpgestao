<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emails;
use App\Models\Unidades;
use App\Models\Setor;
use Storage;
use DB;
use Validator;

class EmailsController extends Controller
{
    public function cadastroEmails()
    {
        $emails = Emails::all();
        $unidades = Unidades::all();
        $setores = Setor::all();
        return view('emails/emails_cadastro', compact('emails', 'unidades', 'setores'));
    }

    public function pesquisarEmails(Request $request)
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
            $emails = Emails::where('nome', 'like', '%' . $pesq . '%')->get();
        } else if ($pesq2 == "2") {
            $emails = Emails::where('email', 'like', '%' . $pesq . '%')->get();
        } else if ($pesq2 == "3") {
            $emails = Emails::where('unidade_id', $input['unidade'])->get();
        }
        $unidades = Unidades::all();
        return view('emails/emails_cadastro', compact('emails', 'pesq', 'pesq2', 'unidades'));
    }

    public function emailsNovo()
    {
        $unidades = Unidades::all();
        $setores = setor::all();
        return view('emails/emails_novo', compact('unidades', 'setores'));
    }

    public function storeEmails(Request $request)
    {
        $input = $request->all();
        $unidades = Unidades::all();
        $validator = Validator::make($request->all(), [
            'nome'  => 'required|max:255',
            'email' => 'required|max:255|email'
        ]);
        if ($validator->fails()) {
            return view('emails/emails_novo', compact('unidades'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $emails = Emails::create($input);
            $emails = Emails::all();
            $validator = 'E-mail Cadastrado com Sucesso!';
            return redirect()->route('cadastroEmails')
                ->withErrors($validator)
                ->with('emails', 'unidades');
        }
    }

    public function emailsAlterar($id)
    {
        $emails = Emails::where('id', $id)->get();
        $unidades = Unidades::all();
        $setores = Setor::all();
        return view('emails/emails_alterar', compact('emails', 'unidades', 'setores'));
    }

    public function updateEmails($id, Request $request)
    {
        $input    = $request->all();
        $emails   = Emails::where('id', $id)->get();
        $unidades = Unidades::all();
        $validator = Validator::make($request->all(), [
            'nome'  => 'required|max:255',
            'email' => 'required|max:255|email'
        ]);
        if ($validator->fails()) {
            return view('emails/emails_alterar', compact('emails', 'unidades'))
                ->withErrors($validator)
                ->withInput(session()->flashInput($request->input()));
        } else {
            $emails = Emails::find($id);
            $emails->update($input);
            $emails = Emails::all();
            $validator = 'E-mail Alterado com Sucesso!';
            return redirect()->route('cadastroEmails')
                ->withErrors($validator)
                ->with('emails', 'unidades');
        }
    }

    public function emailsExcluir($id)
    {
        $emails = Emails::where('id', $id)->get();
        return view('emails/emails_excluir', compact('emails'));
    }

    public function destroyEmails($id, Request $request)
    {
        Emails::find($id)->delete();
        $emails = Emails::all();
        $unidades = Unidades::all();
        $validator = 'E-mail excluído com sucesso!';
        return redirect()->route('cadastroEmails')
            ->withErrors($validator)
            ->with('emails', 'unidades');
    }

    public function emailsUnidade($id)
    {
        $unidades = Unidades::all();
        $emails = Emails::where('unidade_id', $id)->orderby('nome', 'ASC')->get();
        $unidade = Unidades::where('id', $id)->get();
        return view('emails/emails_unidade', compact('emails', 'unidade', 'unidades'));
    }
}
