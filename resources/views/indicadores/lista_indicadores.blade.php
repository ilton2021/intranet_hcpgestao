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
	<div class="row" style="margin-top: -80px;">
		<div class="col-md-12">
			<table class="table" id="table_pesq">
				<form action="{{ route('pesquisarIndicadoresGestores') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<tr>
						<td style="width: 400px;"> Grupo:
							<select id="pesq2" name="pesq2" class="form-control">
								<option id="pesq2" name="pesq2" value="">Selecione...</option>
								@foreach($grupo_indicadores as $grupo)
								<option id="pesq2" name="pesq2" value="<?php echo $grupo->id; ?>">{{ $grupo->nome }}</option>
								@endforeach
							</select>
						</td>
						<td> <br>
							<input type="submit" id="btn" name="btn" class="btn btn-info btn-sm" value="Pesquisar" />
						</td>
					</tr>
			</table>
			<table class="table table-sm ">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="400px">NOME</th>
						<th scope="col">GRUPO</th>
						<th scope="col">LINK</th>
						<th scope="col">UNIDADE</th>
					</tr>
				</thead>
				@foreach($indicadores as $indicador)
				<tbody>
					<tr>
						<td style="font-size: 15px;">{{$indicador->nome}}</td>
						@foreach($grupo_indicadores as $grupo)
						@if($grupo->id == $indicador->grupo_id)
						<td style="font-size: 15px;">{{$grupo->nome}}</td>
						@endif
						@endforeach
						<td style="font-size: 15px;"><a display="none" href="{{$indicador->link}}" target="_blank" class="btn btn-sm btn-success">ACESSE</a></td>
						<td style="font-size: 15px;">
							<?php
							for ($i = 0; $i < sizeof($unidades); $i++) {
								if ($indicador->unidade_id == $unidades[$i]->id) {
									echo $unidades[$i]->sigla;
								}
							}
							?>
						</td>
					</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
</div>
</div>
</div>
</body>