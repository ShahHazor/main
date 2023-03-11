<?php
$con = mysqli_connect("localhost", "root", "", "charts");
if ($con) {
  echo "connected";
}
?>
<html>

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Students');
      data.addColumn('number', 'Contribution');

      var options = {
        title: 'Students and their contribution'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      function updateChart() {
        // Fetch new data from the server
        $.ajax({
          url: 'get_data.php',
          dataType: 'json',
          success: function(response) {
            // Convert the response to a DataTable
            var newData = new google.visualization.DataTable();
            newData.addColumn('string', 'Students');
            newData.addColumn('number', 'Contribution');
            newData.addRows(response);

            // Update the chart with the new data
            chart.draw(newData, options);
          },
          complete: function() {
            // Schedule the next update
            setTimeout(updateChart, 1000);
          }
        });
      }

      // Schedule the first update
      setTimeout(updateChart, 1000);
    }
  </script>
</head>

<body>
  <div id="piechart" style="width: 900px; height: 500px;"></div>
</body>

</html>