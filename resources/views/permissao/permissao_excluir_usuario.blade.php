@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">EXCLUIR VÍNCULO - PERMISSÃO / USUÁRIO:</h3>
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
                        <form action="{{\Request::route('destroyPermissaoUser')}}" method="post">
					    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
						<table border="1" class="table-sm" style="line-height: 1.5;" >
                            <thead class="bg-info">
                             <tr> 
                                <td style="width: 310px;"><b>TELA</b></td>
                                <td style="width: 500px;"><center><b>USUÁRIO</b></center></td>
                                <td></td>
                             </tr>
					        </thead>
                            @foreach($perm_user as $permissao)
                            <tr>
							 <td> {{ $permissao->tela }} </td>
                             <td> <center>{{ $permissao->usuario }} </center></td>
                             <td><a class="btn btn-danger btn-sm" style="margin-top: 10px;" href="{{ route('permissaoUserExcluir_', array($permissao->permissao, $permissao->id)) }}">Excluir</a> </td>
                            </tr>
							<tr>
							  <td><input hidden type="text" id="tela" name="tela" class="form-control" value="excluir_usuario_permissoes" /></td>
							  <td><input hidden type="text" id="user_id_" name="user_id_" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							  <td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 	 </tr>
                            @endforeach   
                        </table>
                        <table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroPermissoes') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
                      	 </tr>
						</table>
					</form>
		 </div>
        </div>
    </div>   
</body>