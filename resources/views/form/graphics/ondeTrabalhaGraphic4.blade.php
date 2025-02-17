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
            border-left: 1px solid gray;
            border-right: 1px solid gray;
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
          ['0% - <?php echo $perg8a ?>',   <?php echo $perg8a ?>],
          ['1-25% - <?php echo $perg8b ?>',   <?php echo $perg8b ?>],
          ['26-50% - <?php echo $perg8c ?>',   <?php echo $perg8c ?>],
          ['51-75% - <?php echo $perg8d ?>',   <?php echo $perg8d ?>],
          ['> 76% - <?php echo $perg8e ?>',   <?php echo $perg8e ?>]
        ]);
        var options = {
          title: 'Remuneração adequada:',
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
          ['0% - <?php echo $perg9a ?>',   <?php echo $perg9a ?>],
          ['1-25% - <?php echo $perg9b ?>',   <?php echo $perg9b ?>],
          ['26-50% - <?php echo $perg9c ?>',   <?php echo $perg9c ?>],
          ['51-75% - <?php echo $perg9d ?>',   <?php echo $perg9d ?>],
          ['> 76% - <?php echo $perg9e ?>',   <?php echo $perg9e ?>]
        ]);
        var options = {
          title: 'Oportunidade de Crescimento:',
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
          ['0% - <?php echo $perg10a ?>',   <?php echo $perg10a ?>],
          ['1-25% - <?php echo $perg10b ?>',   <?php echo $perg10b ?>],
          ['26-50% - <?php echo $perg10c ?>',   <?php echo $perg10c ?>],
          ['51-75% - <?php echo $perg10d ?>',   <?php echo $perg10d ?>],
          ['> 76% - <?php echo $perg10e ?>',   <?php echo $perg10e ?>]
        ]);
        var options = {
          title: 'Novas e Mais Responsabilidades:',
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
          ['0% - <?php echo $perg11a ?>',   <?php echo $perg11a ?>],
          ['1-25% - <?php echo $perg11b ?>',   <?php echo $perg11b ?>],
          ['26-50% - <?php echo $perg11c ?>',   <?php echo $perg11c ?>],
          ['51-75% - <?php echo $perg11d ?>',   <?php echo $perg11d ?>],
          ['> 76% - <?php echo $perg11e ?>',   <?php echo $perg11e ?>]
        ]);
        var options = {
          title: 'Desenvolvimento Profissional:',
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
          ['0% - <?php echo $perg12a ?>',   <?php echo $perg12a ?>],
          ['1-25% - <?php echo $perg12b ?>',   <?php echo $perg12b ?>],
          ['26-50% - <?php echo $perg12c ?>',   <?php echo $perg12c ?>],
          ['51-75% - <?php echo $perg12d ?>',   <?php echo $perg12d ?>],
          ['> 76% - <?php echo $perg12e ?>',   <?php echo $perg12e ?>]
        ]);
        var options = {
          title: 'Estabilidade do seu Emprego:',
          width: 400,
          height: 300,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart5'));
        chart.draw(data, options);
      }
    </script> 
  </head>
<body class="container d-flex align-items-center justify-content-between">
  <div class="container text-center" style="margin-left: -70px;">
    <br>
      <div class="row">
       <table class="table table-bordeared table-striped">
        <form action="{{ route('pesqOndeTrabalha4') }}" method="post">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <tr>
          <td colspan="3"><b><center>(Onde Trabalha) Assinale de acordo com o seu Grau de Satisfação:</center></b></td>
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
          <td><br><div id="donutchart1"></div></td>
          <td><br><div id="donutchart2"></div></td> 
          <td><br><div id="donutchart3"></div></td>
        </tr>
        <tr>
          <td><div id="donutchart4"></div></td>
          <td><div id="donutchart5"></div></td>
          <td><br><br><br><br><b>Total de Pesquisas: {{ $total }}</b></td>
        </tr>
        <tr>
          <td colspan="3">
            <center>
              <a href="{{ route('graphicsOndeTrabalha') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> 
            </center>
          </td>
        </tr>
       </form>
      </table> 
    </div>
</body>
</html>