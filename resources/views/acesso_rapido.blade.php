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
            @elseif($id == 5)
            <h2>Protocolos Institucionais - Detalhes</h2>
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
            @elseif($id == 5)
            <li>Protocolos Institucionais - Detalhes</li>
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
             
            </p>
            @elseif($id == 4)
            <p align="justify">
              <table>
               <tr> <?php $a = 1; ?>
                @foreach($documentos as $documento)  <?php $a += 1; ?>
                <td>
                  <center><img src="{{asset('storage')}}/{{('foto.jpg')}}" width="200" /></center><br>
                  <font size="2"><p align="center"> {{ $documento->nome }} </p></font> <br><center><a href="{{asset('storage')}}/{{$documento->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a></center><BR><BR>
                  </td>
                  @if($a > 4 || $a > 8 || $a > 12 || $a > 16 || $a > 20 || $a > 24) </tr> @endif
                @endforeach 
               </tr>
              </table>
            </p>
            @elseif($id == 5)
            <p align="justify">
              <table>
               <tr> <?php $a = 1; ?>
                @foreach($setores as $setor)
                @foreach($protocolos as $protocolo) 
                @if($setor->nome == $protocolo->setor) <?php $a += 1; ?>
                  <td><center><b>{{ $setor->nome }}: </b></center><br> <br>
                  <center><img src="{{asset('storage')}}/{{('foto.jpg')}}" width="200" /></center><br>
                  <font size="2"><p align="center"> {{ $protocolo->nome }} </p></font> <br><center><a href="{{asset('storage')}}/{{$protocolo->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a></center><BR><BR>
                  </td>
                  @if($a > 4 || $a > 8 || $a > 12 || $a > 16 || $a > 20 || $a > 24) </tr> @endif
                @endif
                @endforeach
                @endforeach 
               </tr>
              </table>
            </p>
            @elseif($id == 6)
            <p align="justify">
              <table>
               <tr> <?php $a = 1; ?>
                @foreach($setores as $setor)
                @foreach($politicas as $politica) 
                @if($setor->nome == $politica->setor) <?php $a += 1; ?>
                  <td><center><b>{{ $setor->nome }}: </b></center><br> <br>
                  <center><img src="{{asset('storage')}}/{{('foto.jpg')}}" width="200" /></center><br>
                  <font size="2"><p align="center"> {{ $politica->nome }} </p></font> <br><center><a href="{{asset('storage')}}/{{$politica->caminho}}" width="100px" class="btn btn-sm btn-info" target="_blank"> Download</a></center><BR><BR>
                  </td>
                  @if($a > 4 || $a > 8 || $a > 12 || $a > 16 || $a > 20 || $a > 24) </tr> @endif
                @endif
                @endforeach
                @endforeach 
               </tr>
              </table>
            </p>
            @endif
            </div>
        </div>
      </div>
    </section>
  </main>
  
</body>
</html>