<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>2/4 Onde Trabalha</title>
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
            <h2>Onde Trabalha...</h2>
        </div>
        <div class="col">
          <img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo 'HCP Gestão'; ?>" width="130px">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>Status de progresso: </h4>
          <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
          </div>
        </div>
      </div>
      <div class="row">
       <form action="{{ route('storeOndeTrabalha', $departamento[0]->id) }}" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
       <div class="row">
            <div class="col"> <br>
            <center>
             <table class="table table-sm table-bordered table-striped" style="width: 400px;">
                 <tr>
                    <td colspan="2"><center><h4 style="font-size: 16px;">Detalhamento De Referências:</h4></center></td>
                 </tr>
                 <tr>
                    <td><center>0%:</center></td><td><center> Muito Insatisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>1-25%:</center></td><td><center> Insatisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>26-50%:</center></td><td><center> Regular</center></td>
                 </tr>
                 <tr>
                    <td><center>51-75%:</center></td><td><center> Satisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>Acima de 76%:</center></td><td><center> Muito Satisfeito</center></td>
                 </tr>
                 <br>
             </table>
            </center>
            </div>
        </div>
        <div class="col">
         <br><p style="font-weight: bold;">Como você classifica seu grau de confiança para expor suas ideias dentro da Empresa?</p>
          <table class="table table-bordered table-sm table-striped">
            <tr>
              <td hidden><input type="hidden" name="pergunta1" id="pergunta1" value="1"></td>
              <td><input type="radio" name="resposta1" id="resposta1" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta1" id="resposta1" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta1" id="resposta1" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta1" id="resposta1" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta1" id="resposta1" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
          </table> 
         </div>
       </div>
       <div class="row">
        <div class="col">
         <br><p style="font-weight: bold;">Quanto as condições Físicas e Ambientais do seu Local de Trabalho:</p>
          <table class="table table-bordered table-sm table-striped">  
            <tr>
              <td><b><font size="2">Espaço:</font></b></td>
              <td hidden><input type="hidden" name="pergunta2" id="pergunta2" value="2"></td>
              <td><input type="radio" name="resposta2" id="resposta2" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta2" id="resposta2" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta2" id="resposta2" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta2" id="resposta2" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta2" id="resposta2" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
            <tr>
              <td><b><font size="2">Conforto:</font></b></td>
              <td hidden><input type="hidden" name="pergunta3" id="pergunta3" value="3"></td>
              <td><input type="radio" name="resposta3" id="resposta3" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta3" id="resposta3" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta3" id="resposta3" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta3" id="resposta3" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta3" id="resposta3" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
            <tr>
              <td><b><font size="2">Higiene:</font></b></td>
              <td hidden><input type="hidden" name="pergunta4" id="pergunta4" value="4"></td>
              <td><input type="radio" name="resposta4" id="resposta4" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta4" id="resposta4" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta4" id="resposta4" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta4" id="resposta4" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta4" id="resposta4" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
            <tr>
              <td><b><font size="2">Instalação Sanitárias:</font></b></td>
              <td hidden><input type="hidden" name="pergunta5" id="pergunta5" value="5"></td>
              <td><input type="radio" name="resposta5" id="resposta5" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta5" id="resposta5" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta5" id="resposta5" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta5" id="resposta5" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta5" id="resposta5" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
            <tr>
              <td><b><font size="2">Temperatura:</font></b></td>
              <td hidden><input type="hidden" name="pergunta6" id="pergunta6" value="6"></td>
              <td><input type="radio" name="resposta6" id="resposta6" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta6') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
              <td><input type="radio" name="resposta6" id="resposta6" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta6') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
              <td><input type="radio" name="resposta6" id="resposta6" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta6') == 'c'){ echo 'checked'; } ?>> Regular</td>
              <td><input type="radio" name="resposta6" id="resposta6" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta6') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
              <td><input type="radio" name="resposta6" id="resposta6" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta6') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
            </tr>
           </table>
           </div>
       </div>
       <div class="row">
        <div class="col">
         <br><p style="font-weight: bold;">Qual o seu Grau de Satisfação em relação ao seu trabalho no HSS?</p>
         <table class="table table-bordered table-sm table-striped">  
           <tr>
            <td hidden><input type="hidden" name="pergunta7" id="pergunta7" value="7"></td>
            <td><input type="radio" name="resposta7" id="resposta7" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta7') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta7" id="resposta7" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta7') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta7" id="resposta7" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta7') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta7" id="resposta7" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta7') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta7" id="resposta7" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta7') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
         </table>
        </div>
       </div>
       <div class="row">
        <div class="col">
         <br><p style="font-weight: bold;">Assinale de acordo com o seu Grau de Satisfação:</p>
         <table class="table table-bordered table-sm table-striped">  
           <tr>
            <td><b><font size="2">Remuneração adequada ao cargo:</font></b></td>
            <td hidden><input type="hidden" name="pergunta8" id="pergunta8" value="8"></td>
            <td><input type="radio" name="resposta8" id="resposta8" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta8') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta8" id="resposta8" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta8') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta8" id="resposta8" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta8') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta8" id="resposta8" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta8') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta8" id="resposta8" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta8') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
           <tr>
            <td><b><font size="2">Oportunidade de crescimento em sua carreira:</font></b></td>
            <td hidden><input type="hidden" name="pergunta9" id="pergunta9" value="9"></td>
            <td><input type="radio" name="resposta9" id="resposta9" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta9') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta9" id="resposta9" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta9') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta9" id="resposta9" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta9') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta9" id="resposta9" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta9') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta9" id="resposta9" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta9') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
           <tr>
            <td><b><font size="2">Capacitação para assumir novas e mais responsabilidades:</font></b></td>
            <td hidden><input type="hidden" name="pergunta10" id="pergunta10" value="10"></td>
            <td><input type="radio" name="resposta10" id="resposta10" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta10') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta10" id="resposta10" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta10') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta10" id="resposta10" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta10') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta10" id="resposta10" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta10') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta10" id="resposta10" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta10') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
           <tr>
            <td><b><font size="2">Oportunidade de desenvolvimento profissional(Cursos e Parcerias):</font></b></td>
            <td hidden><input type="hidden" name="pergunta11" id="pergunta11" value="11"></td>
            <td><input type="radio" name="resposta11" id="resposta11" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta11') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta11" id="resposta11" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta11') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta11" id="resposta11" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta11') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta11" id="resposta11" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta11') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta11" id="resposta11" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta11') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
           <tr>
            <td><b><font size="2">Estabilidade do seu emprego:</font></b></td>
            <td hidden><input type="hidden" name="pergunta12" id="pergunta12" value="12"></td>
            <td><input type="radio" name="resposta12" id="resposta12" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta12') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
            <td><input type="radio" name="resposta12" id="resposta12" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta12') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
            <td><input type="radio" name="resposta12" id="resposta12" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta12') == 'c'){ echo 'checked'; } ?>> Regular</td>
            <td><input type="radio" name="resposta12" id="resposta12" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta12') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
            <td><input type="radio" name="resposta12" id="resposta12" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta12') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
           </tr>
          </table>
         </div>
        </div> <br>
         <input type="submit" class="btn btn-success btn-sm" onclick="validar()" value="CONFIRMAR" id="Salvar" name="Salvar" /> <br><br>
        </form>
    </main>
</body>
</html>