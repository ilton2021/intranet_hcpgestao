@extends('layouts.app')
<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2 title="<?php echo $murais[0]->titulo; ?>">{{ substr($murais[0]->titulo, 0, 80)  }}</h2>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Mural de Avisos Detalhes</li>
          </ol>
        </div>
      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-12">
          <div class="col-lg-6">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  @foreach($murais as $mural)
                    <a href="{{asset('storage')}}/{{$mural->caminho}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $mural->titulo; ?>"><img src="{{asset('storage')}}/{{$mural->caminho}}" class="img-fluid" alt=""></a>
                  @endforeach
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-6"> 
            <div class="portfolio-info">
              <h3>Mais Avisos:</h3>
              <ul>
                @foreach($murais as $mural)
                <li><strong> {{ $mural->titulo }} - {{ $mural->texto }}</strong></li>
                <li>
                  <img src="{{ asset('img/calendar.png') }}" width="40px" />
                  {{ date('d/m/Y', strtotime($mural->data_inicio)) }}
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>