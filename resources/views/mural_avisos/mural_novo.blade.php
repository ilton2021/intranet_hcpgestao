@extends('layouts.adm')
<script type="text/javascript">
	function selects() {
		var ele = document.getElementsByClassName('unidade');
		for (var i = 0; i < ele.length; i++) {
			if (ele[i].type == 'checkbox')
				ele[i].checked = true;
		}
	}

	function deSelect() {
		var ele = document.getElementsByClassName('unidade');
		for (var i = 0; i < ele.length; i++) {
			if (ele[i].type == 'checkbox')
				ele[i].checked = false;

		}
	}

	function selects_und_cad() {
		var ele = document.getElementsByClassName('unidade_cad');
		for (var i = 0; i < ele.length; i++) {
			if (ele[i].type == 'checkbox')
				ele[i].checked = true;
		}
	}

	function deSelect_und_cad() {
		var ele = document.getElementsByClassName('unidade_cad');
		for (var i = 0; i < ele.length; i++) {
			if (ele[i].type == 'checkbox')
				ele[i].checked = false;

		}
	}
</script>
<div class="container-fluid">
	<div class="row" style="margin-top: -50px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO MURAL DE AVISOS:</h3>
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
						Mural de Avisos: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<form action="{{\Request::route('storeMural')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td> Título: </td>
							<td>
								<input class="form-control" type="text" id="titulo" name="titulo" required value="{{ old('titulo') }}" />
							</td>
						</tr>
						<tr>
							<td> Imagem: </td>
							<td>
								<input class="form-control" style="width: 750px" type="file" id="imagem" name="imagem" required value="" />
							</td>
						</tr>
						<tr>
							<td> Data Início: </td>
							<td>
								<input class="form-control" type="date" id="data_inicio" name="data_inicio" required value="{{ old('data_inicio') }}" />
							</td>
						</tr>
						<tr>
							<td> Data Fim: </td>
							<td>
								<input class="form-control" type="date" id="data_fim" name="data_fim" required value="{{ old('data_fim') }}" />
							</td>
						</tr>
						<tr>
							<td>Unidades que Visualizarão:</td>
							<td>
								<li style="list-style: none;">
									<input style="font-size: 12px;" class="btn btn-primary" type="button" onclick='selects()' value="Marcar todos" />
									<input style="font-size: 12px;" class="btn btn-danger" type="button" onclick='deSelect()' value="Desmarcar todos" />
								</li>
								<li style="list-style: none;">
									@foreach($unidades as $unidade)
									<input type='checkbox' id="unidade_id[]" class="unidade" name="unidade_id[]" value="<?php echo $unidade->id; ?>" /> {{$unidade->sigla}} &nbsp;&nbsp;</input>
									@endforeach
								</li>
							</td>
						</tr>
						<tr>
							<td> Texto: </td>
							<td>
								<textarea style="height:50px" class="form-control" rows="5" type="text" id="texto" name="texto" required value="{{ old('texto') }}"> </textarea>
							</td>
						</tr>
					</table>
					<table>
						<tr>
							<td><br> <a href="{{ route('cadastroMural') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
								<input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</body>