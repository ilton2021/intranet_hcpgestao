<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <title>HCP Gest&atilde;o</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style-dashboard.css')}}">
    <link rel="shortcut icon" href="{{asset('img/favico.png')}}">
    <script src="{{asset('js/jquery.min.js')}}" crossorigin="anonymous"></script>
    <style>
        .wrapper {
            display: inline-flex;
            list-style: none;
        }

        .wrapper .icon {
            position: relative;
            background: #ffffff;
            border-radius: 50%;
            padding: 15px;
            margin: 10px;
            width: 50px;
            height: 50px;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .wrapper .tooltip {
            position: absolute;
            top: 0;
            font-size: 14px;
            background: #ffffff;
            color: #ffffff;
            padding: 5px 8px;
            border-radius: 5px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);

        }

        .wrapper .tooltip::before {
            position: absolute;
            content: "";
            height: 8px;
            width: 10px;
            background: #ffffff;
            bottom: -3px;
            left: 50%;
            transform: translate(-50%) rotate(45deg);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .wrapper .icon:hover .tooltip {
            top: 45px;
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .wrapper .icon:hover span,
        .wrapper .icon:hover .tooltip {
            text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
        }

        .wrapper .facebook:hover,
        .wrapper .facebook:hover .tooltip,
        .wrapper .facebook:hover .tooltip::before {
            background: green;
            color: #ffffff;
        }
    </style>
</head>
<body style="background-color:  #F2F5F7">
@section('content')
<section>
    <div class="wrapper">
        <nav id="sidebar" style="background-color:  #64ae64;">
            <div class="sidebar-header d-flex justify-content-center" style="background-color: #bddcbd;">
                <a href="{{route('manualFarmacia')}}">
                    <img src="{{asset('storage/manual/saoSebastiao.png')}}" width="200">
                </a>
            </div>
            <ul class="list-unstyled components" style="padding-top: 0px;"> <?php $a = 0; ?> <?php $encoding = mb_internal_encoding(); ?>
            @if($qtd > 0) 
              @foreach($topicos1 as $tp1) <?php $a = 1; ?>
                @if($tp1->id == 26)
                 <li><a class="nav-link dropdown-toggle" style="font-size: 13px;" target="_blank" href="http://intranet/manualFarmacia/antibi%C3%B3ticoswithoutExpress/src/views/index.html">{{ mb_strtoupper($tp1->titulo, $encoding) }}</a></li>
                @else
                 <li><a class="nav-link dropdown-toggle" style="font-size: 13px;" href="{{ route('iframeFarmacia', $tp1->id) }}">{{ mb_strtoupper($tp1->titulo, $encoding) }}</a></li>
                @endif
              @endforeach

              @if($a == 0)
                <li><a class="nav-link dropdown-toggle" style="font-size: 13px;">{{ mb_strtoupper($topicoSelecionado[0]->titulo, $encoding) }}</a></li>
              @endif
            @elseif($qtd >= 0 && $qtd2 == 0)  
            <li class="nav-item dropdown {{ (\Request::route()->getName() == 'topico1') ? 'active' : '' }}">
             <a class="nav-link dropdown-toggle" href="topico1" role="button" data-toggle="dropdown" aria-haspopup="true" style="font-size: 12px;">MANUAL FARMACÊUTICO</a>
              <ul class="dropdown-menu" aria-labelledby="topico1" style="font-size: 13px; !important;">
                @foreach($topicos1 as $tp1) 
                  <li> <a class="dropdown-item" href="{{ route('iframeFarmacia', $tp1->id) }}">{{ $tp1->titulo }}</a> </li>
                @endforeach  
              </ul>
             </a>
            </li>
            @else

            @endif  <?php $a = 0; ?>

            @if($qtd2 > 0)  
              @foreach($topicos2 as $tp2)  <?php $a = 1; ?>
                <li><a class="nav-link dropdown-toggle" style="font-size: 13px;" href="{{ route('iframeFarmacia', $tp2->id) }}">{{ mb_strtoupper($tp2->titulo, $encoding) }}</a></li>
              @endforeach

              @if($a == 0)
                <li><a class="nav-link dropdown-toggle" style="font-size: 13px;">{{ mb_strtoupper($topicoSelecionado2[0]->titulo, $encoding) }}</a></li>
              @endif
            @elseif($qtd2 >= 0 && $qtd == 0)  
            <li class="nav-item dropdown {{ (\Request::route()->getName() == 'topico2') ? 'active' : '' }}">
             <a class="nav-link dropdown-toggle" href="topico2" role="button" data-toggle="dropdown" aria-haspopup="true" style="font-size: 13px;"> INSTITUCIONAL </a>
              <ul class="dropdown-menu" aria-labelledby="topico2" style="font-size: 13px; !important;">
                @foreach($topicos2 as $tp2)
                  <li> <a class="dropdown-item" href="{{ route('iframeFarmacia', $tp2->id) }}">{{ $tp2->titulo }}</a> </li>
                @endforeach  
              </ul>
             </a>
            </li>
            @else

            @endif
            </ul>
        </nav>
        @yield('content')
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>