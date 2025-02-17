@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>	
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<body onselectstart="return false">
    <main id="main">
      <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-start align-items-center">
            <i class="bi bi-person-workspace" style="font-size:30px"> Acidente de Trabalho</i>
          </div>
        </div>
      </section>
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            @if ($error == 'Indicador de Acidente Cadastrado com Sucesso!')
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
        <section id="portfolio-details" class="portfolio-details">
          <div class="container">
            <div class="row gy-4">
              <div class="border-bottom border-gray p-1">
                <div class="d-flex justify-content-between">
                  <div class="m-2 col-12">
                    <p align="justify">
                      <b>
                        <font size="3">A legislação brasileira que trata de acidentes de trabalho é ampla e regulamentada principalmente pela Consolidação das Leis do Trabalho (CLT) e pela Lei nº 8.213/1991, que institui os benefícios da Previdência Social. Aqui estão os principais dispositivos:</font>
                      </b>
                    </p>
                  </div>
                </div>
              </div>
              <div id="tabs" class="nav-tabs">
                <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#tabs1" role="tab" aria-selected="true">Definição de Acidente de Trabalho</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabs2" role="tab" aria-selected="false">Normas Regulamentadoras (NRs)</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabs3" role="tab" aria-selected="false">Comunicação de Acidente de Trabalho (CAT)</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tabs4" role="tab" aria-selected="false">Penalidades</a>
                  </li>
                </ul>
                <div class="tab-content mb-4" id="pills-tabContent"> 
                  <div class="tab-pane fade show active" id="tabs1">
                    <div class="modal-content">
                      <div class="modal-header">
                        <center><h6 class="modal-title"id="exampleModalLongTitle"><b>1. Definição de Acidente de Trabalho (Lei nº 8.213/1991, Art. 19):</b></h6></center>
                      </div>
                      <div class="modal-body" style="background-color: white;">
                        <div class="row">
                          <div class="col">
                            <font size="3">
                              <p align="justify">
                                Acidente de trabalho é aquele que ocorre pelo exercício do trabalho, causando lesão corporal ou perturbação funcional que leve à morte, perda ou redução da capacidade para o trabalho, de forma permanente ou temporária. <br><br>
                                Incluem-se também como acidente de trabalho: <br><br>
                                Doença profissional: Decorrente diretamente das condições do trabalho. <br><br>
                                Doença do trabalho: Resultante de condições especiais em que o trabalho é realizado (Art. 20 da mesma lei). <br><br>
                                Acidente de trajeto: Acontecido no percurso entre a residência do trabalhador e o local de trabalho (até 2019, mas atualmente este direito foi retirado na Reforma da Previdência para fins de benefícios acidentários).
                              </p>
                            </font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs2">
                    <div class="modal-content">
                      <div class="modal-header">
                        <center><h6 class="modal-title"id="exampleModalLongTitle"><b>2. Normas Regulamentadoras (NRs):</b></h6></center>
                      </div>
                      <div class="modal-body" style="background-color: white;">
                        <div class="row">
                          <div class="col">
                            <font size="3">
                              O Ministério do Trabalho e Emprego (MTE) regula as condições de segurança e saúde no trabalho por meio das Normas Regulamentadoras (NRs), como: <br><br>
                              NR-4: Serviços Especializados em Engenharia de Segurança e Medicina do Trabalho (SESMT). <br><br>
                              NR-5: Comissão Interna de Prevenção de Acidentes (CIPA). <br><br>
                              NR-6: Equipamentos de Proteção Individual (EPI). <br><br>
                              NR-9: Programa de Prevenção de Riscos Ambientais (PPRA), que agora se integra ao Programa de Gerenciamento de Riscos (PGR). <br><br>
                              NR-17: Ergonomia, para prevenção de doenças ocupacionais.
                            </font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs3">
                    <div class="modal-content">
                      <div class="modal-header">
                        <center><h6 class="modal-title"id="exampleModalLongTitle"><b>3. Comunicação de Acidente de Trabalho (CAT):</b></h6></center>
                      </div>
                      <div class="modal-body" style="background-color: white;">
                        <div class="row">
                          <div class="col">
                            <font size="3">
                              A empresa tem a obrigação de emitir a Comunicação de Acidente de Trabalho (CAT) para o INSS: <br><br>
                              Deve ser feita até o primeiro dia útil seguinte ao acidente. <br><br>
                              Em caso de morte, a comunicação deve ser imediata às autoridades competentes. <br><br>
                              Se a empresa não emitir a CAT, o próprio trabalhador, dependente, médico ou sindicato pode fazê-lo.
                            </font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tabs4">
                    <div class="modal-content">
                      <div class="modal-header">
                        <center><h6 class="modal-title"id="exampleModalLongTitle"><b>4. Penalidades:</b></h6></center>
                      </div>
                      <div class="modal-body" style="background-color: white;">
                        <div class="row">
                          <div class="col">
                            <font size="3">
                              A negligência na proteção contra acidentes pode levar: <br><br>
                              Multas administrativas (CLT, Art. 201). <br><br>
                              Indenizações civis por danos morais, materiais e estéticos. <br><br>
                              Responsabilidade criminal, caso configurado dolo ou culpa grave.
                            </font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <center>
              <a class="btn btn-warning btn-sm" href="{{ route('areaColaborador') }}" id="Voltar" name="Voltar" style="color: #FFFFFF;"> VOLTAR </a>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <a class="btn btn-success btn-sm" href="{{ route('indicadorAcidente') }}" id="Salvar" name="Salvar">CADASTRAR</a>
            </center>
          </div>
        </section>
  </main>
</body>
</html>