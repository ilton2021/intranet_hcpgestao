<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/styleFarmacia.css') }}" />
    <title>@yield('title')</title>
</head>
<body>
    <div class="divHeader">
      <header class="header">
        <span class="manHeader">MANUAL FARMACÊUTICO</span>
        <img class="imgHeader" src="{{ asset('storage/manual/saoSebastiao.png') }}" alt="saoSebastiao" />
      </header>
    </div>

    <nav class="spanHeader">
      <a class="aNav" href="{{ route('manualFarmacia') }}">Manual Farmacêutico</a>
      <a class="aNav" href="{{ route('institucional') }}">Institucional</a>
    </nav>

    @if($topicos)
    <span class="backForward">
      <a class="backForward" href="{{ route('unidade', 7) }}">
        <img
          class="arrowBackForward"
          src="data:image/svg+xml;base64,PHN2ZyBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLW1pdGVybGltaXQ9IjIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTMuMDIyIDE0Ljk5OXYzLjI1MWMwIC40MTIuMzM1Ljc1Ljc1Mi43NS4xODggMCAuMzc1LS4wNzEuNTE4LS4yMDYgMS43NzUtMS42ODUgNC45NDUtNC42OTIgNi4zOTYtNi4wNjkuMi0uMTg5LjMxMi0uNDUyLjMxMi0uNzI1IDAtLjI3NC0uMTEyLS41MzYtLjMxMi0uNzI1LTEuNDUxLTEuMzc3LTQuNjIxLTQuMzg1LTYuMzk2LTYuMDY4LS4xNDMtLjEzNi0uMzMtLjIwNy0uNTE4LS4yMDctLjQxNyAwLS43NTIuMzM3LS43NTIuNzV2My4yNTFoLTkuMDJjLS41MzEgMC0xLjAwMi40Ny0xLjAwMiAxdjMuOTk4YzAgLjUzLjQ3MSAxIDEuMDAyIDF6bTEuNS00LjQ5OHYtMy4wMDhsNC43NTEgNC41MDctNC43NTEgNC41MDd2LTMuMDA4aC0xMC4wMjJ2LTIuOTk4eiIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+"
          alt="imagem de uma seta apontando para o lado direito"
        />
        RETORNAR
      </a>
    </span>
    @endif

    @if($subtopicos)
    <span class="backForward">
      <a class="backForward" href="{{ route('manualFarmacia') }}">
        <img
          class="arrowBackForward"
          src="data:image/svg+xml;base64,PHN2ZyBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLW1pdGVybGltaXQ9IjIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTMuMDIyIDE0Ljk5OXYzLjI1MWMwIC40MTIuMzM1Ljc1Ljc1Mi43NS4xODggMCAuMzc1LS4wNzEuNTE4LS4yMDYgMS43NzUtMS42ODUgNC45NDUtNC42OTIgNi4zOTYtNi4wNjkuMi0uMTg5LjMxMi0uNDUyLjMxMi0uNzI1IDAtLjI3NC0uMTEyLS41MzYtLjMxMi0uNzI1LTEuNDUxLTEuMzc3LTQuNjIxLTQuMzg1LTYuMzk2LTYuMDY4LS4xNDMtLjEzNi0uMzMtLjIwNy0uNTE4LS4yMDctLjQxNyAwLS43NTIuMzM3LS43NTIuNzV2My4yNTFoLTkuMDJjLS41MzEgMC0xLjAwMi40Ny0xLjAwMiAxdjMuOTk4YzAgLjUzLjQ3MSAxIDEuMDAyIDF6bTEuNS00LjQ5OHYtMy4wMDhsNC43NTEgNC41MDctNC43NTEgNC41MDd2LTMuMDA4aC0xMC4wMjJ2LTIuOTk4eiIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+"
          alt="imagem de uma seta apontando para o lado direito"
        />
        RETORNAR
      </a>
    </span>
    @endif

    @if($subtopicos2)
    <span class="backForward">
      <a class="backForward" href="javascript: history.go(-1)">
        <img
          class="arrowBackForward"
          src="data:image/svg+xml;base64,PHN2ZyBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLW1pdGVybGltaXQ9IjIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJtMTMuMDIyIDE0Ljk5OXYzLjI1MWMwIC40MTIuMzM1Ljc1Ljc1Mi43NS4xODggMCAuMzc1LS4wNzEuNTE4LS4yMDYgMS43NzUtMS42ODUgNC45NDUtNC42OTIgNi4zOTYtNi4wNjkuMi0uMTg5LjMxMi0uNDUyLjMxMi0uNzI1IDAtLjI3NC0uMTEyLS41MzYtLjMxMi0uNzI1LTEuNDUxLTEuMzc3LTQuNjIxLTQuMzg1LTYuMzk2LTYuMDY4LS4xNDMtLjEzNi0uMzMtLjIwNy0uNTE4LS4yMDctLjQxNyAwLS43NTIuMzM3LS43NTIuNzV2My4yNTFoLTkuMDJjLS41MzEgMC0xLjAwMi40Ny0xLjAwMiAxdjMuOTk4YzAgLjUzLjQ3MSAxIDEuMDAyIDF6bTEuNS00LjQ5OHYtMy4wMDhsNC43NTEgNC41MDctNC43NTEgNC41MDd2LTMuMDA4aC0xMC4wMjJ2LTIuOTk4eiIgZmlsbC1ydWxlPSJub256ZXJvIi8+PC9zdmc+"
          alt="imagem de uma seta apontando para o lado direito"
        />
        RETORNAR
      </a>
    </span>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>