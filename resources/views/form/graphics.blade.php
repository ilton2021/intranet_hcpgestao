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
    <div class="container text-center" style="width: 1000px;">
        <div class="row">
            <div class="col">
                <center><h4><br>PESQUISA DE CLIMA - GRÁFICOS:</h4></center>
            </div> 
        </div> <br><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col">
                <a class="btn btn-success btn-sm" href="{{ route('graphicsSobreVoce') }}">SOBRE VOCÊ</a>
            </div>
            <div class="col">
                <a class="btn btn-success btn-sm" href="{{ route('graphicsOndeTrabalha') }}">ONDE TRABALHA</a> 
            </div>
        </div> 
        <BR><BR>     
        <div class="row">
            <div class="col">
                <a class="btn btn-success btn-sm" href="{{ route('graphicsSeuGestor') }}">SEU GESTOR</a>
            </div>
            <div class="col">
                <a class="btn btn-success btn-sm" href="{{ route('graphicsConsideracoes') }}">CONSIDERAÇÕES FINAIS</a>
            </div>
        </div>   
    </div>
    </main>
</body>
</html>