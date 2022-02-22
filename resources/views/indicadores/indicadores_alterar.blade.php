@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR INDICADORES:</h3>
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
                        Alterar Indicadores: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('updateIndicadores')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" style="width: 600px;" required value="<?php echo $indicadores[0]->nome; ?>" />
							</td>
						 </tr> 
						 <tr>
							<td> Grupo: </td>
							<td>
								<select class="form-control" id="grupo_id" name="grupo_id">
								  @foreach($grupo_indicadores as $grupo)
								   @if($grupo->id == $indicadores[0]->grupo_id)
								  	<option id="grupo_id" name="grupo_id" value="<?php echo $grupo->id; ?>" selected>{{ $grupo->nome }}</option>
								   @else
								    <option id="grupo_id" name="grupo_id" value="<?php echo $grupo->id; ?>">{{ $grupo->nome }}</option>
								   @endif
								  @endforeach
								</select>
							</td>
						 </tr>
						 <tr>
							<td> Status: </td>
							<td>
								<input class="form-control" type="text" id="status" name="status" required value="<?php echo $indicadores[0]->status; ?>" />
							</td>
						 </tr>
						 
                         <tr>
							<td> Link: </td>
							<td>
								<textarea class="form-control" type="text" id="link" name="link" required rows="5" value="<?php echo $indicadores[0]->link; ?>">{{ $indicadores[0]->link }}</textarea>
							</td>
						 </tr>
						 <tr>
							<td> Unidade: </td>
							<td>
								<select id="unidade_id" name="unidade_id" class="form-control">
								@foreach($unidades as $unidade)
									@if($unidade->id == $indicadores[0]->unidade_id)
									 <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>" selected>{{ $unidade->sigla }}</option>
									@else
									 <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->sigla }}</option>
									@endif
								@endforeach
								</select>
							</td>
						 </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="alterar_indicadores" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroIndicadores') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>