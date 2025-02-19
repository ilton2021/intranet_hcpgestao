﻿<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HCP GESTÃO INTRANET - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo"><img src="{{ asset('assets/img/logo3.jpeg') }}" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown"><a href="#"><span>O HCP GESTÃO</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('oquee') }}">O que é?</a></li>
              @foreach($unidades as $unidade)
              @if($unidade->id > 1)
              <li><a href="{{ route('unidade', $unidade->id) }}">{{$unidade->sigla}}</a></li>
              @endif
              @endforeach
            </ul>
          </li>
          <input type="hidden" name="" value="https://login.lg.com.br/login/hospitaldecancerdepernambuco">
          <li><a class="nav-link scrollto" href="{{ route('areaColaborador') }}">ÁREA DO COLABORADOR</a></li>
          <li class="dropdown"><a href="#"><span>SERVIÇOS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('acessoRapido', 1) }}">Ouvidoria das Unidades</a></li>
              <li><a href="{{ route('acessoRapido', 2) }}">Indicadores</a></li>
              <li><a href="{{ route('acessoRapido', 3) }}">Ramais/E-mails</a></li>
              <li><a href="{{ route('acessoRapido', 4) }}">Documentos da Qualidade</a></li>
              <!--li><a href="{{ route('acessoRapido', 6) }}">Políticas e Normas</a></li-->
	    @if (isset($id_und))
              @if ($id_und == 2)
              <li><a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                  Cadastro de Veículo
                </a>
              </li>
              @endif
            @endif
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>SISTEMAS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="https://hcpgestao-portal.hcpgestao.org.br" target="_blank">Portal da Transparência</a></li>
              <li><a href="https://hcpgestao.org.br/mpRH/public/" target="_blank">Portal da MP</a></li>
              <li><a href="https://hcpgestao.org.br/processo_seletivo_hcpgestao/public/" target="_blank">Portal do Processo Seletivo</a></li>
              <li><a href="{{ route('showPA') }}">Portal de Assinaturas NF</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header>

  <main class="py-4">
    @yield('content')
  </main>

  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-7 footer-links">

          </div>

          <div class="col-lg-3 col-md-8 footer-links" style="margin-left: -220px;"> <br>
            <img src="{{asset('img')}}/{{'Imagem1.png'}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-3 col-md-8 footer-links" style="margin-left: 140px;">
            <center>
              <h4>Nossas Redes Sociais:</h4>
            </center>
            <center>
              <div class="social-links mt-3"><br>
                <a href="https://www.facebook.com/sigahcp/" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
                <a href="https://www.instagram.com/hcp_gestao/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
                <a href="https://www.linkedin.com/company-beta/5314142/" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
                <a href="https://www.youtube.com/user/hcppernambuco" class="youtube" target="_blank"><i class="bx bxl-youtube"></i></a>
              </div>
            </center>
          </div>

        </div>
      </div>
    </div>


    <div class="container py-4">
      <div class="copyright">
        &copy;Copyright <strong><span>HCP GESTÃO</span></strong>. Todos os Direitos Reservados
      </div>
    </div>
  </footer>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>