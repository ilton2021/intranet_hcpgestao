@extends('layouts.adm')
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO INDICADOR:</h3>
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
				<form action="{{\Request::route('storeIndicadores')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" style="width: 400px" type="text" id="nome" name="nome" required value="{{ old('nome') }}" />
							</td>
						</tr>
						<tr>
							<td> Grupo: </td>

							<td>
								<select class="form-control" id="grupo_id" name="grupo_id">
									@foreach($grupo_indicadores as $GI)
									<option value="<?php echo $GI->id ?>" id="grupo_id" name="grupo_id">{{ $GI->nome }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td> Status: </td>
							<td>
								<select id="status" name="status" class="form-control">
									<option id="status" name="status" value="Pacote">Pacote</option>
									<option id="status" name="status" value="Novo">Novo</option>
								</select>
							</td>
						</tr>
						<tr>
							<td> Link: </td>
							<td>
								<textarea class="form-control" type="text" id="link" name="link" rows="5" required value="{{ old('link') }}"></textarea>

							</td>
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
	</body>