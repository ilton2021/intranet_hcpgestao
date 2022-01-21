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
              <a href="{{ route('destaquesDetalhes', $destaque->id) }}"><img src="{{asset('storage')}}/{{$destaque->caminho}}" class="testimonial-img" alt=""></a>
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
         @if($a <= 4)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
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
              <div class="icon"><i class="bi bi-globe" style="color: #d6ff22;"></i></div>
              <h4 class="title"><a href="{{ route('acessoRapido', 5) }}">Protocolos Institucionais</a></h4>
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
                <p>{{ $unds->nome }} <br> {{ $unds->nome_unidade }}</p>
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

    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Ouvidoria HCPGESTÃO</h2>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>E-mail:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefone:</h4>
                <p>3217-8057</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="{{ \Request::route('enviarEmail') }}" method="post" role="form">
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
              <input type="submit" id="enviar" name="enviar" class="btn btn-sm btn-info" value="Enviar"></div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main>

  
</body>
</html>