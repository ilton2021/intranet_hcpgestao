@extends('layouts.app')
<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>{{ $unidade[0]->nome }}</h2>
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Unidades Detalhes</li>
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
                <li><strong>Endereço</strong>: <p align="justify"> {{ $unidade[0]->endereco }} </p></li>
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
  </main>
  
</body>
</html>