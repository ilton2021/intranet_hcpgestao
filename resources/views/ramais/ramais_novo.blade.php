@extends('layouts.adm')
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO RAMAL:</h3>
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
						Ramais: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<form action="{{\Request::route('storeRamais')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td> Telefone: </td>
							<td>
								<input class="form-control" style="width: 400px" type="text" id="telefone" name="telefone" required value="{{ old('telefone') }}" />
							</td>
						</tr>
						<tr>
							<td> Funcionário: </td>
							<td>
								<input class="form-control" style="width: 400px" type="text" id="funcionario" name="funcionario" required value="{{ old('funcionario') }}" />
							</td>
						</tr>
						<tr>
							<td> Sala: </td>
							<td>
								<input class="form-control" style="width: 400px" type="text" id="nome" name="nome" required value="{{ old('nome') }}" />
							</td>
						</tr>
						<tr>
							<td> Setor: </td>
							<td>
								<select class="form-control" style="width: 400px" id="setor_id" name="setor_id">
									@foreach($setores as $setor)
									<option id="setor_id" name="setor_id" value="<?php echo $setor->id; ?>">{{ $setor->nome }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td> Unidade: </td>
							<td>
								<select class="form-control" style="width: 400px" id="unidade_id" name="unidade_id">
									@foreach($unidades as $unidade)
									<option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->sigla }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_ramais" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
					</table>
					<table>
						<tr>
							<td><br> <a href="{{ route('cadastroRamais') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
								<input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</body>