@extends('layouts.adm')
<link rel="shortcut icon" href="{{asset('assets/img/favico.png')}}"/>
	<div class="container-fluid">
	<div class="row" style="margin-top: 0px;">
		<div class="col-md-12 text-center">
			<h3 style="font-size: 18px;">EXCLUIR DOCUMENTOS DE QUALIDADE:</h3>
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
                        Excluir Documentos de Qualidade: <i class="fas fa-check-circle"></i>
                    </a>
                </div>	
					<form action="{{\Request::route('destroyDocumentos')}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<table border="0" class="table table-sm" style="line-height: 1.5;" >
						 <tr>
							<td> Nome: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="nome" name="nome" readonly value="<?php echo $documentos[0]->nome; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> Sigla: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="sigla" name="sigla" readonly value="<?php echo $documentos[0]->sigla; ?>" />
							</td>
						 </tr>
						 <tr>
							<td> Imagem: </td>
							<td> 
							  <input class="form-control form-control-sm" type="text" id="imagem" name="imagem" readonly value="<?php echo $documentos[0]->imagem; ?>" /> 
                   		</td>
						 </tr>
						 <tr>
							<td> Setor: </td>
							<td>
								<input class="form-control form-control-sm" type="text" id="setor_id" name="setor_id" readonly value="<?php echo $setores[0]->setor .' | '. $setores[0]->unidade; ?>" /> 
							</td>
						 </tr>
                         <tr>
                            <td colspan="4"><br><b>Deseja Realmente Excluir este Documento de Qualidade?</b></td>
                         </tr>
						 <tr>
							<td><input hidden type="text" id="tela" name="tela" class="form-control" value="excluir_documentos" /></td>
							<td><input hidden type="text" id="user_id" name="user_id" class="form-control" value="<?php echo Auth::user()->id; ?>"  /></td>
							<td><input hidden type="text" id="idTabela" name="idTabela" class="form-control" value="" /> </td>
						 </tr>
                         </table>
						<table>
						 <tr>
						  <td><br> <a href="{{ route('cadastroDocumentos') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-reply"></i> </a>
						  <input type="submit" class="btn btn-danger btn-sm" style="margin-top: 10px;" value="Excluir" id="Salvar" name="Salvar" /> </td>
						 </tr>
						</table>
					</form>
		</div>
    </div>
</div>
</body>