<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>{{$indicadores[0]->nome}}</title>
    <style>
        .main iframe {
            border: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <div class="main">
    <iframe src="{{$indicadores[0]->link}}" title="{{$indicadores[0]->nome}}">iFrame</iframe>
    </div>
</body>

</html>