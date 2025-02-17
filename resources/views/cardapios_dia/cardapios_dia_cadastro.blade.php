<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
@extends('layouts.adm') 
<div class="container-fluid">
	<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO CARDÁPIOS DO DIA (<?php if($id == 1) { echo 'CAFÉ DA MANHÃ'; } elseif($id == 2) { echo 'ALMOÇO'; } else { echo 'JANTAR'; } ?>):</b></h5>
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
			 <form action="{{ route('pesquisarCardapiosDia', $id) }}" method="post">
			 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td> 
					 <input type="date" id="pesq" name="pesq" class="form-control" />
                    </td>
                    <td>
					 <select id="pesq2" name="pesq2" class="custom-select mr-sm-2">
						<option id="pesq2" name="pesq2" value="1">DIA</option>
					 </select>
                    </td>
                    <td> 
					 <input type="submit" id="btn" name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>
					<td>
					 <p align="right">
					  <a class="btn btn-info btn-sm" style="color: #FFFFFF;" href="{{ route('avaliacaoCardapio', $id) }}"> Gráfico <i class="fas fa-list-ol"></i> </a> 
					 </p>
					</td>	
					<td>
					  <p align="right">
					 	<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ route('cadastroCardapiosDiaInicio') }}"> Voltar <i class="fas fa-undo-alt"></i> </a>
						<a class="btn btn-primary btn-sm" style="color: #FFFFFF;" href="{{route('cadastroInsumos',$id)}}"> Insumo <i class="fas fa-check"></i> </a>
						<a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('cardapiosDiaNovo', $id)}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
			<table class="table table-sm" id="my_table">
				<thead class="bg-success">
					<tr>
						<th scope="col" width="300px">DIA</th>
						<th scope="col" width="600px"><center>CARDÁPIO</center></th>
						<th scope="col"><center>ALTERAR</center></th>
						<th scope="col"><center>EXCLUIR</center></th>
					</tr>
				</thead>
				<tbody> <?php $a = 0; ?>
					@foreach($cardapiosDia as $cardapio) 
					<tr>
						<td style="font-size: 15px;">{{ date('d/m/Y', strtotime($cardapio->dia))}}</td>
						<td style="font-size: 15px;">
						<center>
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $cardapio->id; ?>">
						 CARDÁPIO
						</button>
					 	</center>
						<div class="modal fade" id="exampleModal_<?php echo $cardapio->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
							    <h1 class="modal-title fs-5" id="exampleModalLabel">CARDÁPIO DO DIA: <?php echo date('d/m/Y', strtotime($cardapiosDia[$a]->dia)); ?></h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							@if($id == 1)
							<div class="modal-body">
								@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_1_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_1_id" name="insumos_1_id" value="<?php echo 'CAFÉ: '. $insumo->nome; ?>" style="font-weight: bold;" />
								    </div>
							  	  </div>
								 @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_2_id == $insumo->id)
								  <div class="form-row align-items-center">
							  		<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_2_id" name="insumos_2_id" value="<?php echo 'REFRESCO: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div> 
							  	  </div>
								 @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_3_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_3_id" name="insumos_3_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_6_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
							     @endif
								@endforeach
								@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_4_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_5_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_5_id" name="insumos_5_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
							     @endif
								@endforeach	
							@elseif($id == 2)
							<div class="modal-body">
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_1_id == $insumo->id)
								  <div class="form-row align-items-center">
								   <div class="col-md-8 mb-3">
								 	 <input readonly type="text" class="form-control form-control-sm" id="insumos_1_id" name="insumos_1_id" value="<?php echo $insumo->nome .' (OPÇÃO 1)'; ?>" style="font-weight: bold;" />
								   </div> 
								  </div>
								 @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_2_id == $insumo->id)
								  <div class="form-row align-items-center">
									<div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_2_id" name="insumos_2_id" value="<?php echo $insumo->nome .' (OPÇÃO 2)'; ?>" style="font-weight: bold;" />
									</div> 
								  </div>
								 @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_3_id == $insumo->id)
								  <div class="form-row align-items-center">
							        <div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_3_id" name="insumos_3_id" value="<?php echo $insumo->nome .' (OPÇÃO 3)'; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
						    	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_4_id == $insumo->id)
								  <div class="form-row align-items-center">
							        <div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo 'FEIJÃO: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_11_id == $insumo->id)
								  <div class="form-row align-items-center">
							        <div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo 'FEIJÃO: '. $insumo->nome . ' (OPÇÃO 2)' ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
					  	 	    @foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_5_id == $insumo->id)
								  <div class="form-row align-items-center">
							  		<div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_5_id" name="insumos_5_id" value="<?php echo 'ARROZ: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div> 
							  	  </div>
							     @endif
								@endforeach
							    @foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_6_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-3">
							 		 <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo 'MACARRÃO: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div> 
							  	  </div>
								 @endif
								@endforeach
						        @foreach($insumos as $insumo) 
							 	 @if($cardapiosDia[$a]->insumos_7_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_7_id" name="insumos_7_id" value="<?php echo 'FAROFA: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
							     @endif
								@endforeach
							    @foreach($insumos as $insumo)
							     @if($cardapiosDia[$a]->insumos_8_id == $insumo->id)
							      <div class="form-row align-items-center">
							 		<div class="col-md-8 mb-3">
								     <input readonly type="text" class="form-control form-control-sm" id="insumos_8_id" name="insumos_8_id" value="<?php echo 'REFRESCO: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div> 
							  	  </div>
								 @endif
								@endforeach 
							 <div class="form-row align-items-center">
							    @foreach($insumos as $insumo) 
							     @if($cardapiosDia[$a]->insumos_9_id == $insumo->id)
								  
							    	<div class="col-md-4 mb-3">
							 		 <input readonly type="text" class="form-control form-control-sm" id="insumos_9_id" name="insumos_9_id" value="<?php echo 'SALADA: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div> 
							     @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_10_id == $insumo->id)
								 	<div class="col-md-4 mb-3">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_10_id" name="insumos_10_id" value="<?php echo 'SOBREMESA: '. $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	 @endif
								@endforeach
							 </div>
							@else
							<div class="modal-body">
							  	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_1_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
							 	 	 <input readonly type="text" class="form-control form-control-sm" id="insumos_1_id" name="insumos_1_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
								  	</div>
							  	  </div>
							     @endif
								@endforeach
							 	@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_2_id == $insumo->id)
								  <div class="form-row align-items-center">
							  		<div class="col-md-8 mb-2">
								 	 <input readonly type="text" class="form-control form-control-sm" id="insumos_2_id" name="insumos_2_id" value="<?php echo $insumo->nome .' (OPÇÃO 1)'; ?>" style="font-weight: bold;" />
								 	</div>
						      	  </div>
							     @endif
								@endforeach
						        @foreach($insumos as $insumo) 
							 	 @if($cardapiosDia[$a]->insumos_3_id == $insumo->id)
								  <div class="form-row align-items-center">
							        <div class="col-md-8 mb-2">
							 		 <input readonly type="text" class="form-control form-control-sm" id="insumos_3_id" name="insumos_3_id" value="<?php echo $insumo->nome .' (OPÇÃO 2)'; ?>" style="font-weight: bold;" />
									</div>
							 	  </div>
						 	     @endif
								@endforeach
								@foreach($insumos as $insumo) 
								 @if($cardapiosDia[$a]->insumos_4_id == $insumo->id)
								  <div class="form-row align-items-center">
							    	<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_4_id" name="insumos_4_id" value="<?php echo 'CAFÉ: ' .$insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_5_id == $insumo->id)
								  <div class="form-row align-items-center">
							   		<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_5_id" name="insumos_5_id" value="<?php echo 'REFRESCO: ' .$insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_6_id == $insumo->id)
								  <div class="form-row align-items-center">
							   		<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_6_id" name="insumos_6_id" value="<?php echo 'SOPA: ' .$insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_7_id == $insumo->id)
								  <div class="form-row align-items-center">
							   		<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_7_id" name="insumos_7_id" value="<?php echo $insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
								@foreach($insumos as $insumo)
								 @if($cardapiosDia[$a]->insumos_8_id == $insumo->id)
								  <div class="form-row align-items-center">
							   		<div class="col-md-8 mb-2">
									 <input readonly type="text" class="form-control form-control-sm" id="insumos_8_id" name="insumos_8_id" value="<?php echo 'RECHEIO: ' .$insumo->nome; ?>" style="font-weight: bold;" />
									</div>
							  	  </div>
								 @endif
								@endforeach
							 @endif
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
							</div>
						   </div>
						  </div>
						 </div>
						</td>
						<td><center><a class="btn btn-info btn-sm" href="{{ route('cardapiosDiaAlterar', array($id, $cardapio->id)) }}" ><i class="fas fa-edit"></i></center></td>
                        <td><center><a class="btn btn-danger btn-sm" href="{{ route('cardapiosDiaExcluir', array($id, $cardapio->id)) }}" ><i class="fas fa-times-circle"></i></center></td>
					</tr> <?php $a += 1; ?>
					@endforeach
				</tbody>
			</table>
		</div>
	</div> 
</div>
</div>
</div>
</body>