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
          ['Trabalho que Executo - <?php echo $qtd1 ?>',   <?php echo $qtd1 ?>],
          ['Salário - <?php echo $qtd2 ?>',   <?php echo $qtd2 ?>],
          ['Relação com meu gestor - <?php echo $qtd3 ?>',   <?php echo $qtd3 ?>],
          ['Sobrecarga de Trabalho - <?php echo $qtd4 ?>',   <?php echo $qtd4 ?>],
          ['Falta de Treinamento - <?php echo $qtd5 ?>',   <?php echo $qtd5 ?>],
          ['Ausência de Feedback - <?php echo $qtd6 ?>',   <?php echo $qtd6 ?>],
          ['Falta de Autonômia - <?php echo $qtd7 ?>',   <?php echo $qtd7 ?>],
          ['Falta de Reconhecimento - <?php echo $qtd8 ?>',   <?php echo $qtd8 ?>],
          ['Ambiente de Trabalho Ruim - <?php echo $qtd9 ?>',   <?php echo $qtd9 ?>],
          ['Crescimento Impossível - <?php echo $qtd10 ?>',   <?php echo $qtd10 ?>],
        ]);
        var options = {
          title: '',
          width: 1100,
          height: 380,
          pieHole: 0.3,
        };
        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body class="container d-flex align-items-center justify-content-between">
      <div class="container text-center">
        <br>
        <table class="table table-bordeared table-striped">
         <form action="{{ route('pesqConsideracoesFinais2') }}" method="post">
		     <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <tr>
            <td colspan="3"><b>(Considerações Finais) O que te fazem querer deixar de fazer parte do HSS:</b></td>
          </tr>
          <tr>
            <td>Departamento:</td>
            <td>
              <select class="form-control form-control-sm" id="unidade_id" name="unidade_id">
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
            <td colspan="3"><div id="donutchart"></td>
          </tr>
          <tr>
            <td colspan="3">
              <center>
                <a href="{{ route('graphicsConsideracoes') }}" id="Voltar" name="Voltar" type="button" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #FFFFFF;"> VOLTAR <i class="fas fa-undo-alt"></i> </a> 
              </center>
            </td>
          </tr>
         </form>
        </table>
      </div>
  </body>
</html>