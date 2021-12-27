@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR E-MAILS:</h3>
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
                        Alterar E-mails: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('updateEmails')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" type="text" id="nome" name="nome" required value="<?php echo $emails[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> E-mail: </td>
							<td>
								<input class="form-control" type="text" id="email" name="email" required value="<?php echo $emails[0]->email; ?>" />
							</td>
						 </tr>
						 <tr>
							 <td> UNIDADE: </td>
							 <td>
								 <select id="unidade" name="unidade" class="form-control">
								  @foreach($unidades as $unidade)
								   @if($unidade->nome == $emails[0]->unidade)
									<option id="unidade" name="unidade" value="<?php echo $unidade->nome; ?>" selected>{{ $unidade->nome }}</option>
								   @else
								    <option id="unidade" name="unidade" value="<?php echo $unidade->nome; ?>">{{ $unidade->nome }}</option>
								   @endif
								  @endforeach
								 </select>
							 </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroEmails') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>