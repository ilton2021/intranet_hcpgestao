@extends('layouts.app')
<link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hind&display=swap" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>

<body>
<section id="testimonials" class="text-center" style='background-image: url("assets/img/destaque_fundo.jpg");'>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
              @foreach($murais as $mr)
                @if ($mr->id == 202)
                <div class="swiper-slide">
                    <a href="http://10.0.0.12/acesso_rapido/7" >
                        <div class="testimonial-item"><br><br>
                            <div class="text-center" >
                                <img src="{{ asset('storage') }}/{{ $mr->caminho }}" class="card-img-top2" alt="" width="500px">
                            </div>
                            <h3 class="text-center">{{$mr->titulo}}</h3>
                        </div>
                    </a> 
                </div>
                @else
                <div class="swiper-slide"> 
                    <a href="{{ asset('storage') }}/{{ $mr->caminho }}" style="color: black; width: 800px;" class="portfolio-lightbox">
                        <div class="testimonial-item"><br><br>
                            <div class="text-center" >
                                <img src="{{ asset('storage') }}/{{ $mr->caminho }}" style="width:600px;" class="img-fluid" alt="">
                            </div>
                            <h3 class="text-center">{{$mr->titulo}}</h3>
                        </div>
                    </a> 
                </div>
                @endif 
               @endforeach
            </div>
        </div>
    </section>
    
	<section class="services section-bg">
      <div class="container">
       <div class="row">
        <div class="col-lg-7 col-md-6">
            <div class="section-title" style="padding-bottom: 0px;">
              <h2>DESTAQUES / UNIDADES</h2>
            </div>
            <div class="container position-relative">
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($destaques as $destaque)
                        <?php $data_a = date('d-m-Y', strtotime('now'));
                        $data_f = date('d-m-Y', strtotime($destaque->data_fim));
                        $data_i = date('d-m-Y', strtotime($destaque->data_inicio));
                        $destaqueQtd = 0;
                        ?>
                        @if (strtotime($data_a) >= strtotime($data_i) && strtotime($data_a) <= strtotime($data_f)) <?php $destaqueQtd++; ?> <div class="swiper-slide">
                            @if ($destaque->caminho !== '')
                            <a href="{{ route('destaquesDetalhes', [$unidade[0]->id, $destaque->id]) }}" style="color: black; ">
                                <div class="testimonial-item"><br><br>
                                    <div class="text-center" style="height:310px; margin-bottom:20px;">
                                        <img class="rounded" style="height:320px" src="{{ asset('storage') }}/{{ $destaque->caminho }}" alt="">
                                    </div>
                                    <h3>{{ $destaque->titulo }}</h3>
                                    <div style="margin-left:210px; margin-right:210px;">
                                        <p align="center">
                                            {{ substr($destaque->subtitulo, 0, 300) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @else
                            <a href="{{ route('destaquesDetalhes', [$unidade[0]->id, $destaque->id]) }}" style="color: black; ">
                                <div class="testimonial-item"><br><br>
                                    <div class="text-center" style="height:310px; margin-bottom:20px;">
                                        <iframe class="rounded" width="527" height="300" src="{{ $destaque->video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <h3>{{ $destaque->titulo }}</h3>
                                    <div style="margin-left:210px; margin-right:210px;">
                                        <p align="center">
                                            {{ substr($destaque->subtitulo, 0, 300) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @endif
                    </div>
                    @else
                    @endif
                    @endforeach
                    @if($destaqueQtd == 0)
                    @foreach ($unidades as $unds)
                    @if ($unds->id != 1)
                    <div class="swiper-slide">
                        <a href="{{ route('unidade', $unds->id) }}" style="color: black; ">
                            <div class="testimonial-item"><br><br>
                                <div class="text-center" >
                                    <img src="{{ asset('storage') }}/{{ $unds->caminho }}" style="width:500px" class="img-fluid" alt="">
                                </div>
                                <h3 class="text-center">{{$unds->nome}}</h3>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div><br><br><br>
                <div class="swiper-pagination"></div>
            </div>
          </div>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="section-title">
              <h2><i class="fas fa-video"></i> VÍDEOS / LGPD</h2>
            </div>
            <div class="swiper">
             <div class="testimonial-item align-items-center" style="margin-left: 100px">
              <div>
              <h5><a href="{{ asset('storage/Acesso Portal Clínico.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">Acesso ao Registro Eletrônico de Saúde</a></h5><br>
                <h5><a href="{{ asset('storage/lgpd/Entenda a LGPG.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">Entenda a LGPD</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD no dia a dia.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD no dia a dia</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD no HCP.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD no HCP</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD e o cuidado com as senhas.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD e o cuidado com as senhas</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD e o cuidado com o Whatsapp.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD e o cuidado com o Whatsapp</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD e o uso de aplicativos.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD e o uso de aplicativos</a></h5> <br>
                <h5><a href="{{ asset('storage/lgpd/A LGPD e o uso do WIFI corporativo.mp4') }}" data-gallery="portfolioGallery" class="portfolio-lightbox">A LGPD e o uso do WIFI corporativo</a></h5> 
                
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
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
                        <h4 class="title"><a href="http://10.0.0.12:8090/login" target="_blank">TIDOCS</a></h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <a href="http://helpdesk/" target="_blank">
                        <div class="icon-box">
                            <div class="icon"><img src="{{ asset('storage/GLPI_logo.png') }}" width="150px" alt=""></div>
                            <div>
                                <label class="title" style="margin-left:100px">HelpDesk </label>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-title">
                <h2>Unidades do HCPGESTÃO</h2>
            </div>
            @foreach ($unidades as $unds)
             @if ($unds->id != 1)
              <div class="row portfolio-container">
                 <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                      <img src="{{ asset('storage') }}/{{ $unds->caminho }}" class="img-fluid" alt="">
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
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</main>

</html>