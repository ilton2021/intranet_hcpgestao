<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ondeTrabalha;
use App\Models\SetoresForm;
use DB;
use Validator;

class OndeTrabalhaGraphicController extends Controller
{
    public function OndeTrabalhaGraphic()
    {
        $pergunta1a = ondeTrabalha::where('pergunta',1)->where('resposta','a')->get();
        $perg1a = sizeof($pergunta1a);
        $pergunta1b = ondeTrabalha::where('pergunta',1)->where('resposta','b')->get();
        $perg1b = sizeof($pergunta1b);
        $pergunta1c = ondeTrabalha::where('pergunta',1)->where('resposta','c')->get();
        $perg1c = sizeof($pergunta1c);
        $pergunta1d = ondeTrabalha::where('pergunta',1)->where('resposta','d')->get();
        $perg1d = sizeof($pergunta1d);
        $pergunta1e = ondeTrabalha::where('pergunta',1)->where('resposta','e')->get();
        $perg1e = sizeof($pergunta1e);
        $departamentos = SetoresForm::all();
        $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e;
        return view('form/graphics/ondeTrabalhaGraphic', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e','departamentos','total'));
    }

    public function pesqOndeTrabalha(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta1a = ondeTrabalha::where('pergunta',1)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg1a = sizeof($pergunta1a);
            $pergunta1b = ondeTrabalha::where('pergunta',1)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg1b = sizeof($pergunta1b);
            $pergunta1c = ondeTrabalha::where('pergunta',1)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg1c = sizeof($pergunta1c);
            $pergunta1d = ondeTrabalha::where('pergunta',1)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg1d = sizeof($pergunta1d);
            $pergunta1e = ondeTrabalha::where('pergunta',1)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg1e = sizeof($pergunta1e);
            $departamentos = SetoresForm::all();
            $total = $perg1a + $perg1b + $perg1c + $perg1d + $perg1e;
            return view('form/graphics/ondeTrabalhaGraphic', compact('perg1a', 'perg1b', 'perg1c', 'perg1d', 'perg1e','departamentos','total'));    
        } else {
            return redirect()->route('ondeTrabalhaGraphic');
        }
    }

    public function ondeTrabalhaGraphic2()
    {
        $pergunta2a = ondeTrabalha::where('pergunta',2)->where('resposta','a')->get();
        $perg2a = sizeof($pergunta2a);
        $pergunta2b = ondeTrabalha::where('pergunta',2)->where('resposta','b')->get();
        $perg2b = sizeof($pergunta2b);
        $pergunta2c = ondeTrabalha::where('pergunta',2)->where('resposta','c')->get();
        $perg2c = sizeof($pergunta2c);
        $pergunta2d = ondeTrabalha::where('pergunta',2)->where('resposta','d')->get();
        $perg2d = sizeof($pergunta2d);
        $pergunta2e = ondeTrabalha::where('pergunta',2)->where('resposta','e')->get();
        $perg2e = sizeof($pergunta2e);
        $pergunta3a = ondeTrabalha::where('pergunta',3)->where('resposta','a')->get();
        $perg3a = sizeof($pergunta3a);
        $pergunta3b = ondeTrabalha::where('pergunta',3)->where('resposta','b')->get();
        $perg3b = sizeof($pergunta3b);
        $pergunta3c = ondeTrabalha::where('pergunta',3)->where('resposta','c')->get();
        $perg3c = sizeof($pergunta3c);
        $pergunta3d = ondeTrabalha::where('pergunta',3)->where('resposta','d')->get();
        $perg3d = sizeof($pergunta3d);
        $pergunta3e = ondeTrabalha::where('pergunta',3)->where('resposta','e')->get();
        $perg3e = sizeof($pergunta3e);
        $pergunta4a = ondeTrabalha::where('pergunta',4)->where('resposta','a')->get();
        $perg4a = sizeof($pergunta4a);
        $pergunta4b = ondeTrabalha::where('pergunta',4)->where('resposta','b')->get();
        $perg4b = sizeof($pergunta4b);
        $pergunta4c = ondeTrabalha::where('pergunta',4)->where('resposta','c')->get();
        $perg4c = sizeof($pergunta4c);
        $pergunta4d = ondeTrabalha::where('pergunta',4)->where('resposta','d')->get();
        $perg4d = sizeof($pergunta4d);
        $pergunta4e = ondeTrabalha::where('pergunta',4)->where('resposta','e')->get();
        $perg4e = sizeof($pergunta4e);
        $pergunta5a = ondeTrabalha::where('pergunta',5)->where('resposta','a')->get();
        $perg5a = sizeof($pergunta5a);
        $pergunta5b = ondeTrabalha::where('pergunta',5)->where('resposta','b')->get();
        $perg5b = sizeof($pergunta5b);
        $pergunta5c = ondeTrabalha::where('pergunta',5)->where('resposta','c')->get();
        $perg5c = sizeof($pergunta5c);
        $pergunta5d = ondeTrabalha::where('pergunta',5)->where('resposta','d')->get();
        $perg5d = sizeof($pergunta5d);
        $pergunta5e = ondeTrabalha::where('pergunta',5)->where('resposta','e')->get();
        $perg5e = sizeof($pergunta5e);
        $pergunta6a = ondeTrabalha::where('pergunta',6)->where('resposta','a')->get();
        $perg6a = sizeof($pergunta6a);
        $pergunta6b = ondeTrabalha::where('pergunta',6)->where('resposta','b')->get();
        $perg6b = sizeof($pergunta6b);
        $pergunta6c = ondeTrabalha::where('pergunta',6)->where('resposta','c')->get();
        $perg6c = sizeof($pergunta6c);
        $pergunta6d = ondeTrabalha::where('pergunta',6)->where('resposta','d')->get();
        $perg6d = sizeof($pergunta6d);
        $pergunta6e = ondeTrabalha::where('pergunta',6)->where('resposta','e')->get();
        $perg6e = sizeof($pergunta6e);
        $departamentos = SetoresForm::all();
        $total = $perg2a + $perg2b + $perg2c + $perg2d + $perg2e;
        return view('form/graphics/ondeTrabalhaGraphic2', compact('perg2a', 'perg2b', 'perg2c', 'perg2d', 'perg2e', 'perg3a', 'perg3b', 'perg3c', 'perg3d', 'perg3e', 'perg4a', 'perg4b', 'perg4c', 'perg4d', 'perg4e', 'perg5a', 'perg5b', 'perg5c', 'perg5d', 'perg5e', 'perg6a', 'perg6b', 'perg6c', 'perg6d', 'perg6e','departamentos','total'));
    }

    public function pesqOndeTrabalha2(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta2a = ondeTrabalha::where('pergunta',2)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg2a = sizeof($pergunta2a);
            $pergunta2b = ondeTrabalha::where('pergunta',2)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg2b = sizeof($pergunta2b);
            $pergunta2c = ondeTrabalha::where('pergunta',2)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg2c = sizeof($pergunta2c);
            $pergunta2d = ondeTrabalha::where('pergunta',2)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg2d = sizeof($pergunta2d);
            $pergunta2e = ondeTrabalha::where('pergunta',2)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg2e = sizeof($pergunta2e);
            $pergunta3a = ondeTrabalha::where('pergunta',3)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg3a = sizeof($pergunta3a);
            $pergunta3b = ondeTrabalha::where('pergunta',3)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg3b = sizeof($pergunta3b);
            $pergunta3c = ondeTrabalha::where('pergunta',3)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg3c = sizeof($pergunta3c);
            $pergunta3d = ondeTrabalha::where('pergunta',3)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg3d = sizeof($pergunta3d);
            $pergunta3e = ondeTrabalha::where('pergunta',3)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg3e = sizeof($pergunta3e);
            $pergunta4a = ondeTrabalha::where('pergunta',4)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg4a = sizeof($pergunta4a);
            $pergunta4b = ondeTrabalha::where('pergunta',4)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg4b = sizeof($pergunta4b);
            $pergunta4c = ondeTrabalha::where('pergunta',4)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg4c = sizeof($pergunta4c);
            $pergunta4d = ondeTrabalha::where('pergunta',4)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg4d = sizeof($pergunta4d);
            $pergunta4e = ondeTrabalha::where('pergunta',4)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg4e = sizeof($pergunta4e);
            $pergunta5a = ondeTrabalha::where('pergunta',5)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg5a = sizeof($pergunta5a);
            $pergunta5b = ondeTrabalha::where('pergunta',5)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg5b = sizeof($pergunta5b);
            $pergunta5c = ondeTrabalha::where('pergunta',5)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg5c = sizeof($pergunta5c);
            $pergunta5d = ondeTrabalha::where('pergunta',5)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg5d = sizeof($pergunta5d);
            $pergunta5e = ondeTrabalha::where('pergunta',5)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg5e = sizeof($pergunta5e);
            $pergunta6a = ondeTrabalha::where('pergunta',6)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg6a = sizeof($pergunta6a);
            $pergunta6b = ondeTrabalha::where('pergunta',6)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg6b = sizeof($pergunta6b);
            $pergunta6c = ondeTrabalha::where('pergunta',6)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg6c = sizeof($pergunta6c);
            $pergunta6d = ondeTrabalha::where('pergunta',6)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg6d = sizeof($pergunta6d);
            $pergunta6e = ondeTrabalha::where('pergunta',6)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg6e = sizeof($pergunta6e);
            $departamentos = SetoresForm::all();
            $total = $perg2a + $perg2b + $perg2c + $perg2d + $perg2e;
            return view('form/graphics/ondeTrabalhaGraphic2', compact('perg2a', 'perg2b', 'perg2c', 'perg2d', 'perg2e', 'perg3a', 'perg3b', 'perg3c', 'perg3d', 'perg3e', 'perg4a', 'perg4b', 'perg4c', 'perg4d', 'perg4e', 'perg5a', 'perg5b', 'perg5c', 'perg5d', 'perg5e', 'perg6a', 'perg6b', 'perg6c', 'perg6d', 'perg6e','departamentos','total'));
        } else {
            return redirect()->route('ondeTrabalhaGraphic2');
        }
    }

    public function ondeTrabalhaGraphic3()
    {
        $pergunta7a = ondeTrabalha::where('pergunta',7)->where('resposta','a')->get();
        $perg7a = sizeof($pergunta7a);
        $pergunta7b = ondeTrabalha::where('pergunta',7)->where('resposta','b')->get();
        $perg7b = sizeof($pergunta7b);
        $pergunta7c = ondeTrabalha::where('pergunta',7)->where('resposta','c')->get();
        $perg7c = sizeof($pergunta7c);
        $pergunta7d = ondeTrabalha::where('pergunta',7)->where('resposta','d')->get();
        $perg7d = sizeof($pergunta7d);
        $pergunta7e = ondeTrabalha::where('pergunta',7)->where('resposta','e')->get();
        $perg7e = sizeof($pergunta7e);
        $departamentos = SetoresForm::all();
        $total = $perg7a + $perg7b + $perg7c + $perg7d + $perg7e;
        return view('form/graphics/ondeTrabalhaGraphic3', compact('perg7a', 'perg7b', 'perg7c', 'perg7d', 'perg7e','departamentos','total'));
    }

    public function pesqOndeTrabalha3(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta7a = ondeTrabalha::where('pergunta',7)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg7a = sizeof($pergunta7a);
            $pergunta7b = ondeTrabalha::where('pergunta',7)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg7b = sizeof($pergunta7b);
            $pergunta7c = ondeTrabalha::where('pergunta',7)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg7c = sizeof($pergunta7c);
            $pergunta7d = ondeTrabalha::where('pergunta',7)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg7d = sizeof($pergunta7d);
            $pergunta7e = ondeTrabalha::where('pergunta',7)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg7e = sizeof($pergunta7e);
            $departamentos = SetoresForm::all();
            $total = $perg7a + $perg7b + $perg7c + $perg7d + $perg7e;
            return view('form/graphics/ondeTrabalhaGraphic3', compact('perg7a', 'perg7b', 'perg7c', 'perg7d', 'perg7e','departamentos','total'));
        } else {
            return redirect()->route('ondeTrabalhaGraphic3');
        }
    }

    public function ondeTrabalhaGraphic4()
    {
        $pergunta8a = ondeTrabalha::where('pergunta',8)->where('resposta','a')->get();
        $perg8a = sizeof($pergunta8a);
        $pergunta8b = ondeTrabalha::where('pergunta',8)->where('resposta','b')->get();
        $perg8b = sizeof($pergunta8b);
        $pergunta8c = ondeTrabalha::where('pergunta',8)->where('resposta','c')->get();
        $perg8c = sizeof($pergunta8c);
        $pergunta8d = ondeTrabalha::where('pergunta',8)->where('resposta','d')->get();
        $perg8d = sizeof($pergunta8d);
        $pergunta8e = ondeTrabalha::where('pergunta',8)->where('resposta','e')->get();
        $perg8e = sizeof($pergunta8e);
        $pergunta9a = ondeTrabalha::where('pergunta',9)->where('resposta','a')->get();
        $perg9a = sizeof($pergunta9a);
        $pergunta9b = ondeTrabalha::where('pergunta',9)->where('resposta','b')->get();
        $perg9b = sizeof($pergunta9b);
        $pergunta9c = ondeTrabalha::where('pergunta',9)->where('resposta','c')->get();
        $perg9c = sizeof($pergunta9c);
        $pergunta9d = ondeTrabalha::where('pergunta',9)->where('resposta','d')->get();
        $perg9d = sizeof($pergunta9d);
        $pergunta9e = ondeTrabalha::where('pergunta',9)->where('resposta','e')->get();
        $perg9e = sizeof($pergunta9e);
        $pergunta10a = ondeTrabalha::where('pergunta',10)->where('resposta','a')->get();
        $perg10a = sizeof($pergunta10a);
        $pergunta10b = ondeTrabalha::where('pergunta',10)->where('resposta','b')->get();
        $perg10b = sizeof($pergunta10b);
        $pergunta10c = ondeTrabalha::where('pergunta',10)->where('resposta','c')->get();
        $perg10c = sizeof($pergunta10c);
        $pergunta10d = ondeTrabalha::where('pergunta',10)->where('resposta','d')->get();
        $perg10d = sizeof($pergunta10d);
        $pergunta10e = ondeTrabalha::where('pergunta',10)->where('resposta','e')->get();
        $perg10e = sizeof($pergunta10e);
        $pergunta11a = ondeTrabalha::where('pergunta',11)->where('resposta','a')->get();
        $perg11a = sizeof($pergunta11a);
        $pergunta11b = ondeTrabalha::where('pergunta',11)->where('resposta','b')->get();
        $perg11b = sizeof($pergunta11b);
        $pergunta11c = ondeTrabalha::where('pergunta',11)->where('resposta','c')->get();
        $perg11c = sizeof($pergunta11c);
        $pergunta11d = ondeTrabalha::where('pergunta',11)->where('resposta','d')->get();
        $perg11d = sizeof($pergunta11d);
        $pergunta11e = ondeTrabalha::where('pergunta',11)->where('resposta','e')->get();
        $perg11e = sizeof($pergunta11e);
        $pergunta12a = ondeTrabalha::where('pergunta',12)->where('resposta','a')->get();
        $perg12a = sizeof($pergunta12a);
        $pergunta12b = ondeTrabalha::where('pergunta',12)->where('resposta','b')->get();
        $perg12b = sizeof($pergunta12b);
        $pergunta12c = ondeTrabalha::where('pergunta',12)->where('resposta','c')->get();
        $perg12c = sizeof($pergunta12c);
        $pergunta12d = ondeTrabalha::where('pergunta',12)->where('resposta','d')->get();
        $perg12d = sizeof($pergunta12d);
        $pergunta12e = ondeTrabalha::where('pergunta',12)->where('resposta','e')->get();
        $perg12e = sizeof($pergunta12e);
        $departamentos = SetoresForm::all();
        $total = $perg8a + $perg8b + $perg8c + $perg8d + $perg8e;
        return view('form/graphics/ondeTrabalhaGraphic4', compact('perg8a', 'perg8b', 'perg8c', 'perg8d', 'perg8e', 'perg9a', 'perg9b', 'perg9c', 'perg9d', 'perg9e', 'perg10a', 'perg10b', 'perg10c', 'perg10d', 'perg10e', 'perg11a', 'perg11b', 'perg11c', 'perg11d', 'perg11e', 'perg12a', 'perg12b', 'perg12c', 'perg12d', 'perg12e','departamentos','total'));
    }

    public function pesqOndeTrabalha4(Request $request)
    {
        $input = $request->all();
        if(empty($input['unidade_id'])) { $input['unidade_id'] = ""; }
        $pesq = $input['unidade_id'];
        if ($pesq != "")
        {
            $pergunta8a = ondeTrabalha::where('pergunta',8)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg8a = sizeof($pergunta8a);
            $pergunta8b = ondeTrabalha::where('pergunta',8)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg8b = sizeof($pergunta8b);
            $pergunta8c = ondeTrabalha::where('pergunta',8)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg8c = sizeof($pergunta8c);
            $pergunta8d = ondeTrabalha::where('pergunta',8)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg8d = sizeof($pergunta8d);
            $pergunta8e = ondeTrabalha::where('pergunta',8)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg8e = sizeof($pergunta8e);
            $pergunta9a = ondeTrabalha::where('pergunta',9)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg9a = sizeof($pergunta9a);
            $pergunta9b = ondeTrabalha::where('pergunta',9)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg9b = sizeof($pergunta9b);
            $pergunta9c = ondeTrabalha::where('pergunta',9)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg9c = sizeof($pergunta9c);
            $pergunta9d = ondeTrabalha::where('pergunta',9)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg9d = sizeof($pergunta9d);
            $pergunta9e = ondeTrabalha::where('pergunta',9)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg9e = sizeof($pergunta9e);
            $pergunta10a = ondeTrabalha::where('pergunta',10)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg10a = sizeof($pergunta10a);
            $pergunta10b = ondeTrabalha::where('pergunta',10)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg10b = sizeof($pergunta10b);
            $pergunta10c = ondeTrabalha::where('pergunta',10)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg10c = sizeof($pergunta10c);
            $pergunta10d = ondeTrabalha::where('pergunta',10)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg10d = sizeof($pergunta10d);
            $pergunta10e = ondeTrabalha::where('pergunta',10)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg10e = sizeof($pergunta10e);
            $pergunta11a = ondeTrabalha::where('pergunta',11)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg11a = sizeof($pergunta11a);
            $pergunta11b = ondeTrabalha::where('pergunta',11)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg11b = sizeof($pergunta11b);
            $pergunta11c = ondeTrabalha::where('pergunta',11)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg11c = sizeof($pergunta11c);
            $pergunta11d = ondeTrabalha::where('pergunta',11)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg11d = sizeof($pergunta11d);
            $pergunta11e = ondeTrabalha::where('pergunta',11)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg11e = sizeof($pergunta11e);
            $pergunta12a = ondeTrabalha::where('pergunta',12)->where('resposta','a')->where('departamento_id',$pesq)->get();
            $perg12a = sizeof($pergunta12a);
            $pergunta12b = ondeTrabalha::where('pergunta',12)->where('resposta','b')->where('departamento_id',$pesq)->get();
            $perg12b = sizeof($pergunta12b);
            $pergunta12c = ondeTrabalha::where('pergunta',12)->where('resposta','c')->where('departamento_id',$pesq)->get();
            $perg12c = sizeof($pergunta12c);
            $pergunta12d = ondeTrabalha::where('pergunta',12)->where('resposta','d')->where('departamento_id',$pesq)->get();
            $perg12d = sizeof($pergunta12d);
            $pergunta12e = ondeTrabalha::where('pergunta',12)->where('resposta','e')->where('departamento_id',$pesq)->get();
            $perg12e = sizeof($pergunta12e);
            $departamentos = SetoresForm::all();
            $total = $perg8a + $perg8b + $perg8c + $perg8d + $perg8e;
            return view('form/graphics/ondeTrabalhaGraphic4', compact('perg8a', 'perg8b', 'perg8c', 'perg8d', 'perg8e', 'perg9a', 'perg9b', 'perg9c', 'perg9d', 'perg9e', 'perg10a', 'perg10b', 'perg10c', 'perg10d', 'perg10e', 'perg11a', 'perg11b', 'perg11c', 'perg11d', 'perg11e', 'perg12a', 'perg12b', 'perg12c', 'perg12d', 'perg12e','departamentos','total'));
        } else {
            return redirect()->route('ondeTrabalhaGraphic4');
        }
    }
}