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

        <div class="row gy-20">
          <div class="col-lg-6">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  @foreach($murais as $mural)
                    <a href="{{asset('storage')}}/{{$mural->caminho}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $mural->titulo; ?>"><img src="{{asset('storage')}}/{{$mural->caminho}}" class="img-fluid" alt="" width="500px"></a>
                  @endforeach
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-6"> 
            <div class="portfolio-info">
              <h3><font color="green">Mural de Avisos:</font></h3>
              <ul>
                @foreach($murais2 as $mural)
                <ul>
                <li><strong><p align="justify"><font size="2"><a href="{{ route('muraisDetalhes', $mural->id) }}" title="<?php echo $mural->titulo; ?>">{{ substr($mural->titulo,0,70) }}</a></font></p></strong>
                <img src="{{asset('img')}}/{{('calendar.png')}}" width="30"/> 
                <font size="2">{{ date('d/m/Y', strtotime($mural->created_at)) }} </font></li>
                </ul> <br>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="{{ asset('../assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('../assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('../assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('../assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('../assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('../assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('../assets/js/main.js') }}"></script>
</body>
</html>