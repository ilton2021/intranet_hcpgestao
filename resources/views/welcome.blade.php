@extends('layouts.app')

<body>
  <section id="testimonials" class="testimonials">
    <div class="container position-relative">
      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          @foreach($destaques as $destaque)
          <?php $data_a = date('d-m-Y', strtotime('now'));
          $data_f = date('d-m-Y', strtotime($destaque->data_fim));
          ?>
          @if(strtotime($data_f) >= strtotime($data_a))
          <div class="swiper-slide">
            <div class="testimonial-item"><br><br>
              <a href="{{ route('destaquesDetalhes', 0) }}"><img src="{{asset('storage')}}/{{$destaque->caminho}}" class="testimonial-img" alt=""></a>
              <h3>{{ $destaque->titulo }}</h3><br>
              <p>
                {{ substr($destaque->texto, 0, 300) .'...' }}
              </p>
            </div>
          </div>
          @endif
          @endforeach
        </div> <br><br>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <?php $a = 0; ?>
  <section id="team" class="team section-bg">
    <div class="container">
      <div class="section-title">
        <h2>Mural de Avisos</h2>
      </div>
      <div class="row">
        @foreach($murais as $mural) <?php $a += 1; ?>
        @if($a <= 4) <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <a href="{{asset('storage')}}/{{$mural->caminho}}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $mural->titulo; ?>"><img src="{{asset('storage')}}/{{$mural->caminho}}" class="img-fluid" alt=""></a>
              <div class="social"> </div>
            </div>
            <div class="member-info">
              <h4>{{ $mural->titulo }}</h4>
              <span>{{ $mural->texto }}</span>
            </div>
          </div>
      </div>
      @endif
      @endforeach
    </div>
    @if($a > 4)
    <center><a href="{{ route('muraisDetalhes') }}" target="_blank" class="btn btn-sm btn-info">Mais...</a></center>
    @endif
  </section>

  <section id="services" class="services section-bg">
    <div class="container">
      <div class="section-title">
        <h2>Acesso Rápido</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-cash-stack" style="color: #ff689b;"></i></div>
            <h4 class="title"><a href="{{ route('acessoRapido', 1) }}">Ouvidoria das Unidades</a></h4>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-calendar4-week" style="color: #e9bf06;"></i></div>
            <h4 class="title"><a href="{{ route('acessoRapido', 2) }}">Indicadores</a></h4>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-chat-text" style="color: #3fcdc7;"></i></div>
            <h4 class="title"><a href="{{ route('acessoRapido', 3) }}">Ramais/E-mails Unidades</a></h4>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-credit-card-2-front" style="color:#41cf2e;"></i></div>
            <h4 class="title"><a href="{{ route('acessoRapido', 4) }}">Documentos da Qualidade</a></h4>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-clock" style="color: #4680ff;"></i></div>
            <h4 class="title"><a href="{{ route('acessoRapido', 6) }}">Políticas e Normas</a></h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="section-title">
        <h2>Unidades do HCPGESTÃO</h2>
      </div>
      @foreach($unidades as $unds)
      @if($unds->id != 7)
      <div class="row portfolio-container">
        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="{{asset('storage')}}/{{$unds->caminho}}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $unds->sigla }}</h4>
              <p>{{ $unds->nome }} </p>
              <div class="portfolio-links">
                <a href="{{ route('unidade', $unds->id) }}" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </section>

</body>
</main>

</html>