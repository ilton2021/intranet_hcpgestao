@extends('layouts.adm2')
<div class="container-fluid">
	<div class="row" style="margin-bottom: 100px; margin-top: 100px;">
		<div class="col-md-12 text-center">
			<h5 style="font-size: 18px;"><b>LISTA DE INDICADORES: </b></h5>
		</div>
	</div>
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif <br><br><br>
	
	<div class="row gy-4" style="display: flex; align-items: center; justify-content: center;">
	@foreach($grupo_indicadores as $gi)			
	  @if($gi->exibe == 0)
		<div class="card mb-3" style="width: 28rem;">
			<div class="row g-0">
				<div class="col-md-4">
					@if($gi->status == "Relatorio")
					 <img src="{{asset('img/graph.jpg')}}" class="card-img-top" alt="...">
					@else <br>
					 <img src="{{asset('img/arquivo.png')}}" class="card-img-top" alt="...">
					@endif
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h5 class="card-title">{{ $gi->nome }}</h5>
						<p class="card-text">{{ $gi->nomeInd }}</p>
						@if($gi->status == "Relatorio")
						  <p class="card-text"><small class="text-body-secondary"><center><a href="{{ $gi->link }}" class="btn btn-primary btn-sm">Acessar</a></center></small></p>
						@else
						  <p class="card-text"><small class="text-body-secondary"><center><a href="{{ route('exibeRelatoriosInsumos', $gi->id) }}" class="btn btn-primary btn-sm">Acessar</a></center></small></p>
						@endif
					</div>
				</div>
			</div>
		</div>
	  @endif
	@endforeach
	</div>
	
</div>
</div>
</div>
</body>