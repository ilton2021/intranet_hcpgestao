<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use App\Models\Destaques;
use App\Models\Mural;
use App\Models\OuvidoriaUnidades;
use App\Models\DocumentosQualidade;
use App\Models\PoliticasNormas;
use App\Models\Indicadores;
use App\Models\Ramais;
use App\Models\Emails;
use App\Models\Setor;
use App\Models\ProtocolosInstitucionais;
use App\Models\UserPerfil;
use Mail;
use Auth;


class HomeController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $UserPerfil = UserPerfil::where('users_id', $id_user)->get();
        $perfil_user = array();
        for ($i = 0; $i < sizeof($UserPerfil); $i++) {
            $perfil_user[$i] = $UserPerfil[$i]->perfil_id;
        }
        return view('home', compact('perfil_user'));
    }

    public function oquee()
    {
        $unidades = Unidades::all();
        return view('oquee', compact('unidades'));
    }

    public function unidade($id)
    {
        $murais = Mural::all();
        $destaques = Destaques::all();
        $und_Princ = Unidades::where('id', $id)->get();
        $muraisDaUnd = array();
        for ($i = 0; $i < sizeof($murais); $i++) {
            $und_atuais = explode(",", $murais[$i]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais)) {
                array_push($muraisDaUnd, $murais[$i]->id);
            }
        }
        $destaDaUnd = array();
        for ($u = 0; $u < sizeof($destaques); $u++) {
            $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais2)) {
                array_push($destaDaUnd, $destaques[$u]->id);
            }
        }
        $destaques = Destaques::all();
        $murais = Mural::all();
        $unidades = Unidades::all();
        $unidade = Unidades::where('id', $id)->get();
        $und_Matriz = Unidades::where('id', 1)->get();
        return view('unidade', compact('unidade', 'unidades', 'murais', 'destaques', 'destaDaUnd', 'muraisDaUnd', 'und_Matriz'));
    }

    public function destaquesDetalhes($id, $id_d)
    {
        $unidades = Unidades::all();
        $und_atual = $id;
        if ($id == 1) {
            $destaSelect = Destaques::where('id', $id_d)->get();
            $destaques  = Destaques::all();
        } else {
            $destaques = Destaques::all();
            $destaSelect = Destaques::where('id', $id_d)->get();
            $destaDaUnd = array();
            for ($u = 0; $u < sizeof($destaques); $u++) {
                $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
                if (in_array($id, $und_atuais2)) {
                    array_push($destaDaUnd, $destaques[$u]);
                }
            }
            $destaques = $destaDaUnd;
        }
        return view('destaques_detalhes', compact('destaSelect', 'destaques', 'unidades', 'und_atual'));
    }

    public function muraisDetalhes($id)
    {
        $unidades = Unidades::all();
        if ($id == 0) {
            $murais = Mural::all();
        } else {
            $murais = Mural::where('id', $id)->get();
        }
        $murais2 = Mural::all();
        return view('murais_detalhes', compact('murais', 'murais2', 'unidades'));
    }

    public function acessoRapido($id)
    {
        $ouvidorias  = OuvidoriaUnidades::all();
        $documentos  = DocumentosQualidade::all();
        $politicas   = PoliticasNormas::all();
        $protocolos  = ProtocolosInstitucionais::all();
        $ramais      = Ramais::all();
        $emails      = Emails::all();
        $setores     = Setor::all();
        $indicadores = Indicadores::all();
        $unidades = Unidades::all();
        return view('acesso_rapido', compact('id', 'setores', 'ouvidorias', 'documentos', 'politicas', 'ramais', 'emails', 'protocolos', 'indicadores', 'unidades'));
    }

    public function enviarEmail($id, Request $request)
    {
        $input = $request->all();
        $unidade = Unidades::where('id', $id)->get();
        $emailUnd = $unidade[0]->ouvidoria;
        $undsigla = 'Ouvidoria ' . $unidade[0]->sigla;
        $nomeClt  = $input['name'];
        $emailClt = $input['email'];
        $assunto =  $input['subject'];
        $texto   =  $input['message'];
        Mail::send([], [], function ($m) use ($nomeClt, $emailClt, $emailUnd, $assunto, $texto, $undsigla) {
            $m->from($emailClt, $nomeClt);
            $m->subject($assunto);
            $m->setBody($texto);
            $m->to($emailUnd);
        });
        $destaques = Destaques::all();
        $unidades  = Unidades::all();
        $murais    = Mural::all();
        $und_Princ = Unidades::where('id', $id)->get();
        $muraisDaUnd = array();
        for ($i = 0; $i < sizeof($murais); $i++) {
            $und_atuais = explode(",", $murais[$i]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais)) {
                array_push($muraisDaUnd, $murais[$i]->id);
            }
        }
        $destaDaUnd = array();
        for ($u = 0; $u < sizeof($destaques); $u++) {
            $und_atuais2 = explode(",", $destaques[$u]->unidade_id);
            if (in_array($und_Princ[0]->id, $und_atuais2)) {
                array_push($destaDaUnd, $destaques[$u]->id);
            }
        }
        $validator = "Mensagem enviada com sucesso !!";
        return view('unidade', compact('destaques', 'destaDaUnd', 'unidade', 'unidades', 'murais', 'muraisDaUnd'));
    }
}
