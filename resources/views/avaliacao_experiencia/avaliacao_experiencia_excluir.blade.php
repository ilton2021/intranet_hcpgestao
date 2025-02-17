@extends('layouts.adm')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}" />
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">EXCLUIR AVALIAÇÃO DE EXPERIÊNCIA:</h3>
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
						Excluir Avaliação de Experiência: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<form action="{{\Request::route('destroyDestaques')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td> Colaborador: </td>
							<td>
								<input class="form-control" type="text" id="colaborador" name="colaborador" value="<?php echo $avaliacao[0]->colaborador; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td> Vaga: </td>
							<td>
								<input class="form-control" type="text" id="vaga" name="vaga" value="<?php echo $avaliacao[0]->vaga; ?>" readonly /> 
							</td>
						</tr>
						<tr>
							<td>Gestor:</td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="gestor" name="gestor" value="<?php echo $avaliacao[0]->gestor; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Unidade:</td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="unidade" name="unidade" value="<?php echo $avaliacao[0]->unidade; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td>Área:</td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="area" name="area" value="<?php echo $avaliacao[0]->area; ?>" readonly />
							</td>
						</tr>
						<tr>
							<td colspan="4"><br><b>Deseja Realmente Excluir esta Avaliação de Experiência?</b></td>
						</tr>
						<tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="excluir_avaliacao" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
					</table>
					<table>
						<tr>
							<td><br> <a href="{{ route('cadastroAvaliacaoExp') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
								<input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</body>