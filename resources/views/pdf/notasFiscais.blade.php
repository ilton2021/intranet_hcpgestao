<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/favico.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <title>Intranet Hcp Gestão - Controle de Notas Fiscais</title>

</head>

<body>
    <div class="text-center mb-3">
        <div>
            <h6><?php echo "Geração: " . date('d/m/Y H:i:s') ?></h6>
        </div>
        <div>
            <img src="{{ asset('img/Imagem1.png') }}" height="50" class="d-inline-block align-top" alt="">
        </div>
        <div class="border border-success rounded">
            <h2>RELATÓRIO DE NOTA FISCAL - <?php $date=date_create($dataRelatorio); echo date_format($date,"d/m/Y");?></h2>
        </div>
    </div>

    <div class="table-responsive mb-3">
        <table class="table border border-rounded" style="margin-bottom: 0px;">
            <tr>
                <td><b>TOTAL DE NOTAS</b></td>
                <td><b>{{ $totalNotasRelatorioFiltro }}</b></td>
            </tr>
        </table>
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
  </body>
</html>
