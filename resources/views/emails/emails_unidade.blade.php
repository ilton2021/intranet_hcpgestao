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
       <form action="{{ route('pesqEmailsUnidade', $unidade[0]->id) }}" method="POST">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table border="0" class="table">
          <tr>
           <td> 
            <select class="form-control form-control-sm" id="pesq2" name="pesq2">
              <option id="pesq2" name="pesq2" value="">SELECIONE...</option>
              <option id="pesq2" name="pesq2" value="nome">NOME</option>
              <option id="pesq2" name="pesq2" value="email">E-MAIL</option>
            </select>
           </td>
           <td> <input class="form-control form-control-sm" type="text" id="pesq" name="pesq"> </td>
           <td> <input type="submit" class="btn btn-success btn-sm" value="PESQUISAR" id="Salvar" name="Salvar" /> </td>
           <td align="right"> <a href="{{ route('acessoRapido', 3) }}" class="btn btn-sm btn-warning">VOLTAR</a></td>
          </tr>
        </table>
       </form>  
      <div class="row gy-4">
           <div>
              <p align="justify">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td><b>NOME:</b></td>
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