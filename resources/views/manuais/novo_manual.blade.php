<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@extends('layouts.manuais') <BR>
    <script type="text/javascript">
		function esconder_campos(){
			tipo = document.getElementById("tipo_doc").value;
            if(tipo == 1) {
                document.getElementById("campos_1").hidden = false;
                document.getElementById("campos_2").hidden = false;
            } else if (tipo == 2) {
                document.getElementById("campos_1").hidden = true;
                document.getElementById("campos_2").hidden = true;
            } else {
                document.getElementById("campos_1").hidden = true;
                document.getElementById("campos_2").hidden = false;
            }
		}
    </script>
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">CADASTRAR NOVO MANUAL FARMACÊUTICO:</h3>
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
                            Manual Farmacêutico: <i class="fas fa-check-circle"></i>
                        </a>
                    </div>	
					<form action="{{\Request::route('storeManual')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <table class="table table-sm" style="line-height: 1.5;">
                        <tr>
							<td><b>Tipo:</b></td>
							<td>
                                <select id="tipo" name="tipo" class="form-select form-select-sm" required>
									<option value="">Selecione...</option>
                                    <option value="1">Manual Farmacêutico</option>
                                    <option value="2">Institucional</option>
                                </select>
							</td>
						</tr> 
						<tr>
							<td><b>Documento:</b></td>
							<td>
                                <select id="tipo_doc" name="tipo_doc" class="form-select form-select-sm" onchange="esconder_campos()" required>
                                    <option value="">Selecione...</option>
									<option value="1">PDF</option>
                                    <option value="2">LINK</option>
                                </select>
							</td>
						</tr> 
                        <tr>
							<td><b>Título:</b></td>
							<td>
								<input class="form-control form-control-sm" type="text" id="titulo" name="titulo" required value="{{ old('titulo') }}" />
							</td>
						</tr>
						<tr id="campos_1">
							<td><b>Arquivo:</b></td>
							<td> 
							    <input class="form-select form-select-sm" type="file" id="arquivo" name="arquivo" /> 
							</td>
						</tr>
						<tr>
							<td><b>Menu:</b></td>
							<td>
                                <select id="id_menu" name="id_menu" class="form-select form-select-sm" required>
									<option value="">Selecione...</option>
                                    <option value="0">MENU PRINCIPAL</option>
                                    <option value="1">SUB-MENU</option>
                                </select>
							</td>
						</tr>
                        <tr>
							<td><b>Menu Pai:</b></td>
							<td>
                                <select id="id_link" name="id_link" class="form-select form-select-sm" required>
									<option value="">Selecione...</option>
                                    <option value="0">MENU PRINCIPAL</option>
									  @foreach($menusManuais as $mm)
										<option value="<?php echo $mm->id; ?>">{{ mb_strtoupper($mm->titulo) }}</option>
									  @endforeach
                                </select>
							</td>
						</tr>
						<tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="novo_manual" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
						<tr>
						    <td align="center" colspan="2"> 
                              <a href="{{ route('listaManuais') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						      <input type="submit" class="btn btn-success btn-sm" value="Salvar" id="Salvar" name="Salvar" /> 
                            </td>
						</tr>
					  </table>
					</form>
                </div>
            </div>
        </div>
    </div>
</body>