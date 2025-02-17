<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Manual da Farmácia - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/farmacia.css') }}" rel="stylesheet">
  <style>
      #myUL > ul {
      list-style-type: none;
    }

    /* Remove margins and padding from the parent ul */
    #myUL {
      margin: 0;
      padding: 0;
    }

    .about .content ul li {
      margin-bottom: 20px;
      display: flex;
      align-items: flex-start;
      flex-direction: column;
    }

    /* Style the caret/arrow */
    .caret {
      cursor: pointer;
      user-select: none; /* Prevent text selection */
    }

    /* Create the caret/arrow with a unicode, and style it */
    .caret::before {
      content: "\25B6";
      color: black;
      display: inline-block;
      margin-right: 6px;
    }

    /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
    .caret-down::before {
      transform: rotate(90deg);
    }

    /* Hide the nested list */
    .nested {
      display: none;
    }

    /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
    .active {
      display: block;
      margin-left: 20px;
    }

  </style>
</head>

<body>
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="{{ asset('storage/manual/saoSebastiao.png')}}" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="{{ redirect('/') }}">Manuais HSS</a></h1>
      </div>

      <nav id="navbar" class="nav-menu navbar top-fixed " style="position: absolute; display: flex;">
        <ul style="margin-top: 40px;">
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
           <ul id="myUL">
            <li>
              <span class="caret">Manual Farmacêutico</span>
              <ul class="nested">
                  @foreach($topicoFarmacia as $topicoFarm)
                    <li><a href="#facts" class="nav-link scrollto">{{ $topicoFarm->descricao }}</a></li>
                      @foreach($subtopicosFarmacia as $subtopicoFarm)
                          <li><span class="caret">{{ $topicoFarm->descricao }}</span>
                            <ul class="nested">
                                @if($subtopicoFarm->topico_id == $topicoFarm->id)
                                  <li><span class="caret">{{ $subtopicoFarm->descricao }}</span>
                                  <ul class="nested">
                                        @foreach($subtopicos2 as $subtopico2)
                                          @if($subtopico2->subtopico_id == $subtopicoFarm->id)
                                            <li><a href="#facts" class="nav-link scrollto">{{ $subtopico2->descricao }}</a></li>
                                          @endif
                                        @endforeach
                                      </ul>
                                    </li>
                                  </ul>
                                  </li>
                                @endif
                            </ul>
                          </li>
                      @endforeach
                  @endforeach
              </ul>
            </li>
            
          </ul>
          <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Manual Institucional</span></a></li>
        </ul>
      </nav>
    </div>
  </header>
  @if($topicoSelecionado == Null)
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
  <div class="book">
      <div class="front">
        <div class="cover" onclick="">
          <p class="num-up"></p>
      <p class="author">Manuais</p>
        <img class="logo"
        src="{{asset('storage/manual/saoSebastiao.png')}}"
        alt="Logo do hospital São sebastião"
        >
        <svg class="logoMedicamentos" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 117.4"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>pharma</title><path class="cls-1" d="M120.8,40A19.29,19.29,0,0,1,87.64,59.55L120.8,40ZM36.6,10A20.07,20.07,0,0,1,63.94,2.67h0A20.08,20.08,0,0,1,71.26,30c-11.38,19.7-22.73,39.21-34.1,58.92h0A20,20,0,0,1,10,96.22h0A20,20,0,0,1,2.66,69h0C14,49.28,25.2,29.73,36.6,10ZM47.89,61.55,21.17,46.13,6.67,71.24h0a15.5,15.5,0,0,0,5.64,21.08h0a15.48,15.48,0,0,0,21.08-5.65h0l14.5-25.12ZM90.31,89.4A19.29,19.29,0,0,1,63.76,115a19,19,0,0,1-6.61-6L90.31,89.4Zm-34.06-.63a19.27,19.27,0,0,1,26.2-7.52,19,19,0,0,1,6.23,5.49L55.63,106.22a19.16,19.16,0,0,1,.62-17.45ZM86.74,39.36a19.29,19.29,0,0,1,32.44-2L86.11,56.83a19.3,19.3,0,0,1,.63-17.47Z"/></svg>
        </div>
      </div>
      <div class="left-side">
        <h2>
          <span>Manuais</span>
          <span>HOSPITAL SÃO SEBASTIÃO</span>
        </h2>
      </div>
    </div>
  </section>
  
  @else
  <main id="main">    

    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Manual Farmacêutico Selecionado</h2>
        </div>

        <div class="row no-gutters">
        <iframe
          src="{{ asset('storage')}}/{{$topicoSelecionado[0]->caminho}}"
          frameborder="0"
          scrolling="auto"
          height="1000px"
          width="100%">
          </iframe>
        </div>

      </div>
    </section><!-- End Facts Section -->

  </main><!-- End #main -->
  @endif

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('vendor/typed.js/typed.umd.js')}}"></script>
  <script src="{{ asset('vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('js/farmacia.js')}}"></script>
  <script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
      toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("active");
        this.classList.toggle("caret-down");
      });
    }
  </script>
</body>
</html>