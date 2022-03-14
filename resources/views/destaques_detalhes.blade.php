@extends('layouts.app')

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
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho}}" alt="" width="150px">
                </div>
              </div>
              <div class="col-lg-6"> </div>
              <div> <br><br><br>
                <p align="justify">
                  {{ $destaSelect[0]->texto }}
                </p>
              </div>
              <div>
                @if($destaSelect[0]->imagem2 != "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho2}}" alt="">
                </p>
                @endif
                @if($destaSelect[0]->imagem3 != "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho3}}" alt="">
                </p>
                @endif
                @if($destaSelect[0]->imagem4 != "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho4}}" alt="">
                </p>
                @endif
                @if($destaSelect[0]->imagem5 != "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho5}}" alt="">
                </p>
                @endif
                @if($destaSelect[0]->imagem6 != "")
                <p align="justify">
                  <img src="{{asset('storage')}}/{{$destaSelect[0]->caminho6}}" alt="">
                </p>
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
              <ul>
                <li><strong>
                    <p align="justify">
                      <font size="2"><a href="{{ route('destaquesDetalhes', array($und_atual,$destaque->id)) }}" title="<?php echo $destaque->titulo; ?>">{{ substr($destaque->titulo,0,70) }}</a></font>
                    </p>
                  </strong>
                  <img src="{{asset('img')}}/{{('calendar.png')}}" width="30" />
                  <font size="2">{{ date('d/m/Y', strtotime($destaque->created_at)) }} </font>
                </li>
              </ul>
              @endforeach
            </div>
          </div>
        </div>
    </section>
  </main>

</body>

</html>