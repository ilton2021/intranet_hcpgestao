@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          @if($id == 1)
          <h2>Ouvidaria das Unidades - Detalhes</h2>
          @elseif($id == 2)
		  <div class="d-inline-flex">
		  <div class="m-2">
          <h2>Indicadores </h2>
		  </div>
		   <div class="">
		  <img class="card-img-top" src="{{asset('storage')}}/{{('weknow.png')}}" style="width: 150px;";" alt="Card image cap">
		  </div>
		  </div>
          @elseif($id == 3)
            <h2>Ramais / E-mails - Detalhes</h2>
          @elseif($id == 4)
            <h2>Documentos da Qualidade - Detalhes</h2>
          @elseif($id == 6)
            <h2>Políticas e Normas - Detalhes</h2>
          @elseif($id == 7)
            <h2>Canal de Denúncias - Detalhes</h2>
          @endif
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            @if($id == 1)
             <li>Ouvidaria das Unidades - Detalhes</li>
            @elseif($id == 2)
              <li>Indicadores - Detalhes</li>
            @elseif($id == 3)
              <li>Ramais / E-mails - Detalhes</li>
            @elseif($id == 4)
              <li>Documentos da Qualidade - Detalhes</li>
            @elseif($id == 6)
              <li>Políticas e Normas - Detalhes</li>
            @elseif($id == 7)
              <li>Canal de Denúncias - Detalhes</li>
            @endif
          </ol>
        </div>
      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div>
            @if($id == 1) <br><br><br><br>
            <p align="justify">
              @foreach($ouvidorias as $ouvidoria)
              {{ $ouvidoria->nome }}: <b>{{ $ouvidoria->email }}</b> <BR><BR>
              @endforeach
            </p>
            @elseif($id == 2)
            <!--p align="justify">
              Você precisa fazer Login para visualizar os Indicadores: <br><br>
              <a href="{{ route('telaLoginIndicador') }}" class="btn btn-sm btn-info">Fazer Login</a>
            </p-->

			<div class="d-inline-flex justify-content-between flex-wrap">
			 <div class="card border-0 m-2" style="width: 14rem;outline:none;" >
			  <a href="http://10.0.0.101/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-hmr.png')}}" style="width:150px" alt="Card image cap">
			  </a>
			   <div class="card-body">
					 <h5 class="card-title">HMR</h5>
			   </div>
			</div>
			
			<div class="card border-0 m-2" style="width: 14rem;outline:none;" >
			  <a href="http://10.3.0.30" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-hss.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
					 <h5 class="card-title">HSS</h5>
			   </div>
			</div>

			<div class="card border-0 m-2" style="width: 14rem;outline:none;" >
			  <a href="http://10.1.0.8/" target="_blank">
				  <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-ARRUDA.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
					 <h5 class="card-title">UPAE ARRUDA</h5>
			   </div>
			</div>

			<div class="card border-0 m-2" style="width: 14rem;outline:none;" >
			  <a href="http://192.168.0.90/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-BJ.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
					 <h5 class="card-title">UPAE BELO JARDIM</h5>
			   </div>
			</div>

			<div class="card border-0 m-3" style="width: 14rem;outline:none;" >
			  <a href="http://192.168.1.114/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-ARCO.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
					 <h5 class="card-title">UPAE ARCOVERDE</h5>
			   </div>
			</div>

			<div class="card border-0 m-3" style="width: 14rem;outline:none;" >
			  <a href="http://192.168.12.50/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-caruaru-upae.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
					 <h5 class="card-title">UPAE CARUARU</h5>
			   </div>
			</div>

			<div class="card border-0 m-3" style="width: 14rem;outline:none;" >
			  <a href="http://11.2.0.16/#/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo_igarassu.png')}}" style="width:150px" alt="Card image cap">
				</a>
			   <div class="card-body">
				   <h5 class="card-title">UPA IGARASSU</h5>
			   </div>
			</div>

      <div class="card border-0 m-3" style="width: 14rem;outline:none;">
        <a href="http://10.10.0.8/#/login/" target="_blank">
          <img class="card-img-top" src="{{asset('storage/logos')}}/{{('logo-UPAE-PALMARES.png')}}" style="width:150px" alt="Card image cap">
        </a>
         <div class="card-body">
           <h5 class="card-title">UPAE PALMARES
         </div>
      </div>

			</div>
            @elseif($id == 3)
            <p align="justify">
             <table class="table">
              <tr>
                <thead>
                  <th>UNIDADES:</th>
                  <th>RAMAIS:</th>
                  <th>E-MAILS:</th>
                </thead>
                @foreach($unidades as $unidade)
              <tr>
                <td>
                  {{ $unidade->nome }}
                </td>
                <td title="<?php echo $unidade->nome; ?>"><a href="{{ route('ramaisUnidade', $unidade->id) }}" class="btn btn-sm btn-success">RAMAL</a></td>
                <td title="<?php echo $unidade->nome; ?>"><a href="{{ route('emailsUnidade', $unidade->id) }}" class="btn btn-sm btn-success">EMAIL</a></td>
              </tr>
              @endforeach
              </tr>
             </table>
            </p>
            @elseif($id == 4)
            <center>
            <h4 class="text-center">Selecione uma Opção:</h4> <br>
            <div class="d-inline-flex justify-content-between flex-wrap">
                <div class="col-4"> <br>
                  <div class="portfolio-wrap">
                    <div class="portfolio-info">
                      <center>
                        <img src="{{ asset('storage') }}/{{ 'documentos.jpg' }}" alt="Imagem"  style="height: 250px; width: 180px;"/>
                        <h5><a href="{{ route('documentosUnidades', 1) }}" title="">Documentos da Qualidade</a></h5>
                      </center>
                    </div>
                  </div>
                </div>
                <div class="col-4"> <br>
                  <div class="portfolio-wrap">
                    <div class="portfolio-info">
                      <center>
                        <img src="{{ asset('storage') }}/{{ 'protocolo.jpg' }}" alt="Imagem"  style="height: 250px; width: 180px;"/>
                        <h5> <a href="{{ route('documentosUnidades', 2) }}" title="">Documentos Institucionais</a></h5>
                      </center>
                    </div>
                  </div>
                </div>
                <div class="col-4"> <br>
                  <div class="portfolio-wrap">
                    <div class="portfolio-info">
                      <center> 
                        <img src="{{ asset('storage/politica.jpg') }}" alt="Imagem.."  style="height: 273px; width: 190px;"/>
                        <h5><a href="{{ route('documentosUnidades', 3) }}" title="">Políticas e Normas</a></h5>
                      </center>
                    </div>
                  </div>
                </div>
            </div>
            </center>
            @elseif($id == 6)

            @elseif($id == 7)
             <section class="cards">
              <div class="d-flex flex-column justify-content-center p-1 text-center">
								<div class="row">
								 <div class="col">
									<div class="d-flex flex-column" style="font-size:15px;">
										<label><center><img src="{{ asset('img/denuncias.jpg') }}" style="width:400px; margin-top: 40px;" /><center></label> <br>
										<a class="btn btn-success btn-sm" target="_blank" style="color: #FFFFFF;" href="https://canaldedenuncia.com.br/hcpgestao/#home"> Denunciar <i class="fas fa-check"></i> </a>
									</div>
								 </div>
								 <div class="col">
									<div class="d-flex flex-column" style="font-size:15px;">
										<label><p align="justify"><font color="black"><b>"O canal de denúncia do HCP Gestão é um canal exclusivo e que garante uma comunicação segura
												e, se desejada, anônima, de condutas que violem as leis vigentes, os princípios éticos, as
												normas, políticas e padrões de conduta da nossa Organização.</b></font></p></label>
										<label><p align="justify"><font color="black"><b>O canal pode ser utilizado por nossos colaboradores e por pessoas externas à companhia, 
											   tais como clientes, fornecedores, parceiros de negócios, entre outros, que acreditem que 
											   ocorreu ou possa estar ocorrendo alguma violação ao Código de Conduta do HCP GESTÃO.</b></font></p></label>
										<label><p align="justify"><font color="black"><b>As informações registradas pelo Canal de Denúncia serão recebidas por uma empresa 
												independente e especializada, a Aliant, assegurando sigilo absoluto e o tratamento 
												adequado de cada situação pelo Comitê de Ética | HCP GESTÃO, sem conflitos de 
												interesses."</b></font></p></label>
									</div>
								 </div>
								</div>
							</div>
             </section>
            @endif
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



</body>

</html>
