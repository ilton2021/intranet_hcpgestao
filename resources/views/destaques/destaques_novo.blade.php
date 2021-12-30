@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO DESTAQUES:</h3>
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
                        Destaques: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('storeDestaques')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
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
							<td> Texto: </td>
							<td>
								<textarea class="form-control" rows="5" type="text" id="texto" name="texto" required value="{{ old('texto') }}"> </textarea>
							</td>
						 </tr>
						 <tr>
							<td> Imagem 2: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="file" id="imagem2" name="imagem2" value="" /> 
							</td>
						 </tr>
						 <tr>
							<td> Imagem 3: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="file" id="imagem3" name="imagem3" value="" /> 
							</td>
						 </tr>
						 <tr>
							<td> Imagem 4: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="file" id="imagem4" name="imagem4" value="" /> 
							</td>
						 </tr>
						 <tr>
							<td> Imagem 5: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="file" id="imagem5" name="imagem5" value="" /> 
							</td>
						 </tr>
						 <tr>
							<td> Imagem 6: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="file" id="imagem6" name="imagem6" value="" /> 
							</td>
						 </tr>
                        </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroDestaques') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>