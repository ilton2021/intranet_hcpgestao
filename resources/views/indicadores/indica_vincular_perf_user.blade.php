@extends('layouts.adm')
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">VINCULAR - INDICADOR / PERFIL USUÁRIO:</h3>
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
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
			<div class="accordion" id="accordionExample">
				<div class="card">
					<a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
						Indicador: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<form action="{{\Request::route('storeGpIndiPerfUsers')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td>Indicador: </td>
							<td>
								@foreach($Indicadores as $Indicador)
								<?php $indicador_id = $Indicador->id ?>
								<input hidden class="form-control" type="text" id="grupo_indic_id" name="grupo_indic_id" value="<?php echo $Indicador->id; ?>" readonly />
								<input style="width: 400px;" class="form-control" type="text" id="Indicador" name="Indicador" value="<?php echo $Indicador->nome; ?>" readonly />
								@endforeach
							</td>
						</tr>
						<tr>
							<td> Perfil de usuários: </td>
							<td>
								<select id="perfil_user_id" name="perfil_user_id" class="form-control">
									@foreach($perfilUser as $pfUser)
									<option id="perfil_user_id" name="perfil_user_id" value="<?php echo $pfUser->id; ?>"> {{ $pfUser->nome }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td hidden><input hidden type="text" id="tela" name="tela" class="form-control" value="vincular_Indicadores_perfilUsuario" /></td>
							<td hidden><input hidden type="text" id="user_id_" name="user_id_" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
							<td hidden><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
					</table>
					<table>
						<tr>
							<td><br> <a href="{{ route('cadastroIndicadores') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
								<input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<?php $qtd = sizeof($Indi_pfUser); ?>
	@if($qtd > 0)
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
			<div class="accordion" id="accordionExample">
				<div class="card">
					<a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
						Vincular indicador ao Perfil do Usuário: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<table border="1" class="table-sm" style="line-height: 1.5; margin-bottom:40px">
					<thead class="bg-info">
						<tr>
							<td style="width: 500px;">
								<center><b>INDICADOR</b></center>
							</td>
							<td style="width: 500px;">
								<center><b>PERFIL DE USUÁRIO</b></center>
							</td>
							<td style="width: 50px;">

							</td>
						</tr>
					</thead>
					@foreach($Indi_pfUser as $InPfUser)
					<tr>
						<td>
							<center> {{ $InPfUser->indicador }} </center>
						</td>
						<td style="width: 800px;">
							<center> {{ $InPfUser->perfil }} </center>
						</td>
						<td>
							<center><a class="btn btn-danger" href="{{route('indicaVincularExcluir', array($indicador_id ,$InPfUser->id_perfil))}}"><i class="fas fa-trash-alt"></i></a></center>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	@endif
	</body>