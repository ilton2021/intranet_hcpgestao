@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO USUÁRIO:</h3>
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
                        Setores: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('storeUsuarios')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" style="width: 400px;" type="text" id="name" name="name" required value="{{ old('name') }}" />
							</td>
						 </tr>
                         <tr>
							<td> E-mail: </td>
							<td>
								<input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" />
							</td>
						 </tr>
						 <tr>
							<td>PERFIL: </td>
							<td>
								<select id="perfil" name="perfil" class="form-control">
									@foreach($perfil_users as $perfil)
									  <option id="perfil" name="perfil" value="<?php echo $perfil->nome; ?>">{{ $perfil->nome }}</option>
									@endforeach
								</select>
							</td>
						 </tr>
						 <tr>
							 <td>UNIDADE: </td>
							 <td>
								 <select id="unidade_id" name="unidade_id" class="form-control">
								 @foreach($unidades as $unidade)
								  <option id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">{{ $unidade->sigla }}</option>
								 @endforeach
								 </select>
							 </td>
						 </tr>
						 <tr>
							<td> Senha: </td>
							<td>
								<input class="form-control" style="width: 400px;" type="password" id="password" name="password" required value="{{ old('password') }}" />
							</td>
						 </tr>
						 <tr>
							<td> Confirmar Senha: </td>
							<td>
								<input class="form-control" style="width: 400px;" type="password" id="password_confirmation" name="password_confirmation" required value="{{ old('password_confirmation') }}" />
							</td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroUsuarios') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>