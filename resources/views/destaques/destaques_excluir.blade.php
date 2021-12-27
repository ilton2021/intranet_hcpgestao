@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">EXCLUIR DESTAQUE:</h3>
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
                        Excluir Destaque: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('destroyDestaques')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Título: </td>
							<td>
								<input class="form-control" type="text" id="titulo" name="titulo" readonly value="<?php echo $destaques[0]->titulo; ?>" />
							</td>
						 </tr>
                         <tr>
							<td> Texto: </td>
							<td>
								<textarea class="form-control" rows="5" type="text" id="texto" name="texto" readonly value="<?php echo $destaques[0]->texto; ?>"> {{ $destaques[0]->texto }} </textarea>
							</td>
						 </tr>
						 <tr>
							 <td>Imagem:</td>
							 <td>
							    <input class="form-control" style="width: 750px" type="text" id="imagem" name="imagem" readonly value="<?php echo $destaques[0]->imagem; ?>" /> 
							 </td>
						 </tr>
                         <tr>
                            <td colspan="4"><br><b>Deseja Realmente Excluir este Destaque?</b></td>
                         </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroDestaques') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>