@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<body>
@section('content')
  <main id="main" style="margin-top: -48px;">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Documentos da Qualidade - Detalhes</h2>
          <ol style="display: flex;">
            <li style="margin-right: 30px;"><a href="{{ url('/') }}">Home</a></li>
            <li>Documentos da Qualidade - Detalhes</li>
          </ol>
        </div>
      </div>
    </section>
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">          
          <div class="card card-body border-0">
            <p>
              @if($qtdDocs > 0)
                <a style="width:320px;" class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#documentosQualidade" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <b>Documentos da Qualidade</b> <img src="{{ asset('storage') }}/{{ 'arquivo.png' }}" alt="Imagem"  style="height: 40px; width: 40px;"/>
                </a>
              @endif
              @if($qtdProt > 0)
                <a style="width:320px;" class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#documentosInstitucionais" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <b>Documentos Institucionais</b> <img src="{{ asset('storage') }}/{{ 'arquivo.png' }}" alt="Imagem"  style="height: 40px; width: 40px;"/>
                </a>
              @endif
              @if($qtdPols > 0)
                <a style="width:320px;" class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#PoliticasNormas" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <b>Políticas e Normas</b> <img src="{{ asset('storage') }}/{{ 'arquivo.png' }}" alt="Imagem"  style="height: 40px; width: 40px;"/>
                </a>
              @endif
            </p>
            <!-- Documentos da Qualidade -->
            <div class="collapse border-0" id="documentosQualidade">
                <div class="card card-body border-0"> 
                    <div class="container">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                   @foreach($setores as $setor)
                                    @foreach($documentos as $documento)
                                     @if($documento->setor_id == $setor->id)
                                       <td colspan="3"><center><b>{{ $setor->setor }}</b></center></td> @break
                                     @endif
                                    @endforeach
                                   @endforeach
                                </tr>
                                <tr>
                                    <th scope="col">NOME</th>
                                    <th scope="col"><center>SIGLA</center></th>
                                    <th scope="col"><center>ACESSO</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentos as $documento)
                                    <tr>
                                        <td class="border border-right" title="<?php echo $documento->nome; ?>"><b>{{ substr($documento->nome, 0, 80) }} ...</b></td>
                                        <td class="border border-right" title="<?php echo $documento->sigla; ?>"><b><center>{{ $documento->sigla }}</center></b></td>
                                        <td class="border border-right">
                                          <center>
                                            <button title="{{ $documento->nome }}" class="btn btn-info m-1 btn-sm" onclick="exibirPDF({{ $documento->id }},'qualidade')" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $documento->id }}" data-bs-whatever="@getbootstrap">
                                              Abrir 
                                            </button> 
                                          </center>
                                        </td>
                                    </tr>
                                    <input hidden value="{{ asset('storage') }}/{{ $documento->caminho }}" width="100px" class="btn btn-sm btn-info" id="{{ $documento->id }}qualidade" name="{{ $documento->id }}" readonly />
                                    <div class="modal fade" id="exampleModal_{{ $documento->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="d-flex text-center justify-content-between flex-column">
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev{{ $documento->id }}qualidade">Página anterior
                                                  </button>
                                                </div>
                                                <div class="d-flex flex-column m-1">
                                                    @if($documento->imprimir == 1)
                                                      <a style="font-size:20px" href="{{asset('storage')}}/{{$documento->caminho}}" download="{{$documento->nome}}.pdf"><b>Baixar Documento</b></a>
                                                    @endif
                                                    <span>Page: <span id="page_num{{ $documento->id }}qualidade"></span> /
                                                    <span id="page_count{{ $documento->id }}qualidade"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next{{ $documento->id }}qualidade">Próxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                              <canvas id="pdf-exemplo{{ $documento->id }}qualidade"></canvas>
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev_{{ $documento->id }}qualidade">
                                                    Página anterior</button>
                                                </div>
                                                <div class="m-1">
                                                  <span>Page: <span id="page_num_{{ $documento->id }}qualidade"></span>
                                                    / <span id="page_count_{{ $documento->id }}qualidade"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next_{{ $documento->id }}qualidade">Proxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                            </div>
                                            <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Documentos Institucionais -->
            <div class="collapse border-0" id="documentosInstitucionais">
                <div class="card card-body border-0">
                    <div class="container">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                   @foreach($setores as $setor)
                                    @foreach($protocolos as $protocolo)
                                     @if($protocolo->setor_id == $setor->id)
                                    <td colspan="3"><center><b>{{ $setor->setor }}</b></center></td> @break
                                     @endif
                                    @endforeach
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="col">NOME</th>
                                    <th scope="col"><center>SIGLA</center></th>
                                    <th scope="col"><center>ACESSO</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($protocolos as $protocolo)
                                    <tr>
                                        <td class="border border-right" title="<?php echo $protocolo->nome; ?>"><b>{{ substr($protocolo->nome, 0, 80) }} ...</b></td>
                                        <td class="border border-right" title="<?php echo $protocolo->sigla; ?>"><b><center>{{ $protocolo->sigla }}</center></b></td>
                                        <td class="border border-right">
                                          <center>
                                            <a title="{{ $protocolo->nome }}" class="btn btn-info m-1 btn-sm" onclick="exibirPDF({{ $protocolo->id }},'protocolo')" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $protocolo->id }}I" data-bs-whatever="@getbootstrap">
                                              Abrir 
                                            </a> 
                                          </center>
                                        </td>
                                    </tr>
                                    <input hidden value="{{ asset('storage') }}/{{ $protocolo->caminho }}" width="100px" class="btn btn-sm btn-info" id="{{ $protocolo->id }}protocolo" name="{{ $protocolo->id }}" readonly />
                                    <div class="modal fade" id="exampleModal_{{ $protocolo->id }}I" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="d-flex text-center justify-content-between flex-column">
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev{{ $protocolo->id }}protocolo">Página anterior
                                                  </button>
                                                </div>
                                                <div class="d-flex flex-column m-1">
                                                  @if($protocolo->imprimir == 1)
                                                  <a style="font-size:20px" href="{{asset('storage')}}/{{$protocolo->caminho}}" download="{{$protocolo->nome}}.pdf"><b>Baixar Documento</b></a>
                                                  @endif
                                                  <span>Page: <span id="page_num{{ $protocolo->id }}protocolo"></span> /
                                                    <span id="page_count{{ $protocolo->id }}protocolo"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next{{ $protocolo->id }}protocolo">Próxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                              <canvas id="pdf-exemplo{{ $protocolo->id }}protocolo"></canvas>
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev_{{ $protocolo->id }}protocolo">
                                                    Página anterior</button>
                                                </div>
                                                <div class="m-1">
                                                  <span>Page: <span id="page_num_{{ $protocolo->id }}protocolo"></span>
                                                    / <span id="page_count_{{ $protocolo->id }}protocolo"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next_{{ $protocolo->id }}protocolo">Proxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                            </div>
                                            <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Políticas e Normas -->
            <div class="collapse border-0" id="PoliticasNormas">
                <div class="card card-body border-0">
                    <div class="container">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                   @foreach($setores as $setor)
                                    @foreach($politicas as $politica)
                                     @if($politica->setor_id == $setor->id)
                                    <td colspan="3"><center><b>{{ $setor->setor }}</b></center></td> @break
                                     @endif
                                    @endforeach
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="col">NOME</th>
                                    <th scope="col"><center>SIGLA</center></th>
                                    <th scope="col"><center>ACESSO</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($politicas as $politica)
                                    <tr>
                                        <td class="border border-right" title="<?php echo $politica->nome; ?>"><b>{{ substr($politica->nome, 0, 80) }} ...</b></td>
                                        <td class="border border-right" title="<?php echo $politica->sigla; ?>"><b><center>{{ $politica->sigla }}</center></b></td>
                                        <td class="border border-right">
                                          <center>
                                            <a title="{{ $politica->nome }}" class="btn btn-info m-1 btn-sm"  onclick="exibirPDF({{ $politica->id }},'politica')" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $politica->id }}P" data-bs-whatever="@getbootstrap">
                                              Abrir
                                            </a>
                                          </center>
                                        </td>
                                    </tr>
                                    <input hidden value="{{ asset('storage') }}/{{ $politica->caminho }}" width="100px" class="btn btn-sm btn-info" id="{{ $politica->id }}politica" name="{{ $politica->id }}" readonly />
                                    <div class="modal fade" id="exampleModal_{{ $politica->id }}P" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="d-flex text-center justify-content-between flex-column">
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev{{ $politica->id }}politica">Página anterior
                                                  </button>
                                                </div>
                                                <div class="d-flex flex-column m-1">
                                                  @if($politica->imprimir == 1)
                                                    <a style="font-size:20px" href="{{asset('storage')}}/{{$politica->caminho}}" download="{{$politica->nome}}.pdf"><b>Baixar Documento</b></a>
                                                  @endif
                                                  <span>Page: <span id="page_num{{ $politica->id }}politica"></span> /
                                                    <span id="page_count{{ $politica->id }}politica"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next{{ $politica->id }}politica">Próxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                              <canvas id="pdf-exemplo{{ $politica->id }}politica"></canvas>
                                              <div class="d-flex justify-content-between">
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="prev_{{ $politica->id }}politica">
                                                    Página anterior</button>
                                                </div>
                                                <div class="m-1">
                                                  <span>Page: <span id="page_num_{{ $politica->id }}politica"></span>
                                                    / <span id="page_count_{{ $politica->id }}politica"></span></span>
                                                </div>
                                                <div class="m-1">
                                                  <button class="btn btn-info" id="next_{{ $politica->id }}politica">Proxima
                                                    página</button>
                                                  &nbsp; &nbsp;
                                                </div>
                                              </div>
                                            </div>
                                            <script src="{{ asset('assets/vendor/jquery/jquery-3.6.0.js') }}"></script>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
          <center> <a href="{{ route('documentosSetores', array($id, $id_u)) }}" class="btn btn-sm btn-warning">VOLTAR</a> </center>
        </div> 
      </div>
    </div>
   </section>
  </main>
  
  <script src="{{ asset('assets/js/pdf.js') }}"></script>
  <script type="text/javascript">
    function exibirPDF(val,doc) {

      var valoratual = val;
	    var idDoc = valoratual + doc;	
      var url_atual = document.getElementById(idDoc).value
      var url = url_atual;
      var pdfjsLib = window['pdfjs-dist/build/pdf'];
      pdfjsLib.GlobalWorkerOptions.workerSrc = "{{asset('assets/js/pdf.worker.js') }}";
      var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 2,
        canvas = document.getElementById('pdf-exemplo' + idDoc),
        ctx = canvas.getContext('2d');

	
      function renderPage(num) {
        pageRendering = true;

        pdfDoc.getPage(num).then(function(page) {
          var viewport = page.getViewport({
            scale: scale
          });
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          var renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };
          var renderTask = page.render(renderContext);

          renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
              renderPage(pageNumPending);
              pageNumPending = null;
            }
          });
        });

        console.log(document.getElementById('page_num' + idDoc).textContent = num);
        document.getElementById('page_num_' + idDoc).textContent = num;
		
      }

      function queueRenderPage(num) {
        if (pageRendering) {
          pageNumPending = num;
        } else {
          renderPage(num);
        }
      }

      /**
       * mostra a página anterior
       */
      function onPrevPage() {
        if (pageNum <= 1) {
          return;
        }
        pageNum--;
        queueRenderPage(pageNum);
      }
      document.getElementById('prev' + idDoc).addEventListener('click', onPrevPage);

      function onPrevPage2() {
        if (pageNum <= 1) {
          return;
        }
        pageNum--;
        queueRenderPage(pageNum);
      }
      document.getElementById('prev_' + idDoc).addEventListener('click', onPrevPage2);

      /**
       * mostra a proxima página
       */
      function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
          return;
        }
        pageNum++;
        queueRenderPage(pageNum);
      }
      document.getElementById('next' + idDoc).addEventListener('click', onNextPage);

      function onNextPage2() {
        if (pageNum >= pdfDoc.numPages) {
          return;
        }
        pageNum++;
        queueRenderPage(pageNum);
      }
      document.getElementById('next_' + idDoc).addEventListener('click', onNextPage2);

      /**
       * Download assincrono do PDF.
       */
      pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count' + idDoc).textContent = pdfDoc.numPages;
        document.getElementById('page_count_' + idDoc).textContent = pdfDoc.numPages;
        renderPage(pageNum);
      });
    }
  </script>
    
  <SCRIPT LANGUAGE="JavaScript1.2">
    function alerta() {
      alert('Você não tem permissão.');
      return false;
    }

    function verificaBotao(oEvent) {
      var oEvent = oEvent ? oEvent : window.event;
      var tecla = (oEvent.keyCode) ? oEvent.keyCode : oEvent.which;
      if (tecla == 17 || tecla == 44 || tecla == 106) {
        alerta();
      }
    }
  </SCRIPT>
  <SCRIPT LANGUAGE="JavaScript1.2">
    document.onkeypress = verificaBotao;
    document.onkeydown = verificaBotao;
    document.oncontextmenu = alerta;
  </script>

  <style>
    #pdf-exemplo {
      border: 1px solid black;
      border-radius: 10px;
      width: 100%;
    }
  </style>
  @endsection
</body>
</html>
