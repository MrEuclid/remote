<?php $delay = 30;

// Redirect to the current page after the specified delay
header("Refresh: $delay");
?>

<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
  <div id="chart_div"></div>
  <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(fetchData);
setInterval(fetchData, 60000); // Refresh every minute
    function fetchData() {
      // ... your data fetching and parsing logic
        // Replace this with your actual data fetching logic
  


       dataArray = $.ajax({
            url: "readRefresh.php",
            dataType: "json",
          async: false
        }).responseText;

     data = new google.visualization.DataTable(dataArray);

      drawChart(data);
    
    }

    function drawChart(data) {
      // ... chart creation and drawing logic
         const options = {
    title: 'Real-time Data',
    curveType: 'function',
    legend: { position: 'bottom' }
  };

  const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  setInterval(chart.draw(data, options),5000);
    }

  //  setInterval(fetchData, 60000); // Refresh every minute
  </script>
</body>
</html>

<