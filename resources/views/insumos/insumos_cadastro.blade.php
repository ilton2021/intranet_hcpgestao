@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO DE INSUMOS:</b></h5>
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
			<form action="{{ route('pesquisarInsumos', $id) }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td> 
					 <input type="text" id="pesq" name="pesq" class="form-control" />
                    </td>
                    <td>
					 <select id="pesq2" name="pesq2" class="custom-select mr-sm-2l">
						<option id="pesq2" name="pesq2" value="">Selecione...</option>
						<option id="pesq2" name="pesq2" value="1">NOME</option>
						<option id="pesq2" name="pesq2" value="2">TIPOS INSUMOS</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn" name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{route('cadastroCardapiosDia', $id)}}"> Voltar <i class="fas fa-undo-alt"></i> </a>
						@if(Auth::user()->perfil == "Administrador")
						<a class="btn btn-primary btn-sm" style="color: #FFFFFF;" href="{{route('cadastroTiposInsumos', $id)}}"> Tipo de Insumo <i class="fas fa-check"></i> </a>
						@endif
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('insumosNovo', $id)}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm" id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="600px">NOME</th>
						<th scope="col" width="500px"><center>TIPO DE INSUMOS</center></th>
						<th scope="col" width="300px"><center>TIPO DE REFEIÇÃO</center></th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody> 
					@foreach($insumos as $insumo)
					 <tr>
						<td style="font-size: 15px;">{{$insumo->nome}}</td>
						<td style="font-size: 15px;"><center>{{$insumo->nomeTp}}</center></td>
						@if($insumo->tipo_refeicao == 1)
						<td style="font-size: 15px;"><center>CAFÉ DA MANHÃ</center></td>
						@elseif($insumo->tipo_refeicao == 2)
						<td style="font-size: 15px;"><center>ALMOÇO</center></td>
						@else
						<td style="font-size: 15px;"><center>JANTAR</center></td>
						@endif
						<td><center><a class="btn btn-info btn-sm" href="{{ route('insumosAlterar', array($id, $insumo->id)) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('insumosExcluir', array($id, $insumo->id)) }}" ><i class="fas fa-times-circle"></i></center></td>
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