<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetorDocumento;
use App\Models\Unidades;
use Validator;
use DB;

class SetorDocumentoController extends Controller
{
    //Cadastros de Setores
    public function setorDocumento()
    {
        $setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
        ->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->paginate(20);
        $unidades = Unidades::all();
        $paginate = True;
        return view('setor_documento/cadastroSetorDocumento', compact('setores', 'unidades', 'paginate'));
    }

    //Pesquisar setores
    public function pesquisarSetoresDocumentos(Request $request)
    {
        $input = $request->all();
        if ($input['unidade'] != '' && $input['nomeSetor'] != '') {
            $setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
            ->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->where('setor_documento.setor', 'like', '%'.$input['nomeSetor'].'%')->where('setor_documento.unidade_id', $input['unidade'])->get();
            $unidades = Unidades::all();
            $paginate = False;
            return view('setor_documento/cadastroSetorDocumento', compact('setores', 'unidades', 'paginate'));
        }

        if($input['unidade'] != '') {
            $setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
            ->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->where('setor_documento.unidade_id', $input['unidade'])->get();
            $unidades = Unidades::all();
            $paginate = False;
            return view('setor_documento/cadastroSetorDocumento', compact('setores', 'unidades', 'paginate'));
        }

        if($input['nomeSetor'] != ''){
            $setores = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
            ->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->where('setor_documento.setor', 'like', '%'.$input['nomeSetor'].'%')->get();
            $unidades = Unidades::all();
            $paginate = False;
            return view('setor_documento/cadastroSetorDocumento', compact('setores', 'unidades', 'paginate'));
        }

        if($input['unidade'] == '' && $input['nomeSetor'] == ''){
            return redirect()->route('setorDocumento');
        }
    }

    //Novo Setor
    public function novoSetorDocumento()
    {
        $unidades = Unidades::all();
        return view('setor_documento/novoSetorDocumento', compact('unidades'));
    }

    public function storeSetorDocumento(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
			'setor'      => 'required|max:255|unique:setor_documento',
            'unidade_id' => 'required'
    	]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } else {
            $setor = SetorDocumento::create($input);
            $validator = 'Setor Criado com sucesso!';
            return redirect()->route('setorDocumento')
                    ->withErrors($validator);
        }
    }

    //Alterar Setor
    public function alterarSetorDocumento($id)
    {
        $setor = SetorDocumento::where('id', $id)->get();
        $unidades = Unidades::all();
        return view('setor_documento/alterarSetorDocumento', compact('setor', 'unidades'));
    }

    public function updateSetorDocumento(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
			'setor'      => 'required|max:255',
            'unidade_id' => 'required'
    	]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } else {
            $setor = SetorDocumento::find($id);
            $setor->update($input);
            $validator = 'Setor Alterado com Sucesso.';
            return redirect()->route('setorDocumento')->withErrors($validator);
        }
    }

    // Deletar Setor
    public function deleteSetorDocumento($id)
    {
        $setor = SetorDocumento::join('unidades', 'setor_documento.unidade_id', '=', 'unidades.id')
        ->select('setor_documento.*', 'setor_documento.setor as setor', 'unidades.nome as unidade')->where('setor_documento.id', $id)->get();
        return view('setor_documento/excluirSetorDocumento', compact('setor'));
    }

    public function destroySetorDocumento($id)
    {
        $setor = SetorDocumento::find($id);
        $setor->delete();
        $validator = 'Setor Deletado com sucesso';
        return redirect()->route('setorDocumento')
                ->withErrors($validator);
    }

    //Documento Setor
    public function documentoSetor($id)
    {
        if(DB::table('documento_setor')->where('setor_id', $id)->exists()){
            $documento = DocumentoSetor::where('setor_id', $id)->get();
            return view('setor_documento/documento', compact('documento'));
        } else {
            $documento = NULL;
            $validator = 'Nenhum documento vinculado ao setor';
            return view('setor_documento/documento', compact('documento'))
                    ->withErrors($validator);
        }
    }
}
