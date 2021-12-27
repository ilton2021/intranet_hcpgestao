<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emails;
use App\Models\Unidades;
use Storage;
use DB;
use Validator;

class EmailsController extends Controller
{
    public function cadastroEmails()
    {
        $emails = Emails::all();
        return view('emails/emails_cadastro', compact('emails'));
    }

    public function pesquisarEmails(Request $request)
    {
        $input  = $request->all();  
        if(empty($input['pesq'])) { $input['pesq'] = ""; }
		if(empty($input['pesq2'])) { $input['pesq2'] = ""; }
        $pesq  = $input['pesq'];
		$pesq2 = $input['pesq2']; 
        if($pesq2 == "1") {
            $emails = Emails::where('nome','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "2") {
            $emails = Emails::where('email','like','%'.$pesq.'%')->get();
        } else if($pesq2 == "3") {
            $emails = Emails::where('unidade','like','%'.$pesq.'%')->get();
        }
        return view('emails/emails_cadastro', compact('emails','pesq','pesq2'));
    }

    public function emailsNovo()
    {
        $unidades = Unidades::all();
        return view('emails/emails_novo', compact('unidades'));
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
		}else {
			$emails = Emails::create($input);
			$emails = Emails::all();
			$validator = 'E-mail Cadastrado com Sucesso!';
			return view('emails/emails_cadastro', compact('emails'))
		    		->withErrors($validator)
					->withInput(session()->flashInput($request->input()));
		}
	}

    public function emailsAlterar($id)
    {
        $emails = Emails::where('id',$id)->get();
        $unidades = Unidades::all();
        return view('emails/emails_alterar', compact('emails','unidades'));
    }

    public function updateEmails($id, Request $request)
    {
        $input    = $request->all();
	    $emails   = Emails::where('id',$id)->get();
        $unidades = Unidades::all();
		$validator = Validator::make($request->all(), [
			'nome'  => 'required|max:255',
            'email' => 'required|max:255|email'
        ]);
		if ($validator->fails()) {
			return view('emails/emails_alterar', compact('emails','unidades'))
				->withErrors($validator)
	    		->withInput(session()->flashInput($request->input()));
		}else {
			$emails = Emails::find($id); 
			$emails->update($input);
	    	$emails = Emails::all();
			$validator ='E-mail Alterado com Sucesso!';
			return view('emails/emails_cadastro', compact('emails'))
			    	->withErrors($validator)
		    		->withInput(session()->flashInput($request->input()));
		}
    }

    public function emailsExcluir($id)
    {
        $emails = Emails::where('id',$id)->get();
        return view('emails/emails_excluir', compact('emails'));
    }

    public function destroyEmails($id, Request $request)
    {
        Emails::find($id)->delete();
		$emails = Emails::all();
        $validator = 'E-mail excluído com sucesso!';
		return view('emails/emails_cadastro', compact('emails'))
						->withErrors($validator)
						->withInput(session()->flashInput($request->input()));
    }
}
