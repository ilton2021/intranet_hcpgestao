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
      <p align="right"><a href="javascript:history.back();" class="btn btn-sm btn-warning">Voltar</a></p>
        <div class="row gy-4">
           <div>
              <p align="justify">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><b>FUNCIONÁRIO:</b></td>
                        <td><b>E-MAIL:</b></td>
                    </tr>
                    @foreach($emails as $email)
                    <tr>
                        <td>{{ $email->nome }}</td>
                        <td>{{ $email->email}}</td>
                    </tr>
                    @endforeach
                </table>
              </p>
            </div>
        </div>
      </div>
    </section>
  </main>
  
</body>
</html>