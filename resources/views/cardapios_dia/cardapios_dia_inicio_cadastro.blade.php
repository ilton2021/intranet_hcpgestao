<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>ESCOLHA A OPÇÃO DO CARDÁPIO DO DIA:</b></h5>
		</div>
	</div>	
	<div class="row" style="margin-top: 25px;">
	  <div class="col-md-12">
		<section id="cards" class="portfolio-details">
          <div class="container"> 
            <div class="row gy-4"> 
              <div class="d-inline-flex justify-content-around flex-wrap">
                <div class="card border-0 m-2" style="width: 18rem;outline:none;"> 
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="{{ asset('/storage/cardapios/cafeDamanha.jpg') }}" width="200px" height="200px">
                  </button>
                  <a href="{{ route('cadastroCardapiosDia', 1) }}" class="btn btn-info btn-md text-white">
                    <strong>Café da Manhã <i class="bi bi-cup-fill"></i></strong>  
                  </a>
                </div> 
                <div class="card border-0 m-2" style="width: 18rem;outline:none;">
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   <img src="{{ asset('/storage/cardapios/almoco.jpg') }}" width="200px" height="200px">
                  </button>
                  <a href="{{ route('cadastroCardapiosDia', 2) }}" class="btn btn-info btn-md text-white">
                   <strong>Almoço</strong>
                  </a>
                </div>
                <div class="card border-0 m-2" style="width: 18rem;outline:none;">
                 <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <img src="{{ asset('/storage/cardapios/jantar.jpg') }}" width="200px" height="200px">
                 </button>
                 <a href="{{ route('cadastroCardapiosDia', 3) }}" class="btn btn-info btn-md text-white">
                   <strong>Jantar <i class="bi bi-cup-hot-fill"></i></strong>
                 </a>
                </div>
              </div>
            </div>
            <br><br><br>
            <center><a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ route('home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a></center>
          </div>
        </section>
	  </div>
	</div> 
</div>
</body>