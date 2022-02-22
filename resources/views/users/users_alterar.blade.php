@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">ALTERAR USUÁRIOS:</h3>
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
                        Alterar Usuários: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('alterarUsuarios')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control" style="width: 500px;" type="text" id="name" name="name" required value="<?php echo $usuarios[0]->name; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> E-mail: </td>
							<td>
								<input class="form-control" type="text" id="email" name="email" required value="<?php echo $usuarios[0]->email; ?>" />
							</td>
						 </tr>
						 <tr>
							<td>PERFIL: </td>
							<td>
								<select id="perfil" name="perfil" class="form-control">
									@foreach($perfil_users as $perfil)
									 @if($perfil->nome == $usuarios[0]->perfil)
									  <option id="perfil" name="perfil" value="<?php echo $perfil->nome; ?>" selected>{{ $perfil->nome }}</option>
									  @else
									  <option id="perfil" name="perfil" value="<?php echo $perfil->nome; ?>">{{ $perfil->nome }}</option>
									 @endif
									@endforeach
								</select>
							</td>
						 </tr>
						 <tr>
							<td> UNIDADE: </td>
							<td>
								<select class="form-control" id="unidade_id" name="unidade_id">
									@foreach($unidades as $unidade)
									<?php
									$selected = '';
									if ($usuarios[0]->unidade_id == $unidade->id) {
										$selected = 'selected';
									}
									?>
									<option id="unidade_id" name="unidade_id" <?php echo $selected; ?> value="{{$unidade->id}}">{{ $unidade->sigla }}</option>
									@endforeach
								</select>
							</td>
						 </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="alterar_usuarios" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
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