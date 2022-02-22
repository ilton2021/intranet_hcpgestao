@extends('layouts.adm')
<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR DESTAQUES:</h3>
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
						Alterar Destaques: <i class="fas fa-check-circle"></i>
					</a>
				</div>
				<form action="{{\Request::route('updateDestaques')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<table border="0" class="table-sm" style="line-height: 1.5;">
						<tr>
							<td> Título: </td>
							<td>
								<input class="form-control" type="text" id="titulo" name="titulo" required value="<?php echo $destaques[0]->titulo; ?>" />
							</td>
						</tr>
						<tr>
							<td> Imagem: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem_" name="imagem_" readonly value="<?php echo $destaques[0]->imagem; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem" name="imagem" value="" />
							</td>
						</tr>
						<tr>
							<td> Data Início: </td>
							<td>
								<input class="form-control" type="date" id="data_inicio" name="data_inicio" required value="<?php echo $destaques[0]->data_inicio; ?>" />
							</td>
						</tr>
						<tr>
							<td> Data Fim: </td>
							<td>
								<input class="form-control" type="date" id="data_fim" name="data_fim" required value="<?php echo $destaques[0]->data_fim; ?>" />
							</td>
						</tr>
						<tr>
							<td> Texto: </td>
							<td>
								<textarea class="form-control" rows="5" type="text" id="texto" name="texto" required value="<?php echo $destaques[0]->texto; ?>"> {{ $destaques[0]->texto }} </textarea>
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
									<?php
									$marcado = '';
									if (in_array($unidade->id, $und_atual))
										$marcado = 'checked';
									?>
									<input type='checkbox' id="unidade_id[]" class="unidade" name="unidade_id[]" <?php echo $marcado; ?> value="<?php echo $unidade->id; ?>" /> {{$unidade->sigla}} &nbsp;&nbsp;</input>
									@endforeach
								</li>
							</td>
						</tr>
						<tr>
							<td> Imagem 2: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem2_" name="imagem2_" readonly value="<?php echo $destaques[0]->imagem2; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem2" name="imagem2" value="" />
							</td>
						</tr>
						<tr>
							<td> Imagem 3: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem3_" name="imagem3_" readonly value="<?php echo $destaques[0]->imagem3; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem3" name="imagem3" value="" />
							</td>
						</tr>
						<tr>
							<td> Imagem 4: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem4_" name="imagem4_" readonly value="<?php echo $destaques[0]->imagem4; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem4" name="imagem4" value="" />
							</td>
						</tr>
						<tr>
							<td> Imagem 5: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem5_" name="imagem5_" readonly value="<?php echo $destaques[0]->imagem5; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem5" name="imagem5" value="" />
							</td>
						</tr>
						<tr>
							<td> Imagem 6: </td>
							<td>
								<input class="form-control" style="width: 750px" type="text" id="imagem6_" name="imagem6_" readonly value="<?php echo $destaques[0]->imagem6; ?>" />
								<input class="form-control" style="width: 750px" type="file" id="imagem6" name="imagem6" value="" />
							</td>
						</tr>
						<tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="alterar_destaques" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
					</table>
					<table>
						<tr>
							<td><br> <a href="{{ route('cadastroDestaques') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
								<input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	</body>