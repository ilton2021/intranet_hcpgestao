@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO DE PERMISSÕES:</b></h5>
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
			<form action="{{ route('pesquisarPermissoes') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control">
						<option id="pesq2" name="pesq2" value="1">TELA</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('cadastroPermissaoNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="600px">TELA</th>
						<th scope="col"><center>VINCULAR USUÁRIO</center></th>
						<th scope="col"><center>DESVINCULAR USUÁRIO</center></th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($permissoes as $permissao)
					<tr>
						<td style="font-size: 15px;">{{$permissao->tela}}</td>
						<td><center><a class="btn btn-success btn-sm" href="{{ route('permissaoVincular', $permissao->id) }}" ><i class="fas fa-check"></i></center></td>
						<td><center><a class="btn btn-danger btn-sm" href="{{ route('permissaoUserExcluir') }}" ><i class="fas fa-check"></i></center></td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('permissaoAlterar', $permissao->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('permissaoExcluir', $permissao->id) }}" ><i class="fas fa-times-circle"></i></center></td>
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