<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>4/4 Considerações Finais</title>
    <style>
        body{
            margin-top: 10px;
            margin-left: 10%;
            margin-right: 10%;
        }

        body h1{
            margin-top: 6px;
        }

        main{
            margin-top: 15px;
            margin-left:20px;
            margin-right:20px;
            border-left: 1px solid gray;
            border-right: 1px solid gray;
            padding: 10px;
        }

        .checkbox{
            text-align: start;
        }
    </style>
</head>
<body class="container d-flex align-items-center justify-content-between">
    <div class="container text-center">
    @if ($errors->any())
        <div class="alert alert-success">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <main>
      <div class="row">
        <div class="col">
          <h2>Considerações Finais</h2>
        </div>
        <div class="col">
          <img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo 'HCP Gestão'; ?>" width="130px">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>Status de progresso: </h4>
          <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 75%">75%</div>
          </div>
        </div>
      </div>
      <div class="row">
       <form action="{{ route('storeConsideracoesFinais', $departamento[0]->id) }}" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col">
          <br><p style="margin-bottom: 10px; font-weight: bold;">Você indicaria um amigo para trabalhar no HSS?</p>
            <table class="table table-bordered table-sm table-striped">
             <tr>
               <td><b><font size="2">Assinale De Acordo:</font></b></td>
               <td hidden><input type="hidden" name="pergunta" id="pergunta" value="1"></td>
               <td><input type="radio" name="resposta" id="resposta" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta') == 'a'){ echo 'checked'; } ?>> Nunca</td>
               <td><input type="radio" name="resposta" id="resposta" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta') == 'b'){ echo 'checked'; } ?>> Dificilmente</td>
               <td><input type="radio" name="resposta" id="resposta" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta') == 'c'){ echo 'checked'; } ?>> Talvez</td>
               <td><input type="radio" name="resposta" id="resposta" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta') == 'd'){ echo 'checked'; } ?>> Sim</td>
               <td><input type="radio" name="resposta" id="resposta" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta') == 'e'){ echo 'checked'; } ?>> Com Certeza</td>
             </tr>
            </table>
        </div>
       </div>    
       <div class="row"> 
        <div class="col">
          <br><p style="font-weight: bold;">Marque as alternativas que te fazem<br> querer deixar de fazer parte do HSS:</p>
            <table class="table table-bordered table-sm table-striped">
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="1" <?php echo in_array(1, old('sair_hss', [])) ? 'checked' : '' ?>></center></div></td><td> O Trabalho que Executo</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="2" <?php echo in_array(2, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>O Salário</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="3" <?php echo in_array(3, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>A relação com meu gestor</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="4" <?php echo in_array(4, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Sobrecarga de Trabalho</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="5" <?php echo in_array(5, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Falta de Treinamento</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="6" <?php echo in_array(6, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Ausência de Feedback</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="7" <?php echo in_array(7, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Falta de Autonômia</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="8" <?php echo in_array(8, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Falta de Reconhecimento</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="9" <?php echo in_array(9, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Ambiente de Trabalho Ruim</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="sair_hss[]" id="sair_hss[]" class="form-check-input" value="10" <?php echo in_array(10, old('sair_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Crescimento Impossível</td> </tr>
            </table>
        </div>
        <div class="col">
          <br><p style="font-weight: bold;">Marque as alternativas que te fazem<br> querer continuar a fazer parte do HSS:</p>
            <table class="table table-bordered table-sm table-striped">
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="1" <?php echo in_array(1, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Salário</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="2" <?php echo in_array(2, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Estabilidade no Emprego</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="3" <?php echo in_array(3, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Relacionamento com o Líder</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="4" <?php echo in_array(4, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Reconhecimento</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="5" <?php echo in_array(5, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Autonomia no Trabalho</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="6" <?php echo in_array(6, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Sem Opção de outro Emprego</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="7" <?php echo in_array(7, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>O trabalho que executo</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="8" <?php echo in_array(8, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Ambiente de Trabalho</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="9" <?php echo in_array(9, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Possibilidade de Crescimento</td> </tr>
              <tr> <td><div class="checkbox"><center><input type="checkbox" name="continuar_hss[]" id="continuar_hss[]" class="form-check-input" value="10" <?php echo in_array(10, old('continuar_hss', [])) ? 'checked' : '' ?>> </center></div></td><td>Experiências Obtidas</td> </tr>
            </table>
        </div>
       </div> <br>
        <input type="submit" class="btn btn-success btn-sm" onclick="validar()" value="FINALIZAR" id="Salvar" name="Salvar" /> <br><br>  
      </div>
     </form>
    </main>
</body>
</html>