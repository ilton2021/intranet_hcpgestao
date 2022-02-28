@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">EXCLUIR VÍNCULO - GRUPO INDICADORES / PERFIL USUÁRIO:</h3>
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
                        Permissões do Usuário: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	 
                        <form action="{{route('destroyGpIndUser', array($grupoIndica[0]->id,$gpIndi_pfUser[0]->perfil_ID))}}" method="post">
					    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						<table border="1" class="table-sm" style="line-height: 1.5;" >
                            <thead class="bg-info">
                             <tr> 
                                <td style="width: 380px;"><b>TELA</b></td>
                                <td style="width: 500px;"><center><b>USUÁRIO</b></center></td>
                             </tr>
                            </thead>
                            @foreach($gpIndi_pfUser as $GpiPfuser)
                            <tr>
							 <td> {{ $GpiPfuser->grupo_indicador }} </td>
                             <td> <center>{{ $GpiPfuser->perfil }} </center></td>
                            </tr>
                            @endforeach   
                        </table>
						<tr>
						  <td><input hidden type="text" id="tela" name="tela" class="form-control" value="excluir_PFUsuario_GPIndicadores" /></td>
						  <td><input hidden type="text" id="user_id_" name="user_id_" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
						  <td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						</tr>
                        <table>
						 <tr>
						  <td> <br><b>Deseja Realmente Excluir esta Permissão?</b> </td>
						 </tr>
						 <tr>
						  <td><br> <a href="javascript:history.back();" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" /> </td>
                      	 </tr>
						</table>
					</form>
		 </div>
        </div>
    </div>   
</body>