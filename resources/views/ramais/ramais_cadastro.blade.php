@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO RAMAIS:</b></h5>
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
			<form action="{{ route('pesquisarRamais') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control">
						<option id="pesq2" name="pesq2" value="1">SALA</option>
						<option id="pesq2" name="pesq2" value="2">TELEFONE</option>
						<option id="pesq2" name="pesq2" value="3">UNIDADE</option>
					 </select>
                    </td>
					<td style="width: 150px;">
					 <select id="unidade" name="unidade" style="width: 150px;" class="form-control">
					 	@foreach($unidades as $und)
						<option id="unidade" name="unidade" value="<?php echo $und->id;?>">{{$und->sigla}}</option>
						@endforeach 
					</select>
					</td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('ramaisNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col">RAMAL</th>
						<th scope="col" width="300px">SALA</th>
						<th scope="col" width="300px">SETOR</th>
						<th scope="col">UNIDADE</th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($ramais as $ramal)
					<tr>
						<td style="font-size: 15px;">{{$ramal->telefone}}</td>
						<td style="font-size: 15px;">{{$ramal->nome}}</td>
						<td style="font-size: 15px;">
						<?php 
							for ($i=0 ; $i < sizeof($setores); $i++ ) { 
								if($ramal->setor_id == $setores[$i]->id){
									echo $setores[$i]->nome;
								}
							}
						?>
						</td>
						<td style="font-size: 15px;">
						<?php 
							for ($i=0 ; $i < sizeof($unidades); $i++ ) { 
								if($ramal->unidade_id == $unidades[$i]->id){
									echo $unidades[$i]->sigla;
								}
							}
						?>
						</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('ramaisAlterar', $ramal->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('ramaisExcluir', $ramal->id) }}" ><i class="fas fa-times-circle"></i></center></td>
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