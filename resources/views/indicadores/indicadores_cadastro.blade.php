@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO INDICADORES:</b></h5>
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
			<form action="{{ route('pesquisarIndicadores') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control">
						<option id="pesq2" name="pesq2" value="1">NOME</option>
						<option id="pesq2" name="pesq2" value="2">GRUPO</option>
						<option id="pesq2" name="pesq2" value="3">UNIDADE</option>
						<option id="pesq2" name="pesq2" value="4">LINK</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-info btn-sm" style="color: #FFFFFF;" href="{{route('cadastroGrupoIndicadores')}}"> Cadastro Grupos </a>
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('indicadoresNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="400px">NOME</th>
						<th scope="col">GRUPO</th>
						<th scope="col">LINK</th>
						<th scope="col">UNIDADE</th>
						<th scope="col"><center>VINCULAR PERFIL</center></th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($indicadores as $indicador)
					<tr>
						<td style="font-size: 15px;">{{$indicador->nome}}</td>
						@foreach($grupo_indicadores as $grupo)
						@if($grupo->id == $indicador->grupo_id)
						<td style="font-size: 15px;">{{$grupo->nome}}</td>
						@endif
						@endforeach
						<td style="font-size: 15px;">{{substr($indicador->link,0,30)}}</td>
						<td style="font-size: 15px;">
						<center><?php 
							for ($i=0 ; $i < sizeof($unidades); $i++ ) { 
								if($indicador->unidade_id == $unidades[$i]->id){
									echo $unidades[$i]->sigla;
								}
							}
						?></center>
						</td>
						<td><center><a class="btn btn-success btn-sm" href="{{ route('indicadorVincular', $indicador->id) }}" ><i class="fas fa-check"></i></a></center></td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('indicadoresAlterar', $indicador->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('indicadoresExcluir', $indicador->id) }}" ><i class="fas fa-times-circle"></i></center></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<table>
			 <tr>
			  <td> {{ $indicadores->appends(['pesq' => isset($pesq) ? $pesq : '','pesq2' => isset($pesq2) ? $pesq2 : ''])->links() }} </td>
			 </tr> 
		 	</table>
		</div>
	</div> 
</div>
</div>
</div>
</body>