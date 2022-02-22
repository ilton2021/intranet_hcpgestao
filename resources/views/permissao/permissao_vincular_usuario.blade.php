@extends('layouts.adm')
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">VINCULAR - PERMISSÃO / USUÁRIO:</h3>
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
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
		 <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Permissões do Usuário: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('storePermissaoUsers')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Tela: </td>
							<td>
							    @foreach($permissoes as $permissao)  
                                  <input hidden class="form-control" type="text" id="permissao_id" name="permissao_id" value="<?php echo $permissao->id; ?>" readonly />
                                  <input class="form-control" type="text" id="permissao" name="permissao" value="<?php echo $permissao->tela; ?>" readonly />
                                @endforeach
							</td>
						 </tr>
                         <tr>
                            <td> Usuário: </td>
                            <td>
                                <select id="user_id" name="user_id" class="form-control">
                                 @foreach($usuarios as $user)   
                                  <option id="user_id" name="user_id" value="<?php echo $user->id; ?>"> {{ $user->name }}</option>
                                 @endforeach
                                </select>
                            </td>
                         </tr>
						 <tr>
					      <td hidden><input hidden type="text" id="tela" name="tela" class="form-control" value="vincular_usuario_permissoes" /></td>
				   	      <td hidden><input hidden type="text" id="user_id_" name="user_id_" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
						  <td hidden><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
					  	 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroPermissoes') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a>
						  <input type="submit" class="btn btn-success btn-sm" style="margin-top: 10px;" value="Salvar" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
            </div>      
        </div>
    </div>
    <?php $qtd = sizeof($perm_user); ?>
    @if($qtd > 0)
    <div class="row" style="margin-top: 25px;">
		<div class="col-md-2 col-sm-0"></div>
		<div class="col-md-8 col-sm-12 text-center">
		 <div class="accordion" id="accordionExample">
                <div class="card">
                    <a class="card-header bg-success text-decoration-none text-white bg-success" type="button" data-toggle="collapse" data-target="#PESSOAL" aria-expanded="true" aria-controls="PESSOAL">
                        Vincular Permissões do Usuário: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
				<table border="1" class="table-sm" style="line-height: 1.5;" >
					<thead class="bg-info">
                     <tr> 
					  <td style="width: 500px;"><center><b>TELA</b></center></td>  
                      <td style="width: 500px;"><center><b>USUÁRIO</b></center></td>
                     </tr>
                    </thead>
				    @foreach($perm_user as $permissao)
                     <tr>
				      <td>
					    <center> {{ $permissao->tela }} </center>
					  </td>		 
                      <td style="width: 800px;"> 
					    <center> {{ $permissao->usuario }} </center>
                      </td>
                     </tr>
                    @endforeach
			    </table>
		 </div>
        </div>
    </div>
    @endif   
</body>