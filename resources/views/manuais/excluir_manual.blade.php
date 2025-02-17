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
			<h3 style="font-size: 18px;">EXCLUIR MANUAL FARMACÊUTICO:</h3>
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
					<form action="{{\Request::route('destroyManual')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <table class="table table-sm" style="line-height: 1.5;">
                        <tr>
							<td><b>Tipo:</b></td>
							<td>
                                <input class="form-control form-control-sm" type="text" id="tipo" name="tipo" value="<?php if($manual[0]->tipo == 1) { echo 'Manual Farmácia'; } else { echo 'Institucional'; }  ?>" readonly />
                     		</td>
						</tr> 
						<tr>
							<td><b>Documento:</b></td>
							<td>
                            <input class="form-control form-control-sm" type="text" id="tipo_doc" name="tipo_doc" value="<?php if($manual[0]->tipo_doc == 1) { echo 'PDF'; } else if($manual[0]->tipo_doc == 2) { echo 'LINK'; } else { echo 'SUB-LINK'; } ?>" readonly />
							</td>
						</tr> 
                        <tr>
							<td><b>Título:</b></td>
							<td>
								<input class="form-control form-control-sm" type="text" id="titulo" name="titulo" value="<?php echo $manual[0]->titulo; ?>" readonly />
							</td>
						</tr>
                        <tr>
							<td colspan="2"><center><b>Deseja realmente excluir este Manual?</b></center></td>
						</tr>
						<tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="excluir_manuais" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>" /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
						<tr>
						    <td align="center" colspan="2"> 
                              <a href="{{ route('listaManuais') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						      <input type="submit" class="btn btn-danger btn-sm" value="Excluir" id="Salvar" name="Salvar" /> 
                            </td>
						</tr>
					  </table>
					</form>
                </div>
            </div>
        </div>
    </div>
</body>