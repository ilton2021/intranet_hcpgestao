@extends('layouts.adm')
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">VINCULAR - GRUPO INDICADORES / PERFIL USUÁRIO:</h3>
		</div>
	</div>
	@if ($errors->any())
	<div class="alert alert-success">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<table>
		<tr>
			<td ><br> <a href="{{ route('cadastroGrupoIndicadores') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
		</tr>
	</table>
	<?php $qtd = sizeof($gpIndi_pfUser); ?>
	@if($qtd > 0)
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
			<div class="accordion" id="accordionExample">
				<div class="card">
					<a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
						Vincular Grupo indicador ao Perfil do Usuário: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<table border="1" class="table-sm" style="line-height: 1.5; margin-bottom:40px">
					<thead class="bg-info">
						<tr>
							<td style="width: 900px;">
								<center><b>GRUPO INDICADOR</b></center>
							</td>
							<td style="width: 500px;">
								<center><b>PERFIL DE USUÁRIO</b></center>
							</td>
							<td style="width: 500px;">
							</td>
						</tr>
					</thead>
					@foreach($gpIndi_pfUser as $GpiPfuser)
					<tr>
						<td>
							<center> {{ $GpiPfuser->grupo_indicador }} </center>
						</td>
						<td style="width: 800px;">
							<center> {{ $GpiPfuser->perfil }} </center>
						</td>
						<td style="width: 800px;">
							<center> <a class="btn btn-danger btn-sm" href="{{ route('grupoVincularExcluir_', array($grupoIndica[0]->id, $GpiPfuser->perfil_ID)) }}">Excluir</a> </center>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	@else
	<tr>
		<td>
			<center>
				<h3>Não existe perfil de usuário vinculado a este grupo de indicador.</h3>
			</center>
	</tr>
	@endif
	</body>