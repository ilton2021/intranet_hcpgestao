@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO E-MAILS:</b></h5>
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
			<form action="{{ route('pesquisarEmails') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 170px;" class="form-control">
					    <option id="pesq2" name="pesq2" value="1">FUNCIONÁRIO</option>
						<option id="pesq2" name="pesq2" value="2">E-MAIL</option>
						<option id="pesq2" name="pesq2" value="3">UNIDADE</option>
					 </select>
                    </td>
                    <td> 
					 <input style="margin-left: -10px; margin-top: 4x;" type="submit" id="btn" name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('emailsNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="600px">FUNCIONÁRIO</th>
						<th scope="col">E-MAIL</th>
						<th scope="col">UNIDADE</th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($emails as $email)
					<tr>
						<td style="font-size: 15px;">{{$email->nome}}</td>
						<td style="font-size: 15px;">{{$email->email}}</td>
						<td style="font-size: 15px;">
						<?php 
							for ($i=0 ; $i < sizeof($unidades); $i++ ) { 
								if($email->unidade_id == $unidades[$i]->id){
									echo $unidades[$i]->sigla;
								}
							}
						?>
						</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('emailsAlterar', $email->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('emailsExcluir', $email->id) }}" ><i class="fas fa-times-circle"></i></center></td>
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