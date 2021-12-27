@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR PROTOCOLOS INSTITUCIONAIS:</h3>
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
                        Alterar Protocolos Institucionais: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('updateProtocolos')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="<?php echo $protocolos[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							 <td> Setor: </td>
							 <td>
								 <select class="form-control" id="setor" name="setor">
									@foreach($setores as $setor)
									 @if($setor->nome == $protocolos[0]->setor)
									  <option id="setor" name="setor" value="<?php echo $setor->nome; ?>" selected>{{ $setor->nome }}</option>
									 @else
									  <option id="setor" name="setor" value="<?php echo $setor->nome; ?>">{{ $setor->nome }}</option>
									 @endif
									@endforeach
								 </select>
							 </td>
						 </tr>
						 <tr>
							<td> Imagem: </td>
							<td> 
							  <input class="form-control" style="width: 750px" type="text" id="imagem_" name="imagem_" readonly value="<?php echo $protocolos[0]->imagem; ?>" /> 
                              <input class="form-control" style="width: 750px" type="file" id="imagem" name="imagem" value="" /> 
							</td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroProtocolos') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>