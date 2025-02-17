@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}" />

<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2 title="<?php echo $destaSelect[0]->titulo; ?>">{{ substr($destaSelect[0]->titulo, 0, 80)  }}</h2>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Eventos Detalhes</li>
          </ol>
        </div>
      </div>
    </section>
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper d-flex justify-content-center align-items-center">
                <div class="text-center" style="max-height:350px;">
                  @if($destaSelect[0]->caminho !== "")
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho}}" alt="" style="max-height:350px;" alt="">
                  @else
                  <iframe class="rounded" width="527" height="300" src="{{$destaSelect[0]->video}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  @endif
                </div>
              </div>
              <div class="m-4"></div>
              <div>
                <p align="justify">
                  {{ $destaSelect[0]->texto }}
                </p>
              </div>

              <div>
                @if($destaSelect[0]->tipo2 == 2)
                <p align="justify">
                  <iframe class="rounded" width="550" height="300" src="{{$destaSelect[0]->video2}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </p>
                @else
                @if($destaSelect[0]->caminho2 !== "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho2}}" alt="Foto2" title="Foto2">
                </p>
                @endif
                @endif

                @if($destaSelect[0]->tipo3 == 2)
                <p align="justify">
                  <iframe class="rounded" width="550" height="300" src="{{$destaSelect[0]->video3}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </p>
                @else
                @if($destaSelect[0]->caminho3 !== "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho3}}" alt="Foto3" title="Foto3">
                </p>
                @endif
                @endif

                @if($destaSelect[0]->tipo4 == 2)
                <p align="justify">
                  <iframe class="rounded" width="550" height="300" src="{{$destaSelect[0]->video4}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </p>
                @else
                @if($destaSelect[0]->caminho4 !== "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho4}}" alt="Foto4" title="Foto4">
                </p>
                @endif
                @endif

                @if($destaSelect[0]->tipo5 == 2)
                <p align="justify">
                  <iframe class="rounded" width="550" height="300" src="{{$destaSelect[0]->video5}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </p>
                @else
                @if($destaSelect[0]->caminho5 !== "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho5}}" alt="Foto5" title="Foto5">
                </p>
                @endif
                @endif

                @if($destaSelect[0]->tipo6 == 2)
                <p align="justify">
                  <iframe class="rounded" width="550" height="300" src="{{$destaSelect[0]->video6}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </p>
                @else
                @if($destaSelect[0]->caminho6 !== "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho6}}" alt="Foto6" title="Foto6">
                </p>
                @endif
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="portfolio-info">
              <h3>
                <font color="green">Mais Eventos</font>
              </h3>
              @foreach($destaques as $destaque)
              <?php $data_a = date('d-m-Y', strtotime('now'));
              $data_f = date('d-m-Y', strtotime($destaque->data_fim));
              $data_i = date('d-m-Y', strtotime($destaque->data_inicio));
              ?>
              @if((strtotime($data_a) >= strtotime($data_i)) && (strtotime($data_a) <= strtotime($data_f))) <ul>
                <li><strong>
                    <p align="justify">
                      <font size="2"><a href="{{ route('destaquesDetalhes', array($und_atual,$destaque->id)) }}" title="<?php echo $destaque->titulo; ?>">{{ substr($destaque->titulo,0,70) }}</a></font>
                    </p>
                  </strong>
                  <img src="{{asset('img')}}/{{('calendar.png')}}" width="30" />
                  <font size="2">{{ date('d/m/Y', strtotime($destaque->created_at)) }} </font>
                </li>
                </ul>
                @endif
              @endforeach
            </div>
          </div>
        </div>
    </section>
  </main>

</body>

</html>