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
            background: #fafafa;
        }
        body h1{
            margin-top: 8px;
        }
        main{
            padding: 0px;
            margin: auto;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['0% - <?php echo $perg4a ?>',   <?php echo $perg4a ?>],
          ['1-25% - <?php echo $perg4b ?>',   <?php echo $perg4b ?>],
          ['26-50% - <?php echo $perg4c ?>',   <?php echo $perg4c ?>],
          ['51-75% - <?php echo $perg4d ?>',   <?php echo $perg4d ?>],
          ['> 76% - <?php echo $perg4e ?>',   <?php echo $perg4e ?>]
        ]);
        var options = {
          title: 'Moradia:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart1'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['0% - <?php echo $perg5a ?>',   <?php echo $perg5a ?>],
          ['1-25% - <?php echo $perg5b ?>',   <?php echo $perg5b ?>],
          ['26-50% - <?php echo $perg5c ?>',   <?php echo $perg5c ?>],
          ['51-75% - <?php echo $perg5d ?>',   <?php echo $perg5d ?>],
          ['> 76% - <?php echo $perg5e ?>',   <?php echo $perg5e ?>]
        ]);
        var options = {
          title: 'Situação Financeira:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['0% - <?php echo $perg6a ?>',   <?php echo $perg6a ?>],
          ['1-25% - <?php echo $perg6b ?>',   <?php echo $perg6b ?>],
          ['26-50% - <?php echo $perg6c ?>',   <?php echo $perg6c ?>],
          ['51-75% - <?php echo $perg6d ?>',   <?php echo $perg6d ?>],
          ['> 76% - <?php echo $perg6e ?>',   <?php echo $perg6e ?>]
        ]);
        var options = {
          title: 'Alimentação:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
        chart.draw(data, options);
      }
    </script> 
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['0% - <?php echo $perg7a ?>',   <?php echo $perg7a ?>],
          ['1-25% - <?php echo $perg7b ?>',   <?php echo $perg7b ?>],
          ['26-50% - <?php echo $perg7c ?>',   <?php echo $perg7c ?>],
          ['51-75% - <?php echo $perg7d ?>',   <?php echo $perg7d ?>],
          ['> 76% - <?php echo $perg7e ?>',   <?php echo $perg7e ?>]
        ]);
        var options = {
          title: 'Educação:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart4'));
        chart.draw(data, options);
      }
    </script> 
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Elemento', 'Total'],
          ['0% - <?php echo $perg8a ?>',   <?php echo $perg8a ?>],
          ['1-25% - <?php echo $perg8b ?>',   <?php echo $perg8b ?>],
          ['26-50% - <?php echo $perg8c ?>',   <?php echo $perg8c ?>],
          ['51-75% - <?php echo $perg8d ?>',   <?php echo $perg8d ?>],
          ['> 76% - <?php echo $perg8e ?>',   <?php echo $perg8e ?>]
        ]);
        var options = {
          title: 'Transporte:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart5'));
        chart.draw(data, options);
      }
    </script>  
    <title>Pesquisa de Clima</title>
</head>
<body class="container d-flex align-items-center justify-content-between">
      <div class="container text-center" style="margin-left: -90px;">
        <br>
        <table class="table table-bordeared table-striped">
         <form action="{{ route('pesqSobreVoce2') }}" method="post">
		     <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <tr>
            <td colspan="3"><b>(Sobre Você) Marque qual o seu nível de Satisfação com as questões citadas abaixo:</b></td>
          </tr>
          <tr>
            <td>Departamento:</td>
            <td>
              <select width="400px" class="form-control form-control-sm" id="unidade_id" name="unidade_id">
               <option value="0">{{ 'TODOS' }}</option>
               @foreach($departamentos as $depart)
                <option value="<?php echo $depart->id; ?>">{{ $depart->departamento }}</option>
               @endforeach
              </select>
            </td>
            <td>
              <input type="submit" id="pesquisar" name="pesquisar" class="btn btn-sm btn-info" value="Pesquisar"> 
            </td>
          </tr>
          <tr>
            <td><br><div id="donutchart1"></td>
            <td><br><div id="donutchart2"></td>
            <td><br><div id="donutchart3"></td>
          </tr>
          <tr>
            <td><div id="donutchart4"></td>
            <td><div id="donutchart5"></td>
            <td><br><br><br><br><b>Total de Pesquisas: {{ $total }}</b></td>
          </tr>
          <tr>
            <td colspan="3">
              <center> <a href="{{ route('graphicsSobreVoce') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> </center>
            </td>
          </tr>
         </form>
        </table>
      </div>
  </body>
</html>