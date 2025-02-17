<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="card" style="display: flex; justify-content: center;">
        <div class="card-body">
            <div class="card" style="width: 40rem; border: 1px solid green; border-radius: 5px; text-align:center;">
                <img class="card-img-top" src="{{ asset('assets/img/logo4.jpeg') }}" width="400px" alt="Card image cap"
                    style="text-align:center;">
                <div class="card-body" style="text-align:center;">
                    <h5 class="card-title" style="text-align:center; font-size: 22px">Token de confirmação Ouvidoria RH
                        - Intranet</h5>

                    <p class="card-text" style="text-align:center; font-size: 18px; margin-top:8px;text-decoration: underline;"><strong>
                            {{ $token }}</strong></p>

                    <span class="card-text"
                        style="text-align:center; color:red; font-size: 16px margin-top:8px;"><strong>
                            Copie este token e cole na página da ouvidoria acima do botão enviar
                            mensagem</strong></span>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
