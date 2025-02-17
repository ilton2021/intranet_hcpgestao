@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO SETOR - DOCUMENTOS DE QUALIDADE:</h3>
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
                        Setor: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('storeSetorDocumento')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table table-sm">
						 <tr>
							<td> Setor: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="setor" name="setor" required value="{{ old('setor') }}" />
							</td>
						 </tr>
						 <tr>
							<td> Sigla: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="sigla" name="sigla" required value="{{ old('sigla') }}" />
							</td>
						 </tr>
						 <tr>
                            <td>Unidade:</td>
                            <td>
                         	    <select id="unidade_id" name="unidade_id" class="form-control form-control-sm">
								  <option value="">Selecione...</option>	
									@foreach ($unidades as $unidade)
									  <option value="<?php echo $unidade->id; ?>">{{ $unidade->sigla }}</option>
									@endforeach
								</select>
                            </td>
                         </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_setores" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('setorDocumento') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>