@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR POLÍTICAS E NORMAS:</h3>
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
                        Alterar Políticas e Normas: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('updatePoliticas')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="nome" name="nome" required value="<?php echo $politicas[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> Sigla: </td>
							<td>
								<input class="form-control" type="text" id="sigla" name="sigla" required value="<?php echo $politicas[0]->sigla; ?>" />
							</td>
						 </tr>
                         <tr>
							<td> Arquivo: </td>
							<td> 
							  <input class="form-control form-control-sm" type="text" id="imagem_" name="imagem_" readonly value="<?php echo $politicas[0]->imagem; ?>" /> 
                              <input class="form-control form-control-sm" type="file" id="imagem" name="imagem" value="" /> 
							</td>
						 </tr>
						<tr>
							<td>Permite impressão ?</td>
							<td>
							<div class="d-flex align-items-center text-center">
								<input type="radio" id="imprimir" name="imprimir" value="1" {{$politicas[0]->imprimir == 1 ? "checked" : ""}}>
	  							<label for="imprimir">Sim</label>
	  							<input type="radio" id="imprimir" name="imprimir" value="0" {{$politicas[0]->imprimir == 0 ? "checked" : ""}}>
	  							<label for="imprimir">Não</label>
							</div>
							</td>
						 </tr>
						 <tr>
							<td>Setor: </td>
							<td>
								<div class="d-flex align-items-center text-center">
									<select name="setor_id" id="setor_id" class="form-control form-control-sm">
										<option value="">Selecione...</option>
										@foreach($setores as $setor)
											<option value="{{ $setor->id }}" <?php if($politicas[0]->setor_id == $setor->id ){ echo "selected";}?>>{{ strtoupper($setor->setor) }} | {{ $setor->unidade }}</option>
										@endforeach
									</select>
								</div>
							</td>
						 </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="alterar_politicas" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroPoliticas') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>