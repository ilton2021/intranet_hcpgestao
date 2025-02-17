<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>3/4 Seu Gestor</title>
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
          <h2>Seu Gestor</h2>
        </div>
        <div class="col">
          <img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo 'HCP Gestão'; ?>" width="130px">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h4>Status de progresso: </h4>
          <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 50%">50%</div>
          </div>
        </div>
      </div>
      <div class="row">
       <form action="{{ route('storeSeuGestor', $departamento[0]->id) }}" method="post">
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
          <br><p style="font-weight: bold;">Quanto as considerações a respeito de sua Liderança, assinale:</p>
            <table class="table table-bordered table-sm table-striped">
             <tr>
               <td><b><font size="2">Respeito:</font></b></td>
               <td hidden><input type="hidden" name="pergunta1" id="pergunta1" value="1"></td>
               <td><input type="radio" name="resposta1" id="resposta1" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta1" id="resposta1" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta1" id="resposta1" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta1" id="resposta1" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta1" id="resposta1" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta1') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Abertura Para Sugestões:</font></b></td>
               <td hidden><input type="hidden" name="pergunta2" id="pergunta2" value="2"></td>
               <td><input type="radio" name="resposta2" id="resposta2" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta2" id="resposta2" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta2" id="resposta2" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta2" id="resposta2" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta2" id="resposta2" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta2') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Profissionalismo e Preparação:</font></b></td>
               <td hidden><input type="hidden" name="pergunta3" id="pergunta3" value="3"></td>
               <td><input type="radio" name="resposta3" id="resposta3" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta3" id="resposta3" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta3" id="resposta3" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta3" id="resposta3" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta3" id="resposta3" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta3') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Confiança:</font></b></td>
               <td hidden><input type="hidden" name="pergunta4" id="pergunta4" value="4"></td>
               <td><input type="radio" name="resposta4" id="resposta4" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta4" id="resposta4" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta4') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr>
             <tr>
               <td><b><font size="2">Feedback:</font></b></td>
               <td hidden><input type="hidden" name="pergunta5" id="pergunta5" value="5"></td>
               <td><input type="radio" name="resposta5" id="resposta5" value="a" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'a'){ echo 'checked'; } ?>> Muito Insatisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="b" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'b'){ echo 'checked'; } ?>> Insatisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="c" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'c'){ echo 'checked'; } ?>> Regular</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="d" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'd'){ echo 'checked'; } ?>> Satisfeito</td>
               <td><input type="radio" name="resposta5" id="resposta5" value="e" class="form-check-input" style="margin-left:8px;" <?php if(old('resposta5') == 'e'){ echo 'checked'; } ?>> Muito Satisfeito</td>
             </tr> 
            </table>
           </div>
          </div> <br>
           <input type="submit" class="btn btn-success btn-sm" onclick="validar()" value="CONFIRMAR" id="Salvar" name="Salvar" /> <br><br>
        </form>
        <br>
    </main>
</body>
</html>