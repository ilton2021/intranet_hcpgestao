<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body{
            margin-top: 10px;
            margin-left: 20%;
            margin-right: 20%;
            background: #fafafa;
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
        
        .select-bordered {
            padding: 10px;
            width: 300px;
            font-size:16px;
            border: 0;
            border-bottom: 3px solid teal;
        }
        .select-underline {
            border-color: orangered;
        }
    </style>
    <title>Pesquisa de Clima</title>
</head>
<body class="container d-flex align-items-center justify-content-between">
    
    <main>
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
        <div class="row">
            <div class="col">
                <center><h4 style="margin-left: 50px;"><br>PESQUISA DE CLIMA</h4></center>
            </div> 
            <div class="col">
                <img src="{{ asset('storage') }}/{{ $unidades[0]->caminho }}" class="img-fluid" alt="<?php echo $unidades[0]->sigla; ?>" width="130px"> &nbsp;&nbsp;
                <img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo $unidades[0]->sigla; ?>" width="130px">
            </div>
        </div> <br>
        <div class="row">
            <div class="col">
                <h3 style="font-size: 15px; text-align: justify;"><br><b>Prezado Colaborador, a Pesquisa de Clima Organizacional é de suma importância para medir a satisfação dos Colaboradores e entender se há equilíbrio saudável entre a vida pessoal e profissional, visando ter este filtro e adequarmos a nossa Unidade de acordo com as necessidades apresentadas, contamos com a participação de todos e salientamos que não será necessário expor sua identidade.</b></h3></section>
            </div>
        </div> <br>
        <form action="{{ route('storeIniciarForm') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col">
                <label for="" style="margin-bottom: 15px; margin-top: 15px;">Unidade:</label>
                <select name="unidade" id="unidade" class="select-bordered" readonly>
                    @foreach($unidades as $unidade)
                        <option value="<?php echo $unidade->nome; ?>"><?php echo $unidade->nome; ?></option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="" style="margin-bottom: 15px; margin-top: 15px;">Setor:</label>
                <select name="departamento" id="departamento" class="select-bordered" required>
                    <option value="">Selecione...</option>
                    @foreach($setores as $setor)
                        <option value="<?php echo $setor->departamento ?>"><?php echo $setor->departamento ?></option>
                    @endforeach
                </select>
            </div>
        </div>    
        <div class="row">
            <div class="col"> <br>
             <table class="table table-sm table-bordered">
                 <tr>
                    <td colspan="2"><h4 style="font-size: 16px;">Detalhamento De Referências:</h4></td>
                 </tr>
                 <tr>
                    <td>0%:</td><td> Muito Insatisfeito</td>
                 </tr>
                 <tr>
                    <td>1-25%:</td><td> Insatisfeito</td>
                 </tr>
                 <tr>
                    <td>26-50%:</td><td> Regular</td>
                 </tr>
                 <tr>
                    <td>51-75%:</td><td> Satisfeito</td>
                 </tr>
                 <tr>
                    <td>Acima de 76%:</td><td> Muito Satisfeito</td>
                 </tr>
                 <br>
             </table>
            </div>
        </div>
        <input type="submit" class="btn btn-success btn-sm" onclick="validar()" value="Começar" id="Salvar" name="Salvar" /> <br><br>
        </form>
    </div>
    </main>
</body>
</html>