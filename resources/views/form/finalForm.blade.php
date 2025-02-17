<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Pesquisa Finalizada!</title>
    <style>
        body{
            margin-left: 10%;
            margin-right: 10%;
        }

        body h1{
            margin-top: 6px;
            text-align: center;
        }

        main{
            margin-top: 15px;
            margin-left:20px;
            margin-right:20px;
            padding: 10px;
        }
    </style>
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-success">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <header><br><br>
        <h1>Pesquisa Finalizada com Sucesso!</h1>
        <center><img src="{{ asset('storage') }}/{{ ('gestao.png') }}" class="img-fluid" alt="<?php echo 'HCP Gestão'; ?>" width="130px"></center>
    </header>

    <main>
        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 100%">100%</div>
        </div>
        <br><br><br><br><br><center><a href="{{ route('iniciarForm') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> Voltar <i class="fas fa-undo-alt"></i> </a></center>
    </main>
</body>
</html>