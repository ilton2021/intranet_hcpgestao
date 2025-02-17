<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('img/favico.png') }}">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <title>Intranet Hcp Gestão - Controle de veiculos</title>

</head>

<body>
    <div class="text-center mb-3">
        <div>
            <h6><?php echo "Geração: " . date('d/m/Y H:i:s') ?></h6>
        </div>
        <div>
            <img src="{{ asset('img/Imagem1.png') }}" height="50" class="d-inline-block align-top" alt="">
        </div>
        <div class="border border-success rounded">
            <h2>RELATÓRIO DE VEICULOS</h2>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" style="border: 1px solid;">
            <thead style="background-color:black;color:white;" >
                <tr >
					<th scope="col">ID</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Placa:</th>
                    <th scope="col">Marca/Modelo</th>
                    <th scope="col">Cor</th>
					<th scope="col">Matricula</th>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Fone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($veiculos as $v)
                    <tr style="border-bottom: 1px solid;">
						<th scope="col">{{ $v->id }}</th>
                        <th scope="col">{{ $v->tipo }}</th>
                        <th scope="col">{{ $v->placa }}</th>
                        <th scope="col">{{ $v->marcamodelo }}</th>
                        <th scope="col">{{ $v->cor }}</th>
						<th scope="col">{{ $v->matricula }}</th>
                        <th scope="col">{{ $v->nome }}</th>
                        <th scope="col">{{ $v->funcao }}</th>
                        <th scope="col">{{ $v->setor }}</th>
                        <th scope="col">{{ $v->telefone }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!--
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
      -->
</body>

</html>
