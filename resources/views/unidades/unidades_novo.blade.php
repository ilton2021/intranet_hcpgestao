@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVA UNIDADE:</h3>
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
                        Unidade: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('storeUnidade')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome Unidade: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="{{ old('nome') }}" />
							</td>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome_unidade" name="nome_unidade" value="{{ old('nome_unidade') }}" />
							</td>
						 </tr>
						 <tr>
							<td> Imagem: </td>
							<td> 
							  <input class="form-control" style="width: 400px" type="file" id="imagem" name="imagem" required value="" /> 
							</td>
							<td> Sigla: </td>
						    <td> 
						     <input class="form-control" style="width: 300px" type="text" id="sigla" name="sigla" required value="{{ old('sigla') }}" />
						    </td>
						 </tr>
					    <tr>
							<td> Horário: </td>
							<td>
								<input class="form-control" type="text" id="horario" name="horario" required value="{{ old('horario') }}" />
							</td>
							<td> Telefone: </td>
							<td>
								<input class="form-control" type="tel" id="telefone" name="telefone" required value="{{ old('telefone') }}" />
							</td>
						 </tr>
                         <tr>
							<td> Ouvidoria: </td>
							<td>
								<input class="form-control" type="text" id="ouvidoria" name="ouvidoria" required value="{{ old('ouvidoria') }}" />
							</td>
						 </tr>
                         <tr>
							<td> Texto: </td>
							<td>
								<textarea class="form-control" rows="5" type="text" id="texto" name="texto" required value="{{ old('texto') }}"> </textarea>
							</td>
							<td> Endereço: </td>
							<td>
								<textarea class="form-control" rows="5" type="text" id="endereco" name="endereco" required value="{{ old('endereco') }}"> </textarea>
							</td>
						 </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_unidades" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroUnidade') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>