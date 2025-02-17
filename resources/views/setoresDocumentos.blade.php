@extends('layouts.app')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<body>
@section('content')
<main id="main" style="margin-top: -48px;">
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
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="card card-body border-0">
                    <p>
                        <a style="width:200px;" class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#documentosSetores" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <b>Setores</b> <img src="{{ asset('storage') }}/{{ 'arquivo.png' }}" alt="Imagem"  style="height: 40px; width: 40px;"/>
                        </a>
                    </p>
                    <div class="collapse border-0" id="documentosSetores">
                        <div class="card card-body border-0">
                            <div class="container">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">SETOR</th>
                                            <th scope="col"><center>SIGLA</center></th>
                                            <th scope="col"><center>ACESSO</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($setores as $documento)
                                            <tr>
                                                <td class="border border-right" title="{{ $documento->setor }}"><b>{{ $documento->setor }}</b></td>
                                                <td class="border border-right" title="{{ $documento->sigla }}"><b><center>{{ $documento->sigla }}</center></b></td>
                                                <td>
                                                  <center>
                                                    <a class="btn btn-success btn-sm" href="{{ route('documentosQualidade', array($id, $unds[0]->id, $documento->id)) }}">
                                                        Acessar
                                                    </a>
                                                  </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center> <a href="{{ route('documentosUnidades', $id) }}" class="btn btn-sm btn-warning">VOLTAR <i class="fas fa-reply"></i></a> </center>
        </div>
        
    </section>
</main>


@endsection
