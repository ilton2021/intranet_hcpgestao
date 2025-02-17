<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HCP GESTÃO INTRANET - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="shortcut icon" href="{{ asset('assets/img/favico.png') }}" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <main id="main">
	<div class="container-fluid">
		<div class="row" style="margin-bottom: 25px; margin-top: 25px;">
			<div class="col-md-12 text-center">
				<h5  style="font-size: 18px;"><b>CADASTRO AVALIAÇÃO DE EXPERIÊNCIA:</b></h5>
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
				<form action="{{ route('pesquisarAvaliacaoExp') }}" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<tr>
						<td style="width: 400px;"> 
						<input type="text" id="pesq" name="pesq" style="width: 400px;" class="form-control" />
						</td>
						<td style="width: 150px;">
						<select id="pesq2" name="pesq2" style="width: 180px;" class="form-control">
							<option id="pesq2" name="pesq2" value="1">COLABORADOR</option>
							<option id="pesq2" name="pesq2" value="2">VAGA</option>
							<option id="pesq2" name="pesq2" value="3">GESTOR</option>
						</select>
						</td>
						<td> 
						<input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
						</td>	
						<td>
						<p align="right">
							<a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						</p>
						</td>
					</tr>
				</table>
				<table class="table table-sm " id="my_table">
					<thead class="bg-success">
						<tr>
							<th scope="col" width="200px">COLABORADOR</th>
							<th scope="col" width="300px">VAGA</th>
							<th scope="col" width="300px">GESTOR</th>
							<th scope="col" width="6px"><center>VISUALIZAR</center></th>
							<th scope="col" width="6px"><center>EXCLUIR</center></th>
						</tr>
					</thead>
					<tbody>
						@foreach($avaliacao as $av)
						<tr>
							<td style="font-size: 15px;">{{$av->colaborador}}</td>
							<td style="font-size: 15px; max-width: 25ch; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;">{{  $av->vaga }}</td>
							<td style="font-size: 15px;">{{$av->gestor}}</td>
							<td>
							<center>
							 <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $av->id; ?>"> <strong>Visualizar</strong> </button>
							  <div class="modal fade" id="exampleModal_<?php echo $av->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							    <div class="modal-dialog modal-xl">
								 <div class="modal-content">
									<div class="modal-header">
										<h3>Avaliação de Experiência</h3>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
								    <div class="modal-body">
									 <section id="portfolio-details" class="portfolio-details">
									  <div class="container">
									    <div class="row">
										 <div class="col m-2">
											<label for="recipient-colaborador" class="col-form-label">Nome do Colaborador: <label style="color: red">*</label></label>
											 <input type="text" class="form-control form-control-sm" id="colaborador" name="colaborador" value="<?php echo $av->colaborador; ?>" readonly>
										 </div>
										 <div class="col m-2">
											<label for="recipient-vaga" class="col-form-label">Vaga: <label style="color: red">*</label></label>
											 <input type="text" class="form-control form-control-sm" id="vaga" name="vaga" value="<?php echo $av->vaga; ?>" readonly>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
											<label for="recipient-gestor" class="col-form-label">Nome do Gestor: <label style="color: red">*</label></label>
											 <input type="text" class="form-control form-control-sm" id="gestor" name="gestor" value="<?php echo $av->gestor; ?>" readonly>
										 </div>
										 <div class="col m-2">
											<label for="recipient-unidade" class="col-form-label">Unidade da Vaga:<label style="color: red">*</label></label>
											@foreach($unidades as $und) @if($und->id == $av->unidade) <?php $unidade = $und->sigla; ?> @endif @endforeach
											 <input type="text" class="form-control form-control-sm" id="unidade" name="unidade" value="<?php  echo $unidade; ?>" readonly>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
											<label for="message-text" class="col-form-label">Continuidade do Colaborador<label style="color: red">*</label></label>
											<input type="text" class="form-control form-control-sm" id="continuidade" name="continuidade" value="<?php  echo $av->continuidade; ?>" readonly>
										 </div>
										 <div class="col m-2">
											<label for="message-text" class="col-form-label">Situação do Colaborador<label style="color: red">*</label></label>
											<input type="text" class="form-control form-control-sm" id="resultado" name="resultado" value="<?php  echo $av->resultado; ?>" readonly>
										 </div>
										 <div class="col m-2">
											<label for="recipient-area" class="col-form-label">Área: <label style="color: red">*</label></label>
											 <input type="text" class="form-control form-control-sm" id="area" name="area" value="<?php echo $av->area; ?>" readonly>
										 </div>
										</div>
									   </div> <hr>
									    <div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>1) CAPACIDADE PARA APRENDER: @if($av->capacidade == '1') 0-25% @elseif($av->capacidade == '2') 26-50% @elseif($av->capacidade == '3') 51-75% @elseif($av->capacidade == '4') > 76% @endif <br>
										    (Habilidade em reter/assimilar informações recebidas e usá-las adequadamente)</b></label>
										 </div> 
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>2) PRODUTIVIDADE: @if($av->produtividade == '1') 0-25% @elseif($av->produtividade == '2') 26-50% @elseif($av->produtividade == '3') 51-75% @elseif($av->produtividade == '4') > 76% @endif <br>
										    (Ritmo de trabalho, aliado ao rendimento e a qualidade com que o colaborador desenvolve as tarefas)</b></label>
										 </div> 
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>3) INICIATIVA: @if($av->iniciativa == '1') 0-25% @elseif($av->iniciativa == '2') 26-50% @elseif($av->iniciativa == '3') 51-75% @elseif($av->iniciativa == '4') > 76% @endif <br>
										    (Habilidade em agir/executar as tarefas e solucionar problemas sem necessidade de supervisão constante)</b></label>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>4) COLABORAÇÃO: @if($av->colaboracao == '1') 0-25% @elseif($av->colaboracao == '2') 26-50% @elseif($av->colaboracao == '3') 51-75% @elseif($av->colaboracao == '4') > 76% @endif <br>
										    (Disposição que o funcionário possui em ajudar a equipe e à empresa, de uma forma geral através de atitudes espontâneas)</b></label>
										 </div> 
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>5) RELACIONAMENTO: @if($av->relacionamento == '1') 0-25% @elseif($av->relacionamento == '2') 26-50% @elseif($av->relacionamento == '3') 51-75% @elseif($av->relacionamento == '4') > 76% @endif <br>
										    (Habilidade no trato com as pessoas, independente do nível hierárquico, influenciando positivamente e obtendo aceitação pessoal)</b></label>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>6) PONTUALIDADE: @if($av->pontualidade == '1') 0-25% @elseif($av->pontualidade == '2') 26-50% @elseif($av->pontualidade == '3') 51-75% @elseif($av->pontualidade == '4') > 76% @endif <br>
											(Cumprimento dos horários de trabalho)</b></label>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>7) ASSIDUIDADE: @if($av->assiduidade == '1') 0-25% @elseif($av->assiduidade == '2') 26-50% @elseif($av->assiduidade == '3') 51-75% @elseif($av->assiduidade == '4') > 76% @endif <br>
											(Cumprimento da frequência de trabalho)</b></label>
										 </div>
										</div>
										<div class="row">
										 <div class="col m-2">
										   <label for="message-text" class="col-form-label"><b>8) SEGURANÇA: @if($av->seguranca == '1') 0-25% @elseif($av->seguranca == '2') 26-50% @elseif($av->seguranca == '3') 51-75% @elseif($av->seguranca == '4') > 76% @endif <br>
											(Habilidade em manter os cuidados necessários no desenvolvimento das tarefas, preservando a si e ao seu próximo para evitar acidentes)</b></label>
										 </div>
										</div>
									  </div>
									</section>
								   </div>
								  </div>
								</div>
							  </div>
							</center>
							</td>
							<td><center><a class="btn btn-danger btn-sm" href="{{ route('excluirAvaliacaoExp', $av->id) }}" ><i class="bi bi-trash"></i></center></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div> 
	</div>
</div>
</div>
  <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>