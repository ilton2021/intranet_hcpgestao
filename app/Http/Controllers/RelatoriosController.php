<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ControleVeiculos;
use App\Models\UserPerfil;
use App\Models\Unidades;
use PDO;
use Validator;

class RelatoriosController extends Controller
{
    public function showRelatorios()
    {
        $id_user = Auth::user()->id;
        $idTela = 17;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        $unidades = Unidades::all();
        $relatorioNF = '';
        if ($validacao == "ok") {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
            return view('relatorios/showRelatorios',compact('perfil_user', 'unidades', 'relatorioNF'));
        } else {
            $validator = "Você não tem Permissão para acessar esta tela!!!";
            return redirect()->route('home')
                ->withErrors($validator)
                ->with('perfil_user', 'validator');
        }
    }

    public function relatoriosNF(Request $request)
    {
        $input = $request->all();
        $id_user = Auth::user()->id;
        $idTela = 17;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        $unidades = Unidades::all();
        $relatorioNF = 1;
        if ($validacao == "ok") {
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
            return redirect()->route('relatorioNF', $input['unidade_id']);
        } else {
            $validator = "Você não tem Permissão para acessar esta tela!!!";
            return redirect()->route('home')
                ->withErrors($validator)
                ->with('perfil_user', 'validator');
        }
    }

    public function relatorioNF($id)
    {
        $hoje = date('Y-m-d', strtotime('now'));
        $unidade = Unidades::where('id', $id)->get();
        $id_user = Auth::user()->id;
        $idTela = 17;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        $unidades = Unidades::all();
        $relatorioNF = 1;

        if ($validacao == "ok") {
            $totalNotasDia = 0;
            $totalNotasRelatorioFiltro = 0;
            $relatorioFiltrado = '';
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
            $dataSelec = date('Y-d-m', strtotime('now'));
            $dataRelatorio = date('m/d/Y', strtotime('now'));
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}
            $row  = [];
            $row2 = [];
            return view('relatorios/relatoriosNF',compact('perfil_user', 'unidades', 'relatorioNF', 'unidade', 'totalNotasDia', 'relatorioFiltrado', 'dataSelec', 'totalNotasRelatorioFiltro', 'row', 'row2', 'dataRelatorio'));
        } else {
            $validator = "Você não tem Permissão para acessar esta tela!!!";
            return redirect()->route('home')
                ->withErrors($validator)
                ->with('perfil_user', 'validator');
        }
    }

    public function filtrarNF(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'data'
        ]);
        $id_user = Auth::user()->id;
        $idTela = 17;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        $unidades = Unidades::all();
        $relatorioNF = 1;
        if ($validacao == "ok") {
            $relatorioFiltrado = 1;
			$id_user = Auth::user()->id;
			$UserPerfil = UserPerfil::where('users_id', $id_user)->get();
			$perfil_user = array();
			for ($i = 0; $i < sizeof($UserPerfil); $i++) {
				$perfil_user[$i] = $UserPerfil[$i]->perfil_id;
			}

            if($validator->fails()){
                return redirect()->back()
                    ->withErrors($validator);
            } else {
                $hoje = date('Y-m-d', strtotime('now'));
                if($input['data'] >= $hoje){
                    $validator = 'Não é possível gerar o relatório do dia atual ou posterior.';
                    return redirect()->back()
                        ->withErrors($validator);
                }
                
                $data = $input['data'];
                
                $sql  = "SELECT * FROM Documentos WHERE Created_at LIKE :data";
                
                $sql3 = "SELECT * FROM Produtos WHERE Created_at LIKE :data";

                $db_username = "sistema";
                $db = 'assinaturas';
                switch($id){
                    case 2:
                        // HMR
                        $db_password = 'vNf7p.rGgEYJ-Zks';
                        $dsn = 'mysql:dbname='.$db.';host=10.0.0.107';
                        break;
                    case 3:
                        // Belo Jardim
                        $db_password = 'lnJy[Kt*DnK8-47M';
                        $dsn = 'mysql:dbname='.$db.';host=192.168.0.2';
                        break;
                    case 4:
                        // Arcoverde
                        $db_password = '.UGxQQ4zIf3pk1Gi';
                        $dsn = 'mysql:dbname='.$db.';host=192.168.1.96';
                        break;
                    case 5:
                        // Arruda
                        $db_password = 'TVFmYIdpS(IAD9ya';
                        $dsn = 'mysql:dbname='.$db.';host=10.1.0.76';
                        break;
                    case 6:
                        // Caruaru
                        $db_password = 'oouY19YAf57tpTw!';
                        $dsn = 'mysql:dbname='.$db.';host=192.168.12.22';
                        break;
                    case 7;
                        // HSS
                        $db_password = 'oq.JRddv5r_ZJcrZ';
                        $dsn = 'mysql:dbname='.$db.';host=10.3.0.22';
                        break;
                    case 8:
                        // Igarassu
                        $db_password = 'WSzSR9Q)xwS9bm!l';
                        $dsn = 'mysql:dbname='.$db.';host=11.2.0.22';
                        break;
                    case 9:
                        // Palmares
                        $db_password = 'u.M9wUif5rknxqaw';
                        $dsn = 'mysql:dbname='.$db.';host=10.10.0.15';
                        break;
                }

                try {
                    $conn = new PDO($dsn,$db_username,$db_password); 
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                    $query = $conn->prepare($sql);
                    $query->bindValue(':data', $data . '%', PDO::PARAM_STR);
                    $query->execute();
                    $row   = $query->fetchAll(PDO::FETCH_ASSOC);
                    $qtd = sizeof($row);

                    $ids = [];
                    for($a = 0; $a < $qtd; $a++) {
                        $ids[] = $row[$a]['id'] ;
                    } 
                    $idsF = implode(',', $ids);

                    if($idsF == "") {
                        $sql2 = "SELECT aprovacao.*, gestor.funcao_id FROM aprovacao 
                        INNER JOIN gestor ON gestor.id = aprovacao.gestor_anterior_id 
                        INNER JOIN documentos ON documentos.id = aprovacao.documento_id 
                        WHERE documentos.id IN (0)"; 
                    } else {
                        $sql2 = "SELECT aprovacao.*, gestor.funcao_id FROM aprovacao 
                        INNER JOIN gestor ON gestor.id = aprovacao.gestor_anterior_id 
                        INNER JOIN documentos ON documentos.id = aprovacao.documento_id 
                        WHERE documentos.id IN ($idsF)"; 
                    }   

                    $query = $conn->prepare($sql2);
                    $query->execute();
                    $aprovacao = $query->fetchAll(PDO::FETCH_ASSOC);

                    $query = $conn->prepare($sql3);
                    $query->bindValue(':data', $data . '%', PDO::PARAM_STR);
                    $query->execute();
                    $row2 = $query->fetchAll(PDO::FETCH_ASSOC);
                    $qtd2 = sizeof($row2);

                    $ids2 = [];
                    for($b = 0; $b < $qtd2; $b++) {
                        $ids2[] = $row2[$b]['id'] ;
                    } 
                    $idsF2 = implode(',', $ids2);

                    if($idsF2 == "") {
                        $sql4 = "SELECT aprovacao_produtos.*, gestor.funcao_id FROM aprovacao_produtos 
                        INNER JOIN gestor ON gestor.id = aprovacao_produtos.gestor_anterior_id
                        INNER JOIN produtos ON produtos.id = aprovacao_produtos.produto_id
                        WHERE produtos.id IN (0)";
                    } else {
                        $sql4 = "SELECT aprovacao_produtos.*, gestor.funcao_id FROM aprovacao_produtos 
                        INNER JOIN gestor ON gestor.id = aprovacao_produtos.gestor_anterior_id
                        INNER JOIN produtos ON produtos.id = aprovacao_produtos.produto_id
                        WHERE produtos.id IN ($idsF2)";
                    }

                    $query2 = $conn->prepare($sql4);
                    $query2->execute();
                    $aprovacaoProdutos = $query2->fetchAll(PDO::FETCH_ASSOC);

                } catch (PDOException $error){
                    echo "Erro".$error->getMessage();
                }

                $dataSelec = $input['data'];

                $unidade = Unidades::where('id', $id)->get();
                $totalNotasDia = '';
                $dataRelatorio = $input['data'];
                $totalNotasRelatorioFiltro = sizeof($row) + sizeof($row2);

                $pdf = PDF::loadView('pdf.notasFiscais', compact('row', 'row2', 'aprovacao', 'aprovacaoProdutos', 'totalNotasDia', 'dataRelatorio', 'totalNotasRelatorioFiltro'));
                $pdf->setPaper('A4', 'landscape');
                $pdf->download('Relatorio_notas_fiscais.pdf');


                $validator = 'Resultado do Relatório Filtrado.';
                return view('relatorios/relatoriosNF',compact('perfil_user', 'unidades', 'relatorioNF', 'unidade', 'row', 'row2', 'aprovacao', 'aprovacaoProdutos', 'totalNotasDia', 'relatorioFiltrado', 'dataRelatorio', 'totalNotasRelatorioFiltro', 'pdf', 'dataSelec'))
                    ->withErrors($validator);
            }
        } else {
            $validator = "Você não tem Permissão para acessar esta tela!!!";
            return redirect()->route('home')
                ->withErrors($validator)
                ->with('perfil_user', 'validator');
        }
    }

    public function downloadRelatorioNF($id, $data)
    { 
        $sql  = "SELECT * FROM Documentos WHERE Created_at LIKE :data";
          
        $sql3 = "SELECT * FROM Produtos WHERE Created_at LIKE :data";

        $db_username = "sistema";
        $db = 'assinaturas';
        switch($id){
            case 2:
                // HMR
                $db_password = 'vNf7p.rGgEYJ-Zks';
                $dsn = 'mysql:dbname='.$db.';host=10.0.0.107';
                break;
            case 3:
                // Belo Jardim
                $db_password = 'lnJy[Kt*DnK8-47M';
                $dsn = 'mysql:dbname='.$db.';host=192.168.0.2';
                break;
            case 4:
                // Arcoverde
                $db_password = '.UGxQQ4zIf3pk1Gi';
                $dsn = 'mysql:dbname='.$db.';host=192.168.1.96';
                break;
            case 5:
                // Arruda
                $db_password = 'TVFmYIdpS(IAD9ya';
                $dsn = 'mysql:dbname='.$db.';host=10.1.0.76';
                break;
            case 6:
                // Caruaru
                $db_password = 'oouY19YAf57tpTw!';
                $dsn = 'mysql:dbname='.$db.';host=192.168.12.22';
                break;
            case 7;
                // HSS
                $db_password = 'oq.JRddv5r_ZJcrZ';
                $dsn = 'mysql:dbname='.$db.';host=10.3.0.22';
                break;
            case 8:
                // Igarassu
                $db_password = 'WSzSR9Q)xwS9bm!l';
                $dsn = 'mysql:dbname='.$db.';host=11.2.0.22';
                break;
            case 9:
                // Palmares
                $db_password = 'u.M9wUif5rknxqaw';
                $dsn = 'mysql:dbname='.$db.';host=10.10.0.15';
                break;
        }

        try {
            $conn = new PDO($dsn,$db_username,$db_password); 
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                    $query = $conn->prepare($sql);
                    $query->bindValue(':data', $data . '%', PDO::PARAM_STR);
                    $query->execute();
                    $row   = $query->fetchAll(PDO::FETCH_ASSOC);
                    $qtd = sizeof($row);

                    $ids = [];
                    for($a = 0; $a < $qtd; $a++) {
                        $ids[] = $row[$a]['id'] ;
                    } 
                    $idsF = implode(',', $ids);

                    $sql2 = "SELECT aprovacao.*, gestor.funcao_id FROM aprovacao 
                        INNER JOIN gestor ON gestor.id = aprovacao.gestor_anterior_id 
                        INNER JOIN documentos ON documentos.id = aprovacao.documento_id 
                        WHERE documentos.id IN ($idsF)"; 

                    $query = $conn->prepare($sql2);
                    $query->execute();
                    $aprovacao = $query->fetchAll(PDO::FETCH_ASSOC);

                    $query = $conn->prepare($sql3);
                    $query->bindValue(':data', $data . '%', PDO::PARAM_STR);
                    $query->execute();
                    $row2 = $query->fetchAll(PDO::FETCH_ASSOC);
                    $qtd2 = sizeof($row2);

                    $ids2 = [];
                    for($b = 0; $b < $qtd2; $b++) {
                        $ids2[] = $row2[$b]['id'] ;
                    } 
                    $idsF2 = implode(',', $ids2);
                   
                    $sql4 = "SELECT aprovacao_produtos.*, gestor.funcao_id FROM aprovacao_produtos 
                    INNER JOIN gestor ON gestor.id = aprovacao_produtos.gestor_anterior_id
                    INNER JOIN produtos ON produtos.id = aprovacao_produtos.produto_id
                    WHERE produtos.id IN ($idsF2)";

                    $query2 = $conn->prepare($sql4);
                    $query2->execute();
                    $aprovacaoProdutos = $query2->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error){
            echo "Erro".$error->getMessage();
        }

        $unidade = Unidades::where('id', $id)->get();
        $totalNotasDia = '';
        $dataRelatorio = $data;
        $totalNotasRelatorioFiltro = sizeof($row) + sizeof($row2);

        $dataSelec = $data;

        $unidade = Unidades::where('id', $id)->get();
        $totalNotasDia = '';
        $dataRelatorio = $data;
        $totalNotasRelatorioFiltro = sizeof($row) + sizeof($row2);

        $pdf = PDF::loadView('pdf.notasFiscais', compact('row', 'row2', 'aprovacao', 'aprovacaoProdutos', 'totalNotasDia', 'dataRelatorio', 'totalNotasRelatorioFiltro'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->download('Relatorio_notas_fiscais.pdf');

        return $pdf->download('Relatorio_notas_fiscais.pdf');
    }

    public function relatorioVeiculos(Request $request)
    {
        $id_user = Auth::user()->id;
        $idTela = 17;
        $validacao = PermissaoUserController::Permissao($id_user, $idTela);
        if ($validacao == "ok") {
            $input  = $request->all();
            /*if ($input['data_ini'] > $input['data_fim']) {
                $validator = "A data inicial não pode ser maior que a final.";
                return view('relatorios/showRelatorios')
                    ->withErrors($validator)
                    ->withInput(session()->flashInput($request->input()));
            } else {*/
                //$startDate = date($input['data_ini']);
                //$endDate = date($input['data_fim']);
                //$veiculos = ControleVeiculos::whereBetween('created_at', [$startDate, $endDate])->get();
				$veiculos = ControleVeiculos::all();
                $pdf = PDF::loadView('pdf.veiculos', compact('veiculos'));
                $pdf->setPaper('A4', 'landscape');
                $validator =  'Aguarde o relátorio está sendo gerado';
                return $pdf->download('Relatorio_veiculos.pdf');
            /*}*/
        } else {
            $validator = "Você não tem Permissão para acessar esta tela!!!";
            return redirect()->route('home')
                ->withErrors($validator)
                ->with('perfil_user', 'validator');
        }
    }
}
