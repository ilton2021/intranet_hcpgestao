<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HCPGESTÃO INTRANET - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
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
      <a href="{{ url('/') }}" class="logo"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
        <ul>
          <li class="dropdown"><a href="#"><span>O HCPGESTÃO</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                  <li><a href="{{ route('oquee') }}">O que é?</a></li>
                  <li><a href="{{ route('unidade', 1) }}">HMR</a></li>
                  <li><a href="{{ route('unidade', 2) }}">UPAE BELO JARDIM</a></li>
                  <li><a href="{{ route('unidade', 3) }}">UPAE ARCOVERDE</a></li>
                  <li><a href="{{ route('unidade', 4) }}">UPAE ARRUDA</a></li>
                  <li><a href="{{ route('unidade', 5) }}">UPAE CARUARU</a></li>
                  <li><a href="{{ route('unidade', 6) }}">HSS</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="http://172.16.0.219/portalrh/WPortalRH.dll/$/" target="_blank">ÁREA DO COLABORADOR</a></li>
          <li class="dropdown"><a href="#"><span>SERVIÇOS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="{{ route('acessoRapido', 1) }}">Ouvidoria das Unidades</a></li>
                <li><a href="{{ route('acessoRapido', 2) }}">Indicadores</a></li>
                <li><a href="{{ route('acessoRapido', 3) }}">Ramais/E-mails</a></li>
                <li><a href="{{ route('acessoRapido', 4) }}">Documentos da Qualidade</a></li>
                <li><a href="{{ route('acessoRapido', 5) }}">Protocolos Institucionais</a></li>
                <li><a href="{{ route('acessoRapido', 6) }}">Políticas e Normas</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>COMUNICAÇÃO</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="{{ route('destaquesDetalhes', 0) }}">Eventos</a></li>
                <li><a href="{{ route('muraisDetalhes', 0) }}">Mural de Avisos</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>SISTEMAS</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="https://hcpgestao-portal.hcpgestao.org.br" target="_blank">Portal da Transparência</a></li>
                <li><a href="https://hcpgestao.org.br/mpRH/public/" target="_blank">Portal da MP</a></li>
                <li><a href="https://hcpgestao.org.br/processoSeletivo/public/" target="_blank">Portal do Processo Seletivo</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">CONTATO</a></li>
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

          <div class="col-lg-3 col-md-8 footer-contact" style="margin-left: 80px;">
            <h3>HCPGESTÃO</h3><br>
            <p>
              <strong>Telefone:</strong> 3217-8057<br>
              <strong>E-mail:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-7 footer-links">
             
          </div>

          <div class="col-lg-3 col-md-8 footer-links"  style="margin-left: -220px;"> <br>
             <img src="{{asset('img')}}/{{'Imagem1.png'}}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-3 col-md-8 footer-links"  style="margin-left: 140px;">
            <h4>Nossas Redes Sociais:</h4>
            <div class="social-links mt-3"><br>
              <a href="https://www.facebook.com/sigahcp/" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.linkedin.com/company-beta/5314142/" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
              <a href="https://www.youtube.com/user/hcppernambuco" class="youtube" target="_blank"><i class="bx bxl-youtube"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  

    <div class="container py-4"> 
      <div class="copyright">
        &copy;Copyright <strong><span>HCPGESTÃO</span></strong>. Todos os Direitos Reservados
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
