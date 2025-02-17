<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO CARDÁPIO DO DIA:</h3>
		</div>
	</div>
	@if ($errors->any())
		<div class="alert alert-danger">
		  <ul>
		    @foreach ($errors->all() as $error)
		      <li>{{ $error }}</li>
			@endforeach
		  </ul>
		</div>
	@endif
	<div class="row" style="margin-top: 25px;">
	  <div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
		 <div class="accordion" id="accordionExample">
            <div class="card">
             <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                Cardápio do Dia: <i class="fas fa-check-circle"></i>
             </a>
            </div>	
			<br>
			 <form action="{{route('storeCardapiosDia', $id)}}" method="post">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			   <div class="form-row align-items-center">
			    <div class="col-md-4 mb-3">
			 	 <b>DATA:</b>
				 <input type="date" class="form-control" id="dia" name="dia" required value="{{ old('dia') }}"> 
				</div>
				<div class="col-md-4 mb-3">
				 <b>UNIDADE:</b>
				 @if(Auth::user()->perfil == "Administrador")
				 <select class="custom-select mr-sm-2" id="unidade_id" name="unidade_id" required>
				  <option value="" selected>Selecione...</option>
				  	@foreach($unidades as $unidade)
					 @if($unidade->id == old('unidade_id'))
  					  <option value="<?php echo $unidade->id; ?>" selected>{{ $unidade->nome }}</option>
					 @else
					  <option value="<?php echo $unidade->id; ?>">{{ $unidade->nome }}</option>
					 @endif
					@endforeach
				 </select>
				 @else
				  @foreach($unidades as $unidade)
					@if($unidade->id == Auth::user()->unidade_id)
					  <input hidden readonly class="form-control" type="text" id="unidade_id" name="unidade_id" value="<?php echo $unidade->id; ?>">
					  <input readonly class="form-control" type="text" id="unidade_id_" name="unidade_id_" value="<?php echo $unidade->nome; ?>">
					@endif
				  @endforeach
				 @endif
				</div>
				<div class="col-md-4 mb-3">
				 <b>TIPO REFEIÇÃO:</b>
				 <select readonly class="custom-select mr-sm-2" id="tipo_refeicao" name="tipo_refeicao" required>
				   @if($id == 1)
				   <option value="1" selected>CAFÉ DA MANHÃ</option>
				   @elseif($id == 2)
				   <option value="2" selected>ALMOÇO</option>
				   @else
				   <option value="3" selected>JANTAR</option>
				   @endif
				 </select>
				</div>
			   </div>
			 <br>
			 @if($id == 1)
			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
				<b>CAFÉ:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_1_id" name="insumos_1_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "CAFÉ")
					  @if($insumo->id == old('insumos_1_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>REFRESCO:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_2_id" name="insumos_2_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "REFRESCO")
					  @if($insumo->id == old('insumos_2_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				</select>
		      </div>
			  <div class="col-md-4 mb-3">
			  <b>FRUTAS:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_3_id" name="insumos_3_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "FRUTAS")
					  @if($insumo->id == old('insumos_3_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>
			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
			    <b>COMIDAS:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_4_id" name="insumos_4_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "COMIDAS")
					  @if($insumo->id == old('insumos_4_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_5_id" name="insumos_5_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_5_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PÃO:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_6_id" name="insumos_6_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "PÃO")
					  @if($insumo->id == old('insumos_6_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>
			 @elseif($id == 2) 
			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_1_id" name="insumos_1_id" required>
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_1_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA - OPÇÃO 2:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_2_id" name="insumos_2_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_2_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA - OPÇÃO 3:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_3_id" name="insumos_3_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_3_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>
			 <div class="form-row align-items-center">
			 <div class="col-md-4 mb-3">
			    <b>FEIJÃO:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_4_id" name="insumos_4_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "FEIJÃO")
					  @if($insumo->id == old('insumos_4_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>ARROZ:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_5_id" name="insumos_5_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "ARROZ")
					  @if($insumo->id == old('insumos_5_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>MACARRÃO:</b> 
			  	 <select class="custom-select mr-sm-2" id="insumos_6_id" name="insumos_6_id">
				  <option value="" selected>Selecione...</option>
				 	@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "MACARRÃO")
					  @if($insumo->id == old('insumos_6_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>

			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
			    <b>FAROFA:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_7_id" name="insumos_7_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "FAROFA") 
					  @if($insumo->id == old('insumos_7_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>REFRESCO:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_8_id" name="insumos_8_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "REFRESCO")
					  @if($insumo->id == old('insumos_8_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				</select>
		      </div>
			  <div class="col-md-4 mb-3">
		  	    <b>SALADA:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_9_id" name="insumos_9_id">
				  <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "SALADA")
					  @if($insumo->id == old('insumos_9_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>SOBREMESA:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_10_id" name="insumos_10_id">
				  <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "SOBREMESA")
					  @if($insumo->id == old('insumos_10_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  @if(Auth::user()->unidade_id == 6)
			  <div class="col-md-4 mb-3">
			    <b>FEIJÃO - OPÇÃO 2:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_11_id" name="insumos_11_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "FEIJÃO")
					  @if($insumo->id == old('insumos_11_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  @endif
			 </div>

			 @else

			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
			    <b>COMIDAS:</b> 
			 	 <select class="custom-select mr-sm-2" id="insumos_1_id" name="insumos_1_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
					 @if($insumo->nomeTipo == "COMIDAS")
					  @if($insumo->id == old('insumos_1_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_2_id" name="insumos_2_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_2_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>PROTEÍNA - OPÇÃO 2</b> 
				 <select class="custom-select mr-sm-2" id="insumos_3_id" name="insumos_3_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "PROTEÍNA")
					  @if($insumo->id == old('insumos_3_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>

			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
				<b>CAFÉ:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_4_id" name="insumos_4_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "CAFÉ")
					  @if($insumo->id == old('insumos_4_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>REFRESCO:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_5_id" name="insumos_5_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "REFRESCO")
					  @if($insumo->id == old('insumos_5_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>SOPA:</b>
			 	 <select class="custom-select mr-sm-2" id="insumos_6_id" name="insumos_6_id">
			  	   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo) 
			 		 @if($insumo->nomeTipo == "SOPA")
					  @if($insumo->id == old('insumos_6_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>
			 
			 <div class="form-row align-items-center">
			  <div class="col-md-4 mb-3">
				<b>PÃO:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_7_id" name="insumos_7_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "PÃO")
					  @if($insumo->id == old('insumos_7_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			  <div class="col-md-4 mb-3">
				<b>RECHEIO:</b> 
				 <select class="custom-select mr-sm-2" id="insumos_8_id" name="insumos_8_id">
				   <option value="" selected>Selecione...</option>
					@foreach($insumos as $insumo)
					 @if($insumo->nomeTipo == "RECHEIO")
					  @if($insumo->id == old('insumos_8_id'))
					   <option value="<?php echo $insumo->id; ?>" selected>{{ $insumo->nome }}</option>
					  @else
					   <option value="<?php echo $insumo->id; ?>">{{ $insumo->nome }}</option>
					  @endif
					 @endif
					@endforeach
				 </select>
			  </div>
			 </div>
			 @endif
			 <div class="form-row align-items-center">
			  <div class="col-md-12 mb-3">
			    <a href="{{ route('cadastroCardapiosDia', $id) }}" id="VOLTAR" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; margin-left: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a>
			    <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="SALVAR" id="Salvar" name="Salvar" /> 
			  </div>
			 </div>
				
			 <table>
			  <tr>
			    <td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_cardapio_dia" /></td>
			    <td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
			    <td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
				<td><input hidden type="text" id="inativa" name="inativa" class="form-control" value="" /> </td>
			  </tr>
             </table>
			</form>
		</div>
    </div>
</div>
</body>