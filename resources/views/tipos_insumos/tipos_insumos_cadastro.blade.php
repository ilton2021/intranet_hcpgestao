@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO TIPO DE INSUMOS:</b></h5>
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
			<table class="table table-sm" id="table_pesq">
			<form action="{{ route('pesquisarTiposInsumos', $id) }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td> 
					 <input type="text" id="pesq" name="pesq" class="form-control" />
                    </td>
                    <td>
					 <select id="pesq2" name="pesq2" class="custom-select mr-sm-2">
						<option id="pesq2" name="pesq2" value="1">NOME</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn" name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{route('cadastroInsumos', $id)}}"> Voltar <i class="fas fa-undo-alt"></i> </a>
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('tiposInsumosNovo', $id)}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm" id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="1000px">NOME</th>
						<th scope="col" width="400px">TIPO REFEIÇÃO</th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tiposInsumos as $tInsumo)
					<tr>
						<td style="font-size: 15px;">{{$tInsumo->nome}}</td>
						@if($id == 1)
						 <td style="font-size: 15px;">CAFÉ DA MANHÃ</td>
						@elseif($id == 2)
						 <td style="font-size: 15px;">ALMOÇO</td>
						@else
						 <td style="font-size: 15px;">JANTAR</td>
						@endif
						<td><center><a class="btn btn-info btn-sm" href="{{ route('tiposInsumosAlterar', array($id, $tInsumo->id)) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('tiposInsumosExcluir', array($id, $tInsumo->id)) }}" ><i class="fas fa-times-circle"></i></center></td>
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