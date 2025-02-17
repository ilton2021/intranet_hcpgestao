<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeuGestor;
use App\Models\SetoresForm;
use DB;
use Validator;

class SeuGestorGraphicController extends Controller
{
    public function seuGestorGraphic() 
    {
        $pergunta1a = SeuGestor::where('pergunta',1)->where('resposta','a')->get();
        $perg1a = sizeof($pergunta1a);
        $pergunta1b = SeuGestor::where('pergunta',1)->where('resposta','b')->get();
        $perg1b = sizeof($pergunta1b);
        $pergunta1c = SeuGestor::where('pergunta',1)->where('resposta','c')->get();
        $perg1c = sizeof($pergunta1c);
        $pergunta1d = SeuGestor::where('pergunta',1)->where('resposta','d')->get();
        $perg1d = sizeof($pergunta1d);
        $pergunta1e = SeuGestor::where('pergunta',1)->where('resposta','e')->get();
        $perg1e = sizeof($pergunta1e);
        $pergunta2a = SeuGestor::where('pergunta',2)->where('resposta','a')->get();
        $perg2a = sizeof($pergunta2a);
        $pergunta2b = SeuGestor::where('pergunta',2)->where('resposta','b')->get();
        $perg2b = sizeof($pergunta2b);
        $pergunta2c = SeuGestor::where('pergunta',2)->where('resposta','c')->get();
        $perg2c = sizeof($pergunta2c);
        $pergunta2d = SeuGestor::where('pergunta',2)->where('resposta','d')->get();
        $perg2d = sizeof($pergunta2d);
        $pergunta2e = SeuGestor::where('pergunta',2)->where('resposta','e')->get();
        $perg2e = sizeof($pergunta2e);
        $pergunta3a = SeuGestor::where('pergunta',3)->where('resposta','a')->get();
        $perg3a = sizeof($pergunta3a);
        $pergunta3b = SeuGestor::where('pergunta',3)->where('resposta','b')->get();
        $perg3b = sizeof($pergunta3b);
        $pergunta3c = SeuGestor::where('pergunta',3)->where('resposta','c')->get();
        $perg3c = sizeof($pergunta3c);
        $pergunta3d = SeuGestor::where('pergunta',3)->where('resposta','d')->get();
        $perg3d = sizeof($pergunta3d);
        $pergunta3e = SeuGestor::where('pergunta',3)->where('resposta','e')->get();
        $perg3e = sizeof($pergunta3e);
        $pergunta4a = SeuGestor::where('pergunta',4)->where('resposta','a')->get();
        $perg4a = sizeof($pergunta4a);
        $pergunta4b = SeuGestor::where('pergunta',4)->where('resposta','b')->get();
        $perg4b = sizeof($pergunta4b);
        $pergunta4c = SeuGestor::where('pergunta',4)->where('resposta','c')->get();
        $perg4c = sizeof($pergunta4c);
        $pergunta4d = SeuGestor::where('pergunta',4)->where('resposta','d')->get();
        $perg4d = sizeof($pergunta4d);
        $pergunta4e = SeuGestor::where('pergunta',4)->where('resposta','e')->get();
        $perg4e = sizeof($pergunta4e);
        $pergunta5a = SeuGestor::where('pergunta',5)->where('resposta','a')->get();
        $perg5a = sizeof($pergunta5a);
        $pergunta5b = SeuGestor::where('pergunta',5)->where('resposta','b')->get();
        $perg5b = sizeof($pergunta5b);
        $pergunta5c = SeuGestor::where('pergunta',5)->where('resposta','c')->get();
        $perg5c = sizeof($pergunta5c);
        $pergunta5d = SeuGestor::where('pergunta',5)->where('resposta','d')->get();
        $perg5d = sizeof($pergunta5d);
        $pergunta5e = SeuGestor::where('pergunta',5)->where('resposta','e')->get();
        $perg5e = sizeof($pergunta5e);
        $departamentos = SetoresForm::all();
        $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e;
        return view('form/graphics/seuGestorGraphic', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e', 'perg2a', 'perg2b', 'perg2c', 'perg2d', 'perg2e', 'perg3a', 'perg3b', 'perg3c', 'perg3d', 'perg3e', 'perg4a', 'perg4b', 'perg4c', 'perg4d', 'perg4e', 'perg5a', 'perg5b', 'perg5c', 'perg5d', 'perg5e','departamentos','total'));
    }

    public function pesqSeuGestor(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta1a = SeuGestor::where('pergunta',1)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg1a = sizeof($pergunta1a);
            $pergunta1b = SeuGestor::where('pergunta',1)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg1b = sizeof($pergunta1b);
            $pergunta1c = SeuGestor::where('pergunta',1)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg1c = sizeof($pergunta1c);
            $pergunta1d = SeuGestor::where('pergunta',1)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg1d = sizeof($pergunta1d);
            $pergunta1e = SeuGestor::where('pergunta',1)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg1e = sizeof($pergunta1e);
            $pergunta2a = SeuGestor::where('pergunta',2)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg2a = sizeof($pergunta2a);
            $pergunta2b = SeuGestor::where('pergunta',2)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg2b = sizeof($pergunta2b);
            $pergunta2c = SeuGestor::where('pergunta',2)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg2c = sizeof($pergunta2c);
            $pergunta2d = SeuGestor::where('pergunta',2)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg2d = sizeof($pergunta2d);
            $pergunta2e = SeuGestor::where('pergunta',2)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg2e = sizeof($pergunta2e);
            $pergunta3a = SeuGestor::where('pergunta',3)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg3a = sizeof($pergunta3a);
            $pergunta3b = SeuGestor::where('pergunta',3)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg3b = sizeof($pergunta3b);
            $pergunta3c = SeuGestor::where('pergunta',3)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg3c = sizeof($pergunta3c);
            $pergunta3d = SeuGestor::where('pergunta',3)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg3d = sizeof($pergunta3d);
            $pergunta3e = SeuGestor::where('pergunta',3)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg3e = sizeof($pergunta3e);
            $pergunta4a = SeuGestor::where('pergunta',4)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg4a = sizeof($pergunta4a);
            $pergunta4b = SeuGestor::where('pergunta',4)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg4b = sizeof($pergunta4b);
            $pergunta4c = SeuGestor::where('pergunta',4)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg4c = sizeof($pergunta4c);
            $pergunta4d = SeuGestor::where('pergunta',4)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg4d = sizeof($pergunta4d);
            $pergunta4e = SeuGestor::where('pergunta',4)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg4e = sizeof($pergunta4e);
            $pergunta5a = SeuGestor::where('pergunta',5)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg5a = sizeof($pergunta5a);
            $pergunta5b = SeuGestor::where('pergunta',5)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg5b = sizeof($pergunta5b);
            $pergunta5c = SeuGestor::where('pergunta',5)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg5c = sizeof($pergunta5c);
            $pergunta5d = SeuGestor::where('pergunta',5)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg5d = sizeof($pergunta5d);
            $pergunta5e = SeuGestor::where('pergunta',5)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg5e = sizeof($pergunta5e);
            $departamentos = SetoresForm::all();
            $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e;
            return view('form/graphics/seuGestorGraphic', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e', 'perg2a', 'perg2b', 'perg2c', 'perg2d', 'perg2e', 'perg3a', 'perg3b', 'perg3c', 'perg3d', 'perg3e', 'perg4a', 'perg4b', 'perg4c', 'perg4d', 'perg4e', 'perg5a', 'perg5b', 'perg5c', 'perg5d', 'perg5e','departamentos','total'));
        } else {
            return redirect()->route('seuGestorGraphic');
        }
    }
}
