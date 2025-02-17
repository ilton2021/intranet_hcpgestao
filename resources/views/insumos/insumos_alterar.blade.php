@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR INSUMOS:</h3>
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
                        Alterar Insumos: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{ route('updateInsumos', array($id, $insumos[0]->id)) }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Tipos de Insumos: </td>
							<td>
								<select class="form-control" style="width: 500px;" id="tipos_insumos" name="tipos_insumos" required>
								  @foreach($tiposInsumos as $tipos)
								   @if($tipos->id == $insumos[0]->tipos_insumos_id)
								     <option value="<?php echo $tipos->id; ?>" selected>{{ $tipos->nome }}</option>
								   @else
								     <option value="<?php echo $tipos->id; ?>">{{ $tipos->nome }}</option>
								   @endif
								  @endforeach
								</select>
							</td>
						 </tr> 
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="<?php echo $insumos[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="alterar_insumos" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroInsumos', $id) }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>