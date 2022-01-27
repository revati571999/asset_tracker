@extends('admin.master')
@section('content')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'active'],
        
         <?php echo $chartData?>
        ]);
        

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
<div class="content-wrapper">

    <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
  </body>

@endsection