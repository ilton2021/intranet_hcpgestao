@extends('layouts.adm') 
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO DESTAQUES:</b></h5>
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
	<div class="row">
		<div class="col-md-12">
			<table class="table" id="table_pesq">
			<form action="{{ route('pesquisarDestaques') }}" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td style="width: 400px;"> 
					 <input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control form-control-sm" />
                    </td>
                    <td style="width: 150px;">
					 <select id="pesq2" name="pesq2" style="width: 150px;" class="form-control form-control-sm">
						<option id="pesq2" name="pesq2" value="1">TÍTULO</option>
						<option id="pesq2" name="pesq2" value="2">TEXTO</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('destaquesNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="200px">TÍTULO</th>
						<th scope="col" width="300px">TEXTO</th>
						<th scope="col" width="6px"><center>ALTERAR</center></th>
						<th scope="col" width="6px"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($destaques as $destaque)
					<tr>
						<td style="font-size: 15px;">{{$destaque->titulo}}</td>
						<td style="font-size: 15px; max-width: 25ch; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;">{{substr($destaque->texto, 0, 300)}}</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('destaquesAlterar', $destaque->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('destaquesExcluir', $destaque->id) }}" ><i class="fas fa-times-circle"></i></center></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<table>
			 <tr>
			  <td> {{ $destaques->appends(['pesq' => isset($pesq) ? $pesq : '','pesq2' => isset($pesq2) ? $pesq2 : ''])->links() }} </td>
			 </tr> 
		 	</table>
		</div>
	</div> 
</div>
</div>
</div>
</body>