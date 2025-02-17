@extends('navbar.default-navbar')
@section('content')
     <link href="{{ asset('css/farmacia.css') }}" rel="stylesheet">
        @if($topicoSelecionado == Null)
        <div class="container-fluid mt-2" style="color: #28a745">
           <div class="row p-5"> 
            <div class="col-md-12 text-center">
            <a href="{{ route('unidade', 7) }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
              <br><br> 
            </div>
              <div class="book">
                <div class="front">
                  <div class="cover">
                    <p class="num-up"></p>
                    <p class="author">Manual <br>Farmacêutico</p>
                    <img class="logo"
                      src="{{asset('storage/manual/saoSebastiao.png')}}"
                      alt="Logo do hospital São sebastião">
                    <svg class="logoMedicamentos" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 117.4"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>pharma</title><path class="cls-1" d="M120.8,40A19.29,19.29,0,0,1,87.64,59.55L120.8,40ZM36.6,10A20.07,20.07,0,0,1,63.94,2.67h0A20.08,20.08,0,0,1,71.26,30c-11.38,19.7-22.73,39.21-34.1,58.92h0A20,20,0,0,1,10,96.22h0A20,20,0,0,1,2.66,69h0C14,49.28,25.2,29.73,36.6,10ZM47.89,61.55,21.17,46.13,6.67,71.24h0a15.5,15.5,0,0,0,5.64,21.08h0a15.48,15.48,0,0,0,21.08-5.65h0l14.5-25.12ZM90.31,89.4A19.29,19.29,0,0,1,63.76,115a19,19,0,0,1-6.61-6L90.31,89.4Zm-34.06-.63a19.27,19.27,0,0,1,26.2-7.52,19,19,0,0,1,6.23,5.49L55.63,106.22a19.16,19.16,0,0,1,.62-17.45ZM86.74,39.36a19.29,19.29,0,0,1,32.44-2L86.11,56.83a19.3,19.3,0,0,1,.63-17.47Z"/></svg>
                  </div>
                </div>
                <div class="left-side">
                  <h2>
                    <span>Manuais</span>
                    <span>HOSPITAL SÃO SEBASTIÃO</span>
                  </h2>
                </div>
              </div>
          </div>
         </div>
        </div>
        @else
          <div class="container-fluid mt-2">
            <div class="row p-3"> 
              <div class="col-md-12 text-center"> 
               <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
              <br><br> 
              @if($qtd > 0)
              <b>{{ $topicoSelecionado[0]->titulo }}</b> <br><br>
               @if($topicoSelecionado[0]->tipo_doc == 1)
                <iframe
                  src="{{ asset('storage')}}/{{$topicoSelecionado[0]->caminho}}"
                  frameborder="0"
                  scrolling="auto"
                  overflow-y: scroll
                  height="600px"
                  width="100%">
                </iframe>
               @else 
                  <div>
                    <div class="book">
                      <div class="front">
                        <div class="cover">
                          <p class="num-up"></p>
                          <p class="author">Manual <br>Farmacêutico</p>
                            <img class="logo"
                                 src="{{asset('storage/manual/saoSebastiao.png')}}"
                                 alt="Logo do hospital São sebastião">
                            <svg class="logoMedicamentos" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 117.4"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>pharma</title><path class="cls-1" d="M120.8,40A19.29,19.29,0,0,1,87.64,59.55L120.8,40ZM36.6,10A20.07,20.07,0,0,1,63.94,2.67h0A20.08,20.08,0,0,1,71.26,30c-11.38,19.7-22.73,39.21-34.1,58.92h0A20,20,0,0,1,10,96.22h0A20,20,0,0,1,2.66,69h0C14,49.28,25.2,29.73,36.6,10ZM47.89,61.55,21.17,46.13,6.67,71.24h0a15.5,15.5,0,0,0,5.64,21.08h0a15.48,15.48,0,0,0,21.08-5.65h0l14.5-25.12ZM90.31,89.4A19.29,19.29,0,0,1,63.76,115a19,19,0,0,1-6.61-6L90.31,89.4Zm-34.06-.63a19.27,19.27,0,0,1,26.2-7.52,19,19,0,0,1,6.23,5.49L55.63,106.22a19.16,19.16,0,0,1,.62-17.45ZM86.74,39.36a19.29,19.29,0,0,1,32.44-2L86.11,56.83a19.3,19.3,0,0,1,.63-17.47Z"/></svg>
                        </div>
                      </div>
                      <div class="left-side">
                        <h2>
                          <span>Manuais</span>
                          <span>HOSPITAL SÃO SEBASTIÃO</span>
                        </h2>
                      </div>
                    </div>
                  </div>
                </div>
               @endif
              @endif
              @if($qtd2 > 0)
              <div><b>{{ $topicoSelecionado2[0]->titulo }}</b></div><br><br>
               @if($topicoSelecionado2[0]->tipo_doc == 1)
                <iframe
                  src="{{ asset('storage')}}/{{$topicoSelecionado2[0]->caminho}}"
                  frameborder="0"
                  scrolling="auto"
                  overflow-y: scroll
                  height="600px"
                  width="100%">
                </iframe>
               @else 
                <div>
                 <div class="book">
                  <div class="front">
                    <div class="cover">
                      <p class="num-up"></p>
                      <p class="author">Manual <br>Farmacêutico</p>
                        <img class="logo"
                             src="{{asset('storage/manual/saoSebastiao.png')}}"
                             alt="Logo do hospital São sebastião">
                        <svg class="logoMedicamentos" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 117.4"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>pharma</title><path class="cls-1" d="M120.8,40A19.29,19.29,0,0,1,87.64,59.55L120.8,40ZM36.6,10A20.07,20.07,0,0,1,63.94,2.67h0A20.08,20.08,0,0,1,71.26,30c-11.38,19.7-22.73,39.21-34.1,58.92h0A20,20,0,0,1,10,96.22h0A20,20,0,0,1,2.66,69h0C14,49.28,25.2,29.73,36.6,10ZM47.89,61.55,21.17,46.13,6.67,71.24h0a15.5,15.5,0,0,0,5.64,21.08h0a15.48,15.48,0,0,0,21.08-5.65h0l14.5-25.12ZM90.31,89.4A19.29,19.29,0,0,1,63.76,115a19,19,0,0,1-6.61-6L90.31,89.4Zm-34.06-.63a19.27,19.27,0,0,1,26.2-7.52,19,19,0,0,1,6.23,5.49L55.63,106.22a19.16,19.16,0,0,1,.62-17.45ZM86.74,39.36a19.29,19.29,0,0,1,32.44-2L86.11,56.83a19.3,19.3,0,0,1,.63-17.47Z"/></svg>
                    </div>
                  </div>
                  <div class="left-side">
                    <h2>
                      <span>Manuais</span>
                      <span>HOSPITAL SÃO SEBASTIÃO</span>
                    </h2>
                  </div>
                 </div>
                </div>
               </div>
               @endif
              @endif
              </div>
            </div>
        @endif
@endsection
