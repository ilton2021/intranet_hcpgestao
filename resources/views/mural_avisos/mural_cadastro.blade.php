@extends('layouts.adm') 
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO MURAL DE AVISOS:</b></h5>
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
			<form action="{{ route('pesquisarMural') }}" method="post">
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
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('muralNovo')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm " id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="600px">TÍTULO</th>
						<th scope="col">TEXTO</th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($murais as $mural)
					<tr>
						<td style="font-size: 15px;">{{$mural->titulo}}</td>
						<td style="font-size: 15px;">{{$mural->texto}}</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('muralAlterar', $mural->id) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('muralExcluir', $mural->id) }}" ><i class="fas fa-times-circle"></i></center></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<table>
			 <tr>
			  <td> {{ $murais->appends(['pesq' => isset($pesq) ? $pesq : '','pesq2' => isset($pesq2) ? $pesq2 : ''])->links() }} </td>
			 </tr> 
		 	</table>
		</div>
	</div> 
</div>
</div>
</div>
</body>