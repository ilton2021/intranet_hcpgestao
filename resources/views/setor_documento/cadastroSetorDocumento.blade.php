@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO SETOR DOCUMENTO:</b></h5>
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
			<form action="{{ route('pesquisarSetoresDocumentos') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="nomeSetor" name="nomeSetor" style="width: 400px;" class="form-control form-control-sm" />
                    </td>
					<td style="width: 20px; justify-content: center;">
						<b>Unidade:</b>
					</td>
					<td style="width: 350px;">
						<label for="">
							<select name="unidade" id="unidade" class="form-control form-control-sm">
								<option value=""></option>
								@foreach($unidades as $unidade)
									<option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
								@endforeach
							</select>
						</label>
					</td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-reply"></i> </a> &nbsp;
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{ route('novoSetorDocumento') }}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col">SETOR</th>
						<th scope="col">SIGLA</th>
						<th scope="col">UNIDADE</th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($setores as $setor)
						<tr>
							<td style="font-size: 15px;">{{ $setor->setor }}</td>
							<td style="font-size: 15px;">{{ $setor->sigla }}</td>
							<td style="font-size: 15px;">{{ $setor->unidade }}</td>
							<td><center><a class="btn btn-info btn-sm" href="{{ route('alterarSetorDocumento', $setor->id) }}"><i class="fas fa-edit"></i></center></td>
							<td><center><a class="btn btn-danger btn-sm" href="{{ route('deleteSetorDocumento', $setor->id) }}"><i class="fas fa-times-circle"></i></center></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@if($paginate == True)
		<table>
			<tr>
			<td> {{ $setores->links() }} </td>
			</tr> 
		</table>
		@endif
	</div> 
</div>
</div>
</div>
</body>