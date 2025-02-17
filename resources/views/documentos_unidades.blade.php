@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<body>
@section('content')
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Documentos da Qualidade - Detalhes</h2>
          <ol style="display: flex;">
            <li style="margin-right: 30px;"><a href="{{ url('/') }}">Home</a></li>
            <li>Documentos da Qualidade - Detalhes</li>
          </ol>
        </div>
      </div>
    </section>
    <br>
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">
        <div class="row"> 
            <center>
            <a style="width:320px;" class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#documentosUnidades" role="button" aria-expanded="false" aria-controls="collapseExample">
              <b>Unidades</b> <img src="{{ asset('storage') }}/{{ 'arquivo.png' }}" alt="Imagem"  style="height: 40px; width: 40px;"/>
            </a>
            <div class="collapse border-0" id="documentosUnidades">
              <section class="cards" style="margin-top: 20px;">
                <table class="table table-sm">
                  <thead>
                    <tr> 
                      <td class="border border-right" colspan="3"><center><b>Selecione uma Unidade:</b></center></td>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach ($unidades as $unds)
                      <tr>
                        <td class="border border-right"><center><br><b>{{ $unds->nome }}</b></center></td>
                        <td class="border border-right" title="{{ $unds->nome }}"><center> <img src="{{ asset('storage') }}/{{ $unds->caminho }}" class="img-fluid" alt="" width="100px">  </center> </td>
                        <td class="border border-right"> <br>
                         <center>
                          <a class="btn btn-success btn-sm" href="{{ route('documentosSetores', array($id, $unds->id)) }}">
                            Acessar
                          </a> 
                         </center>
                        </td>
                      </tr>
                    @endforeach
                  </tbody> 
                </table>
              </section>
            </div>
          </center>
        </div> <br>
        <center><a href="{{ route('acessoRapido', 4) }}" class="btn btn-sm btn-warning">VOLTAR</a></center>
      </div> 
    </section>
  </main>