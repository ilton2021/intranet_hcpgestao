<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidades;
use App\Models\Destaques;
use App\Models\Mural;
use App\Models\OuvidoriaUnidades;
use App\Models\DocumentosQualidade;
use App\Models\PoliticasNormas;
use App\Models\Ramais;
use App\Models\Emails;
use App\Models\Setor;
use App\Models\ProtocolosInstitucionais;
use Mail;

class HomeController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        return view('home');
    }

    public function oquee()
    {
        return view('oquee');
    }

    public function unidade($id){
        $unidade = Unidades::where('id',$id)->get();
        return view('unidade', compact('unidade'));
    }

    public function destaquesDetalhes($id) {
        $destaques = Destaques::where('id',$id)->get();
        return view('destaques_detalhes', compact('destaques'));
    }

    public function muraisDetalhes(){
        $murais = Mural::all();
        return view('murais_detalhes', compact('murais'));
    }

    public function acessoRapido($id) {
        $ouvidorias = OuvidoriaUnidades::all();
        $documentos = DocumentosQualidade::all();
        $politicas  = PoliticasNormas::all();
        $protocolos = ProtocolosInstitucionais::all();
        $ramais     = Ramais::all();
        $emails     = Emails::all();
        $setores    = Setor::all();
        return view('acesso_rapido', compact('id','setores','ouvidorias','documentos','politicas','ramais','emails','protocolos'));
    }

    public function enviarEmail(Request $request){ 
        $input = $request->all();
        $email = 'ilton.albuquerque@hcpgestao.org.br';
        $assunto = $input['subject'];
        $texto   = $input['message'];
        Mail::send([], [], function($m) use ($email,$assunto,$texto) {
            $m->from('ilton.albuquerque@hcpgestao.org.br', 'Ouvidoria HCPGESTÃO');
            $m->subject($assunto);
            $m->setBody($texto);
            $m->to($email);
        });
        $destaques = Destaques::all();
        $unidades  = Unidades::all();
        $murais    = Mural::all();

        return view('welcome', compact('destaques','unidades','murais'));
    }
}
