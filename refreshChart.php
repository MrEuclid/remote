<!--
https://stackoverflow.com/questions/63584223/how-to-refresh-google-charts-periodically
function getData() {
    $.ajax({
      url: 'get_data.url',   // <-- use url to new page here
      dataType: 'JSON'
    }).done(function (data) {
      drawChart(data);
    });
}
then, wait for the chart's ready event, before calling setTimeout.
because we don't know how long it will take to get the data and draw the chart.
so let's wait for the first chart to finish, before trying again.

see following snippet...

google.charts.load('current', {
  packages:['timeline']
}).then(getData);            // <-- load google charts, then get the data

function getData() {
    $.ajax({
      url: 'get_data.url',   // <-- use url to new page here
      dataType: 'JSON'
    }).done(function (data) {
      drawChart(data);       // <-- draw chart with data from new page
    });
}


function drawChart(obje) {
    $(".timeline").each(function () {
        var elem = $(this),
            id = elem.attr('id');
        var container = document.getElementById(id);
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({type: 'string', id: 'Role'});
        dataTable.addColumn({type: 'string', id: 'Name'});
        dataTable.addColumn({type: 'date', id: 'Start'});
        dataTable.addColumn({type: 'date', id: 'End'});
        dataTable.addColumn({type: 'string', id: 'TimeEst'});
        dataTable.addColumn({type: 'string', role: 'style'});
        for (n = 0; n < obje.length; ++n) {
            if (obje[n].device_id == id) {
                dataTable.addRows([
                    ['Department', obje[n].digitaloutput_user_description, new Date('"' + obje[n].startdatetime + '"'), new Date('"' + obje[n].enddatetime + '"'), obje[n].lighstate_user_description, obje[n].color],
                ]);
            }
        }

        for (n = 0; n < obje.length; ++n) {
            if (obje[n].device_id == id) {
                console.log(obje[n].color)

            }
        }

        var options = {
            chartArea: {
                height: '90%',
                width: '100%',
                top: 36,
                right: 12,
                bottom: 2,
                left: 12
            },
            height: 100,
            tooltip: {isHtml: true},
            timeline: {
                showRowLabels: false,
            },
            avoidOverlappingGridLines: false,
            {#hAxis: {format: 'dd-MMM-yyyy HH:mm:ss'}#}

        };

        var formatTime = new google.visualization.DateFormat({
            pattern: 'yyyy-MM-dd HH:mm:ss a'
        });

        var view = new google.visualization.DataView(dataTable);
        view.setColumns([0, 1, {
            role: 'tooltip',
            type: 'string',
            calc: function (dt, row) {
                // build tooltip
                var dateBegin = dt.getValue(row, 2);
                var dateEnd = dt.getValue(row, 3);
                var oneHour = (60 * 1000);
                var duration = (dateEnd.getTime() - dateBegin.getTime()) / oneHour;

                var tooltip = '<div><div class="ggl-tooltip"><span>';
                tooltip += dt.getValue(row, 0) + ':</span>&nbsp;' + dt.getValue(row, 1) + '</div>';
                tooltip += '<div class="ggl-tooltip"><div>' + formatTime.formatValue(dateBegin) + ' - ';
                tooltip += formatTime.formatValue(dateEnd) + '</div>';
                tooltip += '<div><span>Duration: </span>' + duration.toFixed(0) + ' minutes</div>';
                tooltip += '<div><span>Estate: </span>' + dt.getValue(row, 5) + '</div></div>';

                return tooltip;
            },
            p: {html: true}
        }, 2, 3]);

        google.visualization.events.addListener(chart, 'ready', function () {
            var labels = container.getElementsByTagName('text');
            Array.prototype.forEach.call(labels, function (label) {
                label.setAttribute('font-weight', 'normal');
            });

            setTimeout(getData, 5000);       // <-- get data and draw again in 5 seconds
        });

        chart.draw(view.toDataTable(), options);
    });
}
Share
Improve this answer
Follow
answered Aug 25, 2020 at 18:01
WhiteHat's user avatar
WhiteHat
60.7k77 gold badges5353 silver badges135135 bronze badges
Add a comment

-->


<?php 
$question = $_POST['question'];
// bar chart with questions
?>

<!DOCTYPE html>
<html lang="en">

  <head>
 
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <script src="../javaScript/jQuery/jquery-3.3.1.min.js"></script>
  <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src = "https://cdnjs.com/libraries/mathjs"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>

  <script type="text/javascript" src="../javaScript/mathJax/MathJax-2.7.7/MathJax.js"></script>

<link rel="stylesheet" href="../css/templeStyles.css">
<link rel="stylesheet" href="../css/newTempleStyles.css">
<link rel="stylesheet" href="race2024.css">

<script src="javascript/utilities.js"></script>



 <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      extensions: ["tex2jax.js"],
      jax: ["input/TeX","output/HTML-CSS"],
      tex2jax: {inlineMath: [["$","$"],["\\(","\\)"]]}
    });
  </script>   
  
   <script type="text/javascript">
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
  </script>
  
  <script type="text/javascript" src="../MathJax-2.7.5/MathJax.js"></script>
  <link rel="stylesheet" href="race2024.css">
<script src="javascript/utilities.js"></script>

<title>Refresh</title>

<style>

</style>

<script>
      $(document).ready(function(){

 myData =[];
})
</script>

</head>
<body>
  <div class  = "container-fluid">
  


    <div class = "row justify-content-center">
      <div class = "col-12">
 <h3>Refreshes sesnor data every 4 seconds</h3>

</div></div>


 <div class = "row justify-content-center">
      <div class = "col-">
      <div id="table"></div>
    </div></div>






 </div> <!-- container -->   
  </body>
</html>
<script type="text/javascript">

      $(document).ready(function(){
points = 0 ;
answer = [];
      })
</script>

  <!--Load the AJAX API-->

    <script type="text/javascript">


      // Load the Visualization API and the controls package.
    
      google.charts.load("current", {packages : [ "corechart","table" ]});
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawTable);

      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawTable() {

       data = $.ajax({
            url: "columnChartData.php",
            dataType: "json",
          async: false
        }).responseText;

     dt = new google.visualization.DataTable(data);
     var view = new google.visualization.DataView(dt);
 // var view = new google.visualization.DataView(data);
      view.setColumns([0,1,
      
                       { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" }]);
      
      var options = {
        title: "English marks",
        width: 800,
        height: 400,
        vAxis: { format:'##',
        title:'N'} ,
        hAxis: { format:'##'} ,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        hAxis: {
          title:'Score',
    viewWindow: {
        min: 0,
        max: 10
    },
    ticks: [1,2,3,4,5,6,7,8,9,10,11] // display labels every 25
}
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("table"));
      chart.draw(view, options);
  }


      
    </script>

<script type="text/javascript">
  
  function dataTableTo2DArray(dataTable) {
  const numRows = dataTable.getNumberOfRows();
  const numCols = dataTable.getNumberOfColumns();
  const twoDimArray = [];

  // Extract column names (headers)
  const headers = [];
  for (let i = 0; i < numCols; i++) {
    headers.push(dataTable.getColumnLabel(i));
  }
  twoDimArray.push(headers); // Add headers as first row

  // Extract data for each row
  for (let i = 0; i < numRows; i++) {
    const row = [];
    for (let j = 0; j < numCols; j++) {
      row.push(dataTable.getValue(i, j));
    }
    twoDimArray.push(row);
  }

  return twoDimArray;
}

</script>




