@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO USUÁRIOS:</b></h5>
		</div>
	</div>	
	@if ($errors->any())
		<div class="alert alert-success">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-12">
			<table class="table" id="table_pesq">
			<form action="{{ route('pesquisarUsuarios') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control">
						<option id="pesq2" name="pesq2" value="1">NOME</option>
						<option id="pesq2" name="pesq2" value="2">E-MAIL</option>
						<option id="pesq2" name="pesq2" value="3">PERFIL</option>
						<option id="pesq2" name="pesq2" value="4">UNIDADE</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-info btn-sm" style="color: #FFFFFF;" href="{{route('cadastroPerfilUsuarios')}}"> Novo Perfil </a>
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('usuariosNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="300px">NOME</th>
                        <th scope="col" width="300px">E-MAIL</th>
						<th scope="col" width="150px">PERFIL</th>
						<th scope="col" width="150px">Unidade</th>
						<th scope="col" width="50px"><center>ALTERAR</center></th>
						<th scope="col" width="50px"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
					<tr>
						<td style="font-size: 15px;">{{$usuario->name}}</td>
                        <td style="font-size: 15px;">{{$usuario->email}}</td>
						<td style="font-size: 15px;">{{$usuario->perfil}}</td>
						<td style="font-size: 15px;">{{$usuario->unidade}}</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('usuariosAlterar', $usuario->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('usuariosExcluir', $usuario->id) }}" ><i class="fas fa-times-circle"></i></center></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div> 
</div>
</div>
</div>
</body>