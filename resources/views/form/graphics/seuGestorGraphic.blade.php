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
          ['0% - <?php echo $perg1a ?>',   <?php echo $perg1a ?>],
          ['1-25% - <?php echo $perg1b ?>',   <?php echo $perg1b ?>],
          ['26-50% - <?php echo $perg1c ?>',   <?php echo $perg1c ?>],
          ['51-75% - <?php echo $perg1d ?>',   <?php echo $perg1d ?>],
          ['> 76% - <?php echo $perg1e ?>',   <?php echo $perg1e ?>]
        ]);
        var options = {
          title: 'Respeito:',
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
          ['0% - <?php echo $perg2a ?>',   <?php echo $perg2a ?>],
          ['1-25% - <?php echo $perg2b ?>',   <?php echo $perg2b ?>],
          ['26-50% - <?php echo $perg2c ?>',   <?php echo $perg2c ?>],
          ['51-75% - <?php echo $perg2d ?>',   <?php echo $perg2d ?>],
          ['> 76% - <?php echo $perg2e ?>',   <?php echo $perg2e ?>]
        ]);
        var options = {
          title: 'Abertura Para Sugestões:',
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
          ['0% - <?php echo $perg3a ?>',   <?php echo $perg3a ?>],
          ['1-25% - <?php echo $perg3b ?>',   <?php echo $perg3b ?>],
          ['26-50% - <?php echo $perg3c ?>',   <?php echo $perg3c ?>],
          ['51-75% - <?php echo $perg3d ?>',   <?php echo $perg3d ?>],
          ['> 76% - <?php echo $perg3e ?>',   <?php echo $perg3e ?>]
        ]);
        var options = {
          title: 'Profissionalismo e Preparação:',
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
          ['0% - <?php echo $perg4a ?>',   <?php echo $perg4a ?>],
          ['1-25% - <?php echo $perg4b ?>',   <?php echo $perg4b ?>],
          ['26-50% - <?php echo $perg4c ?>',   <?php echo $perg4c ?>],
          ['51-75% - <?php echo $perg4d ?>',   <?php echo $perg4d ?>],
          ['> 76% - <?php echo $perg4e ?>',   <?php echo $perg4e ?>]
        ]);
        var options = {
          title: 'Confiança:',
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
          ['0% - <?php echo $perg5a ?>',   <?php echo $perg5a ?>],
          ['1-25% - <?php echo $perg5b ?>',   <?php echo $perg5b ?>],
          ['26-50% - <?php echo $perg5c ?>',   <?php echo $perg5c ?>],
          ['51-75% - <?php echo $perg5d ?>',   <?php echo $perg5d ?>],
          ['> 76% - <?php echo $perg5e ?>',   <?php echo $perg5e ?>]
        ]);
        var options = {
          title: 'Feedback:',
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
        <form action="{{ route('pesqSeuGestor') }}" method="post">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <tr>
            <td colspan="3"><b>Marque qual o seu nível de Satisfação com as questões citadas abaixo:</b></td>
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
              <center>
                <a href="{{ route('graphicsSeuGestor') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> 
              </center>
            </td>
          </tr>
         </form>
        </table>
      </div>
  </body>
</html>