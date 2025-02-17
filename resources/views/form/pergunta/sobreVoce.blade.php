<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>1/4 Sobre Você</title>
    <style>
        body{
            margin-top: 10px;
            margin-left: 20%;
            margin-right: 20%;
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
          <h2>Sobre você</h2>
        </div>
        <div class="col">
          <img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo 'HCP Gestão'; ?>" width="130px">
        </div>
      </div>
      <div class="row">
        <div class="col">
        <h5>Status do Progresso:</h5>
          <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 0%">0%</div>
          </div>
        </div>
      </div>
      <div class="row">
       <form action="{{ route('storeSobreVoce', $departamento[0]->id) }}" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col">
            <center>
             <table class="table table-sm table-bordered table-striped" style="width: 400px;">
                 <tr>
                    <td colspan="2"><center><h4 style="font-size: 16px;">Detalhamento De Referências:</h4></center></td>
                 </tr>
                 <tr>
                    <td><center>0%</center></td><td><center> Muito Insatisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>1-25%</center></td><td><center> Insatisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>26-50%</center></td><td><center> Regular</center></td>
                 </tr>
                 <tr>
                    <td><center>51-75%</center></td><td><center> Satisfeito</center></td>
                 </tr>
                 <tr>
                    <td><center>Acima de 76%</center></td><td><center> Muito Satisfeito</center></td>
                 </tr>
                 <br>
             </table>
            </center>
          </div>
        <div class="col"> <br>
          <p style="font-weight: bold;">Considerando sua condição de saúde, aponte seu Grau de Satisfação com as seguintes categorias:</p>
            <table class="table table-bordered table-sm table-striped">
             <tr>
                <td><b><font size="2">Estado Físico:</font></b></td>
                <td hidden><input type="hidden" name="pergunta1" id="pergunta1" value="1"></td>
                <td><input type="radio" name="resposta1" id="resposta1" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta1') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
                <td><input type="radio" name="resposta1" id="resposta1" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta1') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
                <td><input type="radio" name="resposta1" id="resposta1" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta1') == 'c'){ echo 'checked'; } ?>> Regular</td>
                <td><input type="radio" name="resposta1" id="resposta1" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta1') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
                <td><input type="radio" name="resposta1" id="resposta1" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta1') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
                <td><b><font size="2">Estado Mental:</font></b></td>
                <td hidden><input type="hidden" name="pergunta2" id="pergunta2" value="2"></td>
                <td><input type="radio" name="resposta2" id="resposta2" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta2') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
                <td><input type="radio" name="resposta2" id="resposta2" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta2') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
                <td><input type="radio" name="resposta2" id="resposta2" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta2') == 'c'){ echo 'checked'; } ?>> Regular</td>
                <td><input type="radio" name="resposta2" id="resposta2" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta2') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
                <td><input type="radio" name="resposta2" id="resposta2" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta2') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
                <td><b><font size="2">Estado Emocional:</font></b></td>
                <td hidden><input type="hidden" name="pergunta3" id="pergunta3" value="3"></td>
                <td><input type="radio" name="resposta3" id="resposta3" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta3') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
                <td><input type="radio" name="resposta3" id="resposta3" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta3') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
                <td><input type="radio" name="resposta3" id="resposta3" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta3') == 'c'){ echo 'checked'; } ?>> Regular</td>
                <td><input type="radio" name="resposta3" id="resposta3" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta3') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
                <td><input type="radio" name="resposta3" id="resposta3" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta3') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
            </table>
          </div>
         </div>
         <div class="row">
         <div class="col">
         <br><p style="font-weight: bold;">Marque qual o seu nível de Satisfação com as questões citadas abaixo:</p>
           <table class="table table-bordered table-sm table-striped">
             <tr>
               <td><b><font size="2">Moradia:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta4" id="pergunta4" value="4"></td>
               <td><input type="radio" name="resposta4" id="resposta4" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta4') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="b" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta4') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="c" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta4') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="d" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta4') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta4') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Situação Financeira:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta5" id="pergunta5" value="5"></td>
               <td><input type="radio" name="resposta5" id="resposta5" value="a" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta5') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="b" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta5') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="c" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta5') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="d" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta5') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta5') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Alimentação:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta6" id="pergunta6" value="6"></td>
               <td><input type="radio" name="resposta6" id="resposta6" value="a" style="margin-left:5px;" class="form-check-input" <?php if(old('resposta6') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta6" id="resposta6" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta6') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta6" id="resposta6" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta6') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta6" id="resposta6" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta6') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta6" id="resposta6" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta6') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Educação:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta7" id="pergunta7" value="7"></td>
               <td><input type="radio" name="resposta7" id="resposta7" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta7') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta7" id="resposta7" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta7') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta7" id="resposta7" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta7') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta7" id="resposta7" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta7') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta7" id="resposta7" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta7') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Transporte:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta8" id="pergunta8" value="8"></td>
               <td><input type="radio" name="resposta8" id="resposta8" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta8') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta8" id="resposta8" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta8') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta8" id="resposta8" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta8') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta8" id="resposta8" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta8') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta8" id="resposta8" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta8') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr> 
            </table> 
          </div> 
         </div>
         <div class="row">
         <div class="col">
          <br><p style="font-weight: bold;">Atualmente com qual situações abaixo você mais se preocupa?</p>
            <table class="table table-bordered table-sm table-striped">
             <tr>
               <td><b><font size="2">Saúde:</font></b></td>
               <td hidden><input type="hidden" name="pergunta9" id="pergunta9" value="9"></td>
               <td><input type="radio" name="resposta9" id="resposta9" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta9') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta9" id="resposta9" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta9') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta9" id="resposta9" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta9') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta9" id="resposta9" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta9') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta9" id="resposta9" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta9') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Segurança:</font></b></td>
               <td hidden><input type="hidden" name="pergunta10" id="pergunta10" value="10"></td>
               <td><input type="radio" name="resposta10" id="resposta10" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta10') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta10" id="resposta10" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta10') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta10" id="resposta10" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta10') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta10" id="resposta10" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta10') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta10" id="resposta10" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta10') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Alimentação:</font></b></td>
               <td hidden><input type="hidden" name="pergunta11" id="pergunta11" value="11"></td>
               <td><input type="radio" name="resposta11" id="resposta11" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta11') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta11" id="resposta11" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta11') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta11" id="resposta11" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta11') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta11" id="resposta11" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta11') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta11" id="resposta11" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta11') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Aceitação Social:</font></b></td>
               <td hidden><input type="hidden" name="pergunta12" id="pergunta12" value="12"></td>
               <td><input type="radio" name="resposta12" id="resposta12" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta12') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta12" id="resposta12" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta12') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta12" id="resposta12" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta12') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta12" id="resposta12" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta12') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta12" id="resposta12" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta12') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Realização Pessoal:</font></b></td> 
               <td hidden><input type="hidden" name="pergunta13" id="pergunta13" value="13"></td>
               <td><input type="radio" name="resposta13" id="resposta13" value="a" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta13') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta13" id="resposta13" value="b" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta13') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta13" id="resposta13" value="c" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta13') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta13" id="resposta13" value="d" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta13') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta13" id="resposta13" value="e" style="margin-left:8px;" class="form-check-input" <?php if(old('resposta13') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
            </table>
          </div>
         </div>
        <br>
         <input type="submit" class="btn btn-success btn-sm" onclick="validar()" value="CONFIRMAR" id="Salvar" name="Salvar" /> <br><br>
        </form>
    </main>
</body>
</html>