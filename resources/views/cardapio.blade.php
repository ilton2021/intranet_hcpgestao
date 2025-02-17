@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />

<body>
    <main id="main">
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Cardápio das Unidades</h2>
                    <ol>
                        <li><a href="javascript:history.back();">Home</a></li>
                        <li>Cardápio das Unidades</li>
                    </ol>
                </div>
            </div>
        </section>
        
        <section id="portfolio-details" class="portfolio-details">
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            @if ($error == 'Mensagem enviada com sucesso!')
              <div class="alert alert-success">
                <li>{{ $error }}</li>
              </div>
            @else
              <div class="alert alert-danger">
                <ul>
                  <li>{{ $error }}</li>
                </ul>
              </div>
            @endif
          @endforeach
        @endif 
        <div class="container">
         <div class="row gy-4">
            <section id="cards" class="portfolio-details">
             <div class="container"> 
              <div class="row gy-4"> 
               <div class="d-inline-flex justify-content-around flex-wrap">
               
                @if($qtdCDCF > 0)
                 <div class="card border-0 m-3" style="width: 18rem;outline:none;"> 
                    <a class="btn btn-info btn-lg text-white" target="_blank">
                      <img src="{{ asset('/storage/cardapios/cafeDamanha.jpg') }}" width="180px" height="180px">
                    </a>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $cardapiosDiaCafe[0]->id; ?>">
                      <strong>Café da Manhã</strong>  
                    </button>
                     <div class="modal fade" id="exampleModal_<?php echo $cardapiosDiaCafe[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                       <div class="modal-content">
                        <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">CARDÁPIO DO DIA - CAFÉ DA MANHÃ: <?php echo date('d/m/Y', strtotime($cardapiosDiaCafe[0]->dia)); ?></h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         <div class="form-row align-items-center">
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo) 
                            @if($cardapiosDiaCafe[0]->insumos_1_id == $insumo->id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_1_id" name="insumos_1_id" value="<?php echo 'CAFÉ: '. $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo) 
                            @if($cardapiosDiaCafe[0]->insumos_2_id == $insumo->id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_2_id" name="insumos_2_id" value="<?php echo 'REFRESCO: '. $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo)
                            @if($cardapiosDiaCafe[0]->insumos_3_id == $insumo->id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_3_id" name="insumos_3_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                         </div>
                         <div class="form-row align-items-center">
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo) 
                            @if($cardapiosDiaCafe[0]->insumos_4_id == $insumo->id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo) 
                            @if($cardapiosDiaCafe[0]->insumos_5_id == $insumo->id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_5_id" name="insumos_5_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                          <div class="mx-sm-3 mb-2">
                           @foreach($insumos as $insumo)
                            @if($insumo->id == $cardapiosDiaCafe[0]->insumos_6_id)
                             <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
                            @endif
                           @endforeach
                          </div>
                          <div class="mx-sm-3 mb-2">
                            <img src="{{asset('storage')}}/{{$unidades[0]->caminho}}" height="60" width="150">
                            <img src="{{asset('storage/unidades/gestao.png')}}" height="60" width="150" style="margin-left: 140px">
                            <img src="{{asset('storage/foto_sus.jpg')}}" height="90" width="150" style="margin-left: 130px;">
                          </div>
                         </div>
                        </div>
                       </div>
                      </div>
                     </div> <br>
					          @if($cardapiosDiaCafe[0]->unidade_id == 6)
                      <button class="btn btn-success btn-md text-white aaa" data-bs-toggle="modal"
                              data-bs-target="#exampleModal1_<?php echo $cardapiosDiaCafe[0]->id; ?>" data-bs-whatever="@getbootstrap">
                        <strong>Avaliação <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                      </button>
                     </div>
                     <div class="modal fade" id="exampleModal1_<?php echo $cardapiosDiaCafe[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                       <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div>
                          <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                           Bem-vindo(a), este é um canal para você, integrante do HCP Gestão, expressar livremente seus
                           elogios, solicitações, reclamações, dúvidas, sugestões, críticas relacionadas ao Cardápio.
                          </p>
                          <p class="m-2 p-2 text-center">
                           Ao preencher esse formulário, garantimos a todos o direito de total sigilo. O Comitê será
                           responsável por apurar, avaliar e buscar soluções para as questões abordadas com muita ética e
                           profissionalismo, defendendo os interesses dos manifestantes e do HCP Gestão.
                          </p>
                        </div>
                        <div class="modal-body">
                         <form action="{{ route('questCardapio', $unidades[0]->id) }}" method="post">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="border-bottom border-gray p-1">
                           <div class="d-flex justify-content-start">
                            <div class="col-6 col-sm-5">
                             <label for="recipient-name" class="col-form-label"><b>1) O que você achou do sabor das preparações? </b> <br>
                             &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta1" name="resposta1"> Bom &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="2" id="resposta1" name="resposta1"> Ruim &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="3" id="resposta1" name="resposta1"> Ótimo
                            </div>
                            <div class="col-5 col-sm-4">
                             <label for="recipient-name" class="col-form-label"><b>2) O que você achou do suco? </b> <br>
                             &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta2" name="resposta2"> Bom &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="2" id="resposta2" name="resposta2"> Ruim &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="3" id="resposta2" name="resposta2"> Ótimo
                            </div>
                           </div>   <br><br>
                           <div class="d-flex justify-content-start">
                            <div class="col-6 col-sm-5">
                             <label for="recipient-name" class="col-form-label"><b>3) O que você achou da salada? </b> <br> 
                             &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta3" name="resposta3"> Bom &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="2" id="resposta3" name="resposta3"> Ruim &nbsp;&nbsp;
                             <input class="form-check-input" type="radio" value="3" id="resposta3" name="resposta3"> Ótimo
                            </div> 
                            <div class="col-6 col-sm-5">
                             <label for="recipient-name" class="col-form-label"><b>4) Críticas/Sugestões ou Elogios: </b> <br>
                             <textarea style="width: 280px" class="form-control" id="resposta4" name="resposta4" rows="5" cols="20" required></textarea>
                             <input hidden class="form-check-input" type="text" value="1" id="tipo_refeicao" name="tipo_refeicao">
                            </div> 
                           </div>
                          </div>
                        </div>
                         <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                         </form>
                       </div>
                    </div> 
					        @endif
                 </div>
                @endif
                
                @if($qtdCDAL > 0)
                 <div class="card border-0 m-3" style="width: 18rem;outline:none;">
                  <a class="btn btn-info btn-lg text-white" target="_blank">
                   <img src="{{ asset('/storage/cardapios/almoco.jpg') }}" width="180px" height="180px">
                  </a>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $cardapiosDiaAlmoco[0]->id; ?>">
                    <strong>Almoço</strong>
                  </button>
                  <div class="modal fade" id="exampleModal_<?php echo $cardapiosDiaAlmoco[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                     <div class="modal-header">
                       <h1 class="modal-title fs-5" id="exampleModalLabel">CARDÁPIO DO DIA - ALMOÇO: <?php echo date('d/m/Y', strtotime($cardapiosDiaAlmoco[0]->dia)); ?></h1>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                      <div class="form-row align-items-center">
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo) 
                         @if($cardapiosDiaAlmoco[0]->insumos_1_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_1_id" name="insumos_1_id" value="<?php echo strtoupper($insumo->nome) .' (OPÇÃO 1)'; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo) 
                         @if($cardapiosDiaAlmoco[0]->insumos_2_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_2_id" name="insumos_2_id" value="<?php echo strtoupper($insumo->nome) .' (OPÇÃO 2)'; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_3_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_3_id" name="insumos_3_id" value="<?php echo strtoupper($insumo->nome) .' (OPÇÃO 3)'; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                      </div>
                      <div class="form-row align-items-center">
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo) 
                         @if($cardapiosDiaAlmoco[0]->insumos_4_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo 'FEIJÃO: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_11_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_11_id" name="insumos_11_id" value="<?php echo 'FEIJÃO: '. $insumo->nome .' (OPÇÃO 2)'; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo) 
                         @if($cardapiosDiaAlmoco[0]->insumos_5_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_5_id" name="insumos_5_id" value="<?php echo 'ARROZ: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_6_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo 'MACARRÃO: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                      </div>
                      <div class="form-row align-items-center">
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo) 
                         @if($cardapiosDiaAlmoco[0]->insumos_7_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_7_id" name="insumos_7_id" value="<?php echo 'FAROFA: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_8_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_8_id" name="insumos_8_id" value="<?php echo 'REFRESCO: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_9_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_9_id" name="insumos_9_id" value="<?php echo 'SALADA: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        @foreach($insumos as $insumo)
                         @if($cardapiosDiaAlmoco[0]->insumos_10_id == $insumo->id)
                          <input readonly type="text" class="form-control form-control-sm" id="insumos_10_id" name="insumos_10_id" value="<?php echo 'SOBREMESA: '. $insumo->nome; ?>" style="font-weight: bold;" />
                         @endif
                        @endforeach
                       </div>
                       <div class="mx-sm-3 mb-2">
                        <img src="{{asset('storage')}}/{{$unidades[0]->caminho}}" height="60" width="150">
                        <img src="{{asset('storage/unidades/gestao.png')}}" height="60" width="150" style="margin-left: 140px">
                        <img src="{{asset('storage/foto_sus.jpg')}}" height="90" width="150" style="margin-left: 130px;">
                       </div>
                      </div>
                     </div>
                    </div>
                   </div>
                  </div> <br>
				          @if($cardapiosDiaAlmoco[0]->unidade_id == 6)
                    <button class="btn btn-success btn-md text-white aaa" data-bs-toggle="modal"
                          data-bs-target="#exampleModal2_<?php echo $cardapiosDiaAlmoco[0]->id; ?>" data-bs-whatever="@getbootstrap">
                      <strong>Avaliação <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                    </button>
                  </div>
                  <div class="modal fade" id="exampleModal2_<?php echo $cardapiosDiaAlmoco[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div>
                      <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                        Bem-vindo(a), este é um canal para você, integrante do HCP Gestão, expressar livremente seus
                        elogios, solicitações, reclamações, dúvidas, sugestões, críticas relacionadas ao Cardápio.
                      </p>
                      <p class="m-2 p-2 text-center">
                        Ao preencher esse formulário, garantimos a todos o direito de total sigilo. O Comitê será
                        responsável por apurar, avaliar e buscar soluções para as questões abordadas com muita ética e
                        profissionalismo, defendendo os interesses dos manifestantes e do HCP Gestão.
                      </p>
                     </div>
                     <div class="modal-body">
                      <form action="{{ route('questCardapio', $unidades[0]->id) }}" method="post">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <div class="border-bottom border-gray p-1">
                        <div class="d-flex justify-content-start">
                         <div class="col-6 col-sm-5">
                          <label for="recipient-name" class="col-form-label"><b>1) O que você achou do sabor das preparações? </b> <br>
                          &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta1" name="resposta1"> Bom &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="2" id="resposta1" name="resposta1"> Ruim &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="3" id="resposta1" name="resposta1"> Ótimo
                         </div>
                         <div class="col-5 col-sm-4">
                          <label for="recipient-name" class="col-form-label"><b>2) O que você achou do suco? </b> <br>
                          &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta2" name="resposta2"> Bom &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="2" id="resposta2" name="resposta2"> Ruim &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="3" id="resposta2" name="resposta2"> Ótimo
                         </div>
                        </div> <br><br>
                        <div class="d-flex justify-content-start">
                         <div class="col-6 col-sm-5">
                          <label for="recipient-name" class="col-form-label"><b>3) O que você achou da salada? </b> <br> 
                          &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta3" name="resposta3"> Bom &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="2" id="resposta3" name="resposta3"> Ruim &nbsp;&nbsp;
                          <input class="form-check-input" type="radio" value="3" id="resposta3" name="resposta3"> Ótimo
                         </div> 
                         <div class="col-6 col-sm-5">
                          <label for="recipient-name" class="col-form-label"><b>4) Críticas/Sugestões ou Elogios: </b> <br>
                          <textarea style="width: 280px" class="form-control" id="resposta4" name="resposta4" rows="5" cols="20" required></textarea>
                          <input hidden class="form-check-input" type="text" value="2" id="tipo_refeicao" name="tipo_refeicao">
                         </div> 
                        </div>
                       </div>
                      </div>
                       <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                      </form>
                    </div>
                  </div>
				          @endif
                </div> 
                @endif
                                          
                @if($qtdCDJA > 0)
                <div class="card border-0 m-3" style="width: 18rem;outline:none;">
                 <a class="btn btn-info btn-lg text-white" target="_blank">
                  <img src="{{ asset('/storage/cardapios/jantar.jpg') }}" width="180px" height="180px">
                 </a>
                 <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $cardapiosDiaJantar[0]->id; ?>">
                  <strong>Jantar <i class="bi bi-cup-hot-fill"></i></strong>
                 </button>
                 <div class="modal fade" id="exampleModal_<?php echo $cardapiosDiaJantar[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                   <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">CARDÁPIO DO DIA - JANTAR: <?php echo date('d/m/Y', strtotime($cardapiosDiaJantar[0]->dia)); ?></h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <div class="form-row align-items-center">
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_1_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumo_1" name="insumo_1" value="<?php echo strtoupper($insumo->nome); ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_2_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumo_2_id" name="insumo_2_id" value="<?php echo $insumo->nome . ' (OPÇÃO 1)'; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo)
                        @if($cardapiosDiaJantar[0]->insumos_3_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumo_3_id" name="insumo_3_id" value="<?php echo $insumo->nome . ' (OPÇÃO 2)'; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_4_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumo_4_id" name="insumo_4_id" value="<?php echo 'CAFÉ: '. $insumo->nome; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_5_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumo_5_id" name="insumo_5_id" value="<?php echo 'REFRESCO: ' .$insumo->nome; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_6_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo 'SOPA: ' .$insumo->nome; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_7_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumos_7_id" name="insumos_7_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       @foreach($insumos as $insumo) 
                        @if($cardapiosDiaJantar[0]->insumos_8_id == $insumo->id)
                         <input readonly type="text" class="form-control form-control-sm" id="insumos_8_id" name="insumos_8_id" value="<?php echo 'RECHEIO: ' .$insumo->nome; ?>" style="font-weight: bold;" />
                        @endif
                       @endforeach
                      </div>
                      <div class="mx-sm-3 mb-2">
                       <img src="{{asset('storage')}}/{{$unidades[0]->caminho}}" height="60" width="150">
                       <img src="{{asset('storage/unidades/gestao.png')}}" height="60" width="150" style="margin-left: 140px">
                       <img src="{{asset('storage/foto_sus.jpg')}}" height="90" width="150" style="margin-left: 130px;">
                      </div>
                     </div>
                    </div>
                   </div>
                  </div>
                 </div> <br>
				         @if($cardapiosDiaJantar[0]->unidade_id == 6)
                  <button class="btn btn-success btn-md text-white aaa" data-bs-toggle="modal"
                          data-bs-target="#exampleModal3_<?php echo $cardapiosDiaJantar[0]->id; ?>" data-bs-whatever="@getbootstrap">
                    <strong>Avaliação <i class="bi bi-chat-right-text" style="font-size:15px"></i></strong>
                  </button>
                 </div>
                 <div class="modal fade" id="exampleModal3_<?php echo $cardapiosDiaJantar[0]->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                   <div class="modal-content">
                    <div class="modal-header">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                   <div>
                   <p class="m-3 p-2 bg-secondary text-white text-center rounded">
                    Bem-vindo(a), este é um canal para você, integrante do HCP Gestão, expressar livremente seus
                    elogios, solicitações, reclamações, dúvidas, sugestões, críticas relacionadas ao Cardápio.
                   </p>
                   <p class="m-2 p-2 text-center">
                    Ao preencher esse formulário, garantimos a todos o direito de total sigilo. O Comitê será
                    responsável por apurar, avaliar e buscar soluções para as questões abordadas com muita ética e
                    profissionalismo, defendendo os interesses dos manifestantes e do HCP Gestão.
                   </p>
                  </div>
                  <div class="modal-body">
                   <form action="{{ route('questCardapio', $unidades[0]->id) }}" method="post">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="border-bottom border-gray p-1">
                     <div class="d-flex justify-content-start">
                      <div class="col-6 col-sm-5">
                       <label for="recipient-name" class="col-form-label"><b>1) O que você achou do sabor das preparações? </b> <br>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta1" name="resposta1"> Bom &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="2" id="resposta1" name="resposta1"> Ruim &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="3" id="resposta1" name="resposta1"> Ótimo
                      </div>
                      <div class="col-5 col-sm-4">
                       <label for="recipient-name" class="col-form-label"><b>2) O que você achou do suco? </b> <br>
                       &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta2" name="resposta2"> Bom &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="2" id="resposta2" name="resposta2"> Ruim &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="3" id="resposta2" name="resposta2"> Ótimo
                      </div>
                     </div>   <br><br>
                     <div class="d-flex justify-content-start">
                      <div class="col-6 col-sm-5">
                       <label for="recipient-name" class="col-form-label"><b>3) O que você achou da salada? </b> <br> 
                       &nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="radio" value="1" id="resposta3" name="resposta3"> Bom &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="2" id="resposta3" name="resposta3"> Ruim &nbsp;&nbsp;
                       <input class="form-check-input" type="radio" value="3" id="resposta3" name="resposta3"> Ótimo
                      </div> 
                      <div class="col-6 col-sm-5">
                       <label for="recipient-name" class="col-form-label"><b>4) Críticas/Sugestões ou Elogios: </b> <br>
                       <textarea style="width: 280px" class="form-control" id="resposta4" name="resposta4" rows="5" cols="20" required></textarea>
                       <input hidden class="form-check-input" type="text" value="3" id="tipo_refeicao" name="tipo_refeicao">
                      </div> 
                     </div>
                    </div>
                   </div>
                    <button type="submit" class="btn btn-success m-2" value="Salvar" id="Salvar" name="Salvar">Enviar</button>
                   </form>
                  </div>
                 </div>
				         @endif
                </div>
                @endif
          </div>
         </div>
        </div>
       </section>
      </div>
     </div>
    </section>
   </main>
  </body>
</html>
