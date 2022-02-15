@extends('layouts.app')
<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h4>{{$unidade[0]->sigla}} - {{$unidade[0]->nome}} </h4>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Unidades Detalhes</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- SEÇÃO DE DESTAQUES -->
    <section id="testimonials" class="testimonials">
      <div class="container position-relative">
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach($destaques as $destaque)
            <?php if (in_array($destaque->id, $destaDaUnd)) {
            ?>
              <?php $data_a = date('d-m-Y', strtotime('now'));
              $data_f = date('d-m-Y', strtotime($destaque->data_fim));
              ?>
              @if(strtotime($data_f) >= strtotime($data_a))
              <div class="swiper-slide">
                <div class="testimonial-item"><br><br>
                  <a href="{{ route('destaquesDetalhes', $destaque->id) }}"><img src="{{asset('storage')}}/{{$destaque->caminho}}" class="testimonial-img" alt=""></a>
                  <h3>{{ $destaque->titulo }}</h3><br>
                  <p>
                    {{ substr($destaque->texto, 0, 300) .'...' }}
                  </p>
                </div>
              </div>
              @endif
            <?php } ?>
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
          <?php if (in_array($mural->id, $muraisDaUnd)) {
          ?>
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
      <?php } ?>
      @endforeach
      </div>
      @if($a > 4)
      <center><a href="{{ route('muraisDetalhes') }}" target="_blank" class="btn btn-sm btn-info">Mais...</a></center>
      @endif
    </section>
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
                <div class="swiper-slide">
                  <img src="{{asset('storage')}}/{{$unidade[0]->caminho}}" alt="" width="100px">
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="portfolio-info">
              <h3>Informações da Unidade</h3>
              <ul>
                <li><strong>Horário</strong>: {{ $unidade[0]->horario }}</li>
                <li><strong>Telefone</strong>: {{ $unidade[0]->telefone }} </li>
                <li><strong>Ouvidoria</strong>: {{ $unidade[0]->ouvidoria }} </li>
                <li><strong>Endereço</strong>: {{ $unidade[0]->endereco }} </li>
              </ul>
            </div>
          </div>
          <div>
            <p align="justify">
              {{ $unidade[0]->texto }}
            </p>
          </div>
        </div>
      </div>
    </section>
    <section id="contact" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Ouvidoria {{$unidade[0]->sigla}}</h2>
        </div>
        <div class="row mt-5">
          <div class="col-lg-4">
            <div class="info">
              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>E-mail:</h4>
                <p>{{$unidade[0]->ouvidoria}}</p>
              </div>
              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefone:</h4>
                <p>{{$unidade[0]->telefone}}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-8 mt-5 mt-lg-0">
            <form action="{{ \Request::route('enviarEmail', $unidade[0]->id) }}" method="post" role="form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Seu E-mail" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Mensagem" required></textarea>
              </div><br><br>
              <div class="text-center">
                <input type="submit" id="enviar" name="enviar" class="btn btn-sm btn-info" value="Enviar">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>