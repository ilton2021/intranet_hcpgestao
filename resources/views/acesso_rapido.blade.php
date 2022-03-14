@extends('layouts.app')

<body>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          @if($id == 1)
          <h2>Ouvidaria das Unidades - Detalhes</h2>
          @elseif($id == 2)
          <h2>Indicadores - Detalhes</h2>
          @elseif($id == 3)
          <h2>Ramais / E-mails - Detalhes</h2>
          @elseif($id == 4)
          <h2>Documentos da Qualidade - Detalhes</h2>
          @elseif($id == 6)
          <h2>Políticas e Normas - Detalhes</h2>
          @endif
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            @if($id == 1)
            <li>Ouvidaria das Unidades - Detalhes</li>
            @elseif($id == 2)
            <li>Indicadores - Detalhes</li>
            @elseif($id == 3)
            <li>Ramais / E-mails - Detalhes</li>
            @elseif($id == 4)
            <li>Documentos da Qualidade - Detalhes</li>
            @elseif($id == 6)
            <li>Políticas e Normas - Detalhes</li>
            @endif
          </ol>
        </div>
      </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row gy-4">
          <div>
            @if($id == 1) <br><br><br><br>
            <p align="justify">
              @foreach($ouvidorias as $ouvidoria)
              {{ $ouvidoria->nome }}: <b>{{ $ouvidoria->email }}</b> <BR><BR>
              @endforeach
            </p>
            @elseif($id == 2)
            <p align="justify">
              Você precisa fazer Login para visualizar os Indicadores: <br><br>
              <a href="{{ route('telaLoginIndicador') }}" class="btn btn-sm btn-info">Fazer Login</a>
            </p>
            @elseif($id == 3)
            <p align="justify">
            <table class="table">
              <tr>
                <thead>
                  <th>UNIDADES:</th>
                  <th>RAMAIS:</th>
                  <th>E-MAILS:</th>
                </thead>
                @foreach($unidades as $unidade)
              <tr>
                <td>
                  {{ $unidade->nome }}
                </td>
                <td title="<?php echo $unidade->nome; ?>"><a href="{{ route('ramaisUnidade', $unidade->id) }}" class="btn btn-sm btn-success">RAMAL</a></td>
                <td title="<?php echo $unidade->nome; ?>"><a href="{{ route('emailsUnidade', $unidade->id) }}" class="btn btn-sm btn-success">EMAIL</a></td>
              </tr>
              @endforeach
              </tr>
            </table>
            </p>
            @elseif($id == 4)
            <section class="cards">
              @foreach($documentos as $documento)
              <div class="card">
                <div class="image">
                  <img src="{{asset('storage')}}/{{('foto.jpg')}}" alt="Imagem" />
                </div>
                <div class="content">
                  <p class="title text--medium">
                    {{ $documento->nome }}
                  </p>
                  <p>
                    <a href="{{asset('storage')}}/{{$documento->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a>
                  </p>
                </div>
              </div>
              @endforeach
            </section>
            <section class="cards">
              @foreach($protocolos as $protocolo)
              <div class="card">
                <div class="image">
                  <img src="{{asset('storage')}}/{{('foto2.jpg')}}" alt="Imagem" />
                </div>
                <div class="content">
                  <p>
                    Setor: {{$protocolo->setor}}</p>
                  <p>
                    {{ $protocolo->nome }}
                  </p>
                  <p>
                    <a href="{{asset('storage')}}/{{$protocolo->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a>
                  </p>
                </div>
              </div>
              @endforeach
            </section>
            @elseif($id == 6)
            <section class="cards">
              @foreach($politicas as $politica)
              <div class="card">
                <div class="image">
                  <img src="{{asset('storage')}}/{{('foto3.jpg')}}" alt="Imagem" />
                </div>
                <div class="content">
                  <p>
                    Setor: {{$politica->setor}}</p>
                  <p>
                    {{ $politica->nome }}
                  </p>
                  <p>
                    <a href="{{asset('storage')}}/{{$politica->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a>
                  </p>
                </div>
              </div>
              @endforeach
            </section>
            @endif
          </div>
        </div>
      </div>
    </section>
  </main>

</body>

</html>