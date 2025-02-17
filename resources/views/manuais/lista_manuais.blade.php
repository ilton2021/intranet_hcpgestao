@extends('layouts.adm') 
  <script type="text/javascript">
		function data(valor) {
			var x = document.getElementById('pesq2'); 
			var y = x.options[x.selectedIndex].text;
			if (y == "Selecione...") {
				document.getElementById('pesq_1').hidden = true;
        document.getElementById('pesq_2').hidden = false;
			} else if(y == "NOME") {
				document.getElementById('pesq_1').hidden = false;
				document.getElementById('pesq_2').hidden = true;
			} else {
				document.getElementById('pesq_1').hidden = true;
				document.getElementById('pesq_2').hidden = false;
			}
		}
  </script>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 text-center">
			<h5  style="font-size: 18px;"><b>CADASTRO MANUAIS:</b></h5>
		</div>
	</div>	
    @if ($errors->any())
        <div class="alert alert-success">
            <ul class="list-unstyled">
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
					<td id="pesq_1"> 
					 <input type="text" id="pesq_nome" name="pesq_nome" class="form-control form-control-sm" />
          </td>
          <td id="pesq_2" hidden> 
           <select id="pesq_tipo" name="pesq_tipo" class="form-control form-control-sm">
              <option value="">Selecione...</option>
              <option value="1">M. FARMACÊUTICO</option>
              <option value="2">INSTITUCIONAL</option>
					  </select>
          </td>
          <td>
					  <select id="pesq2" name="pesq2" class="form-control form-control-sm" onchange="data('sim')">
              <option id="pesq2" name="pesq2" value="1">NOME</option>
              <option id="pesq2" name="pesq2" value="2">TIPO</option>
					  </select>
          </td>
          <td> 
					  <input type="submit" id="btn"  name="btn" class="btn btn-success btn-sm" value="Pesquisar" />
					</td>	
					<td>
					  <p align="right">
						  <a class="btn btn-warning btn-sm" style="color: #FFFFFF;" href="{{ url('/home') }}"> Voltar <i class="fas fa-undo-alt"></i> </a> &nbsp;
						  <a class="btn btn-dark btn-sm" style="color: #FFFFFF;" href="{{route('novoManual')}}"> Novo <i class="fas fa-check"></i> </a>
					  </p>
					</td>
				</tr>
			</table>
      <table class="table table-sm table-striped" id="my_table">
        <thead class="bg-success">
          <tr>
            <th scope="col"><font color="white">NOME DO MANUAL</font></th>
            <th scope="col"><center><font color="white">TIPO</font></center></th>
            <th scope="col"><center><font color="white">MENU</font></center></th>
            <th scope="col"><center><font color="white">ALTERAR</font></center></th>
            <th scope="col"><center><font color="white">EXCLUIR</font></center></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach($manuais as $topico)
          <tr>
            <td title="<?php echo $topico->titulo; ?>"><?php echo mb_strtoupper(substr($topico->titulo, 0, 70)). '...'; ?></td>
            <td><center><?php if($topico->tipo == 1){ echo 'M. Farmacêutico'; } elseif($topico->tipo == 2){ echo 'Institucional'; }; ?></center></td>
            <td><center><?php if($topico->id_menu == 0){ echo 'Menu'; } else { echo 'Sub-Menu'; } ?></center></td>
            <td><center><a href="{{ route('alterarManual', $topico->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></center></td>
            <td><center><a href="{{ route('excluirManual', $topico->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></a></center></td>
          </tr>
          @endforeach
        </tbody>
    </table>