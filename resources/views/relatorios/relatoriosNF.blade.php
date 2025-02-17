@extends('layouts.adm2')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<meta charset="UTF-8">
<br><br>
@section('content')
@if ($errors->any())
<div class="alert alert-danger mt-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col"> 
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-2 mb-2"><b>Relatório do dia: <?php echo date('d/m/Y', strtotime($dataRelatorio)); ?></b></h4>
                    <form action="{{ route('filtrarNF', $unidade[0]->id) }}" method="post" class="p-2">
                    @csrf
                    <table class="table border border-rounded" style="margin-bottom: 0px;">
                        <tr>
                            <td class="border"><b>DATA:</b></td>
                            <td><input type="date" name="data" id="data" class="form form-control" required value="<?php echo $dataSelec; ?>" /></td>
                            <td><button type="submit" class="btn btn-success btn-sm">Pesquisar <i class="bi bi-funnel"></i></button></td>
                        </tr>
                        <tr>
                            <td class="border"><b>TOTAL DE NOTAS:</b></td>
                            <td>
                                <b>{{ $totalNotasRelatorioFiltro }}</b>
                                @if($totalNotasDia != 0)
                                <a href="{{ route('downloadRelatorioNF', array($unidade[0]->id, $dataSelec)) }}" class="btn btn-success btn-sm">
                                    Download <i class="bi bi-download"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="{{ route('showRelatorios') }}"> <b>Voltar <i class="bi bi-reply"></i></b> </a>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>

                <div class="card mt-4">
                    <h4 class="card-title text-center pt-3"><b>DOCUMENTOS</b></h4>
                    <table class="table border border-rounded mt-2" style="margin-bottom: 0px;">
                        <thead style="background-color:black;color:white;">
                            <th><center>Nota Fiscal</center></th>
                            <th><center>Data inserida</center></th>
                            <th><center>Setor Contabilidade</center></th>
                            <th><center>Dias</center></th>
                            <th><center>Setor Prestação</center></th>
                            <th><center>Dias</center></th>
                            <th><center>Setor Financeiro</center></th>
                            <th><center>Dias</center></th>
                            <th><center>Data Concluída</center></th>
                            <th><center>Dias</center></th>
                        </thead>
                        <tbody>
                            @foreach($row as $nota) 
                                <tr>
                                    <td class="border-right"><b><center>{{ $nota['id'] }}</center></b></td>
                                    <td class="border-right">
                                      <center> 
                                        <?php $dateInsercao = date('d/m/Y', strtotime($nota['created_at'])); ?>
                                        <?php echo $dateInsercao; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center>
                                        <?php $dateAprovacaoCont = ''; ?>
                                          @foreach($aprovacao as $aprov)
                                            @if($aprov['documento_id'] == $nota['id'] && $aprov['funcao_id'] == '4')
                                                <?php $dateAprovacaoCont = date('d/m/Y', strtotime($aprov['data_aprovacao']));
                                                      echo $dateAprovacaoCont; ?> <br>
                                            @endif
                                          @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_C = new \DateTime();
                                        $data_I = new \DateTime();
                                        $newDateC = $data_C->createFromFormat('d/m/Y', $dateAprovacaoCont);
                                        $newDateI = $data_I->createFromFormat('d/m/Y', $dateInsercao);
                                        $intervalo = $newDateC->diff($newDateI);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center>
                                        <?php $dateAprovacaoPrest = ''; ?>
                                        @foreach($aprovacao as $aprov)
                                            @if($aprov['documento_id'] == $nota['id'] && $aprov['funcao_id'] == '3')
                                                <?php $dateAprovacaoPrest = date('d/m/Y', strtotime($aprov['data_aprovacao'])); 
                                                      echo $dateAprovacaoPrest; ?> <br>
                                            @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_P = new \DateTime();
                                        $data_C = new \DateTime();
                                        $newDateP = $data_P->createFromFormat('d/m/Y', $dateAprovacaoPrest);
                                        $newDateC = $data_C->createFromFormat('d/m/Y', $dateAprovacaoCont);
                                        $intervalo = $newDateP->diff($newDateC);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center> <?php $dateAprovacaoFinanceiro = ''; ?>
                                        @foreach($aprovacao as $aprov)
                                            @if($aprov['documento_id'] == $nota['id'] && $aprov['funcao_id'] == '5' && $aprov['ativo'] == 1)
                                              <?php $dateAprovacaoFinanceiro = date('d/m/Y', strtotime($aprov['data_aprovacao'])); 
                                                      echo $dateAprovacaoFinanceiro; ?> <br>
                                            @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_F = new \DateTime();
                                        $data_P = new \DateTime();
                                        $newDateF = $data_F->createFromFormat('d/m/Y', $dateAprovacaoFinanceiro);
                                        $newDateP = $data_P->createFromFormat('d/m/Y', $dateAprovacaoPrest);
                                        $intervalo = $newDateF->diff($newDateP);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center> <?php $dateConcluida = ''; ?>
                                        @foreach($aprovacao as $aprov)
                                          @if($aprov['documento_id'] == $nota['id'] && $aprov['funcao_id'] == '5')
                                                <?php
                                                    $dateConcluida = date('d/m/Y', strtotime($aprov['data_aprovacao']));
                                                    echo $dateConcluida; 
                                                ?> <br>
                                          @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_F = new \DateTime();
                                        $data_I = new \DateTime();
                                        $newDateF = $data_F->createFromFormat('d/m/Y', $dateAprovacaoFinanceiro);
                                        $newDateI = $data_I->createFromFormat('d/m/Y', $dateInsercao);
                                        $intervalo = $newDateF->diff($newDateI);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card mt-4 mb-4">
                    <h4 class="card-title text-center pt-3"><b>PRODUTOS</b></h4>
                    <table class="table border border-rounded mt-2" style="margin-bottom: 0px;">
                        <thead style="background-color:black;color:white;">
                            <th><center>Nota Fiscal</center></th>
                            <th><center>Data inserida</center></th>
                            <th><center>Setor Prestação</center></th>
                            <th><center>Dias</center></th>
                            <th><center>Setor Financeiro</center></th>
                            <th><center>Dias</center></th>
                            <th><center>Data Concluida</center></th>
                            <th><center>Dias</center></th>
                        </thead>
                        <tbody>
                            @foreach($row2 as $nota)
                                <tr>
                                    <td class="border-right"><b><center>{{ $nota['id'] }}</center></b></td>
                                    <td class="border-right">
                                      <center> 
                                        <?php $dateInsercao = date('d/m/Y', strtotime($nota['created_at'])); ?>
                                        <?php echo $dateInsercao; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center>
                                        <?php $dateAprovacaoPrest = ''; ?>
                                        @foreach($aprovacaoProdutos as $aprov)
                                            @if($aprov['produto_id'] == $nota['id'] && $aprov['funcao_id'] == '3')
                                                <?php $dateAprovacaoPrest = date('d/m/Y', strtotime($aprov['data_aprovacao'])); 
                                                      echo $dateAprovacaoPrest; ?> <br>
                                            @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_P = new \DateTime();
                                        $data_I = new \DateTime();
                                        $newDateP = $data_P->createFromFormat('d/m/Y', $dateAprovacaoPrest);
                                        $newDateI = $data_I->createFromFormat('d/m/Y', $dateInsercao);
                                        $intervalo = $newDateI->diff($newDateP);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center> <?php $dateAprovacaoFinanceiro = ''; ?>
                                        @foreach($aprovacaoProdutos as $aprov)
                                            @if($aprov['produto_id'] == $nota['id'] && $aprov['funcao_id'] == '5' && $aprov['ativo'] == 1)
                                              <?php $dateAprovacaoFinanceiro = date('d/m/Y', strtotime($aprov['data_aprovacao'])); 
                                                      echo $dateAprovacaoFinanceiro; ?> <br>
                                            @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_F = new \DateTime();
                                        $data_P = new \DateTime();
                                        $newDateF = $data_F->createFromFormat('d/m/Y', $dateAprovacaoFinanceiro);
                                        $newDateP = $data_P->createFromFormat('d/m/Y', $dateAprovacaoPrest);
                                        $intervalo = $newDateF->diff($newDateP);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                    <td class="border-right">
                                      <center> <?php $dateConcluida = ''; ?>
                                        @foreach($aprovacaoProdutos as $aprov)
                                          @if($aprov['produto_id'] == $nota['id'] && $aprov['funcao_id'] == '5')
                                                <?php
                                                    $dateConcluida = date('d/m/Y', strtotime($aprov['data_aprovacao']));
                                                    echo $dateConcluida; 
                                                ?> <br>
                                          @endif
                                        @endforeach
                                      </center>
                                    </td>
                                    <?php 
                                        $data_F = new \DateTime();
                                        $data_I = new \DateTime();
                                        $newDateF = $data_F->createFromFormat('d/m/Y', $dateAprovacaoFinanceiro);
                                        $newDateI = $data_I->createFromFormat('d/m/Y', $dateInsercao);
                                        $intervalo = $newDateF->diff($newDateI);  
                                    ?>
                                    <td class="border-right">
                                      <center>
                                        <?php echo $intervalo->days; ?>
                                      </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection