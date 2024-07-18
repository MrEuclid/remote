4<!DOCTYPE html>
<html lang="en">
  <head>
 
<meta http-equiv="refresh" content="30">



   <meta charset="utf-8">

    <title>Display sensor</title>
  
  <link href='http://fonts.googleapis.com/css?family=Khmer' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
  
      google.load('visualization', '1.1', {packages: ['controls']});
 
  //  google.charts.load('current', {packages: ['gauge']});
      google.load("visualization", "1.1", {packages:["gauge"]});
    </script>
   
 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link rel="stylesheet" type="text/css" href="css/dentalStyles.css">
  <style>
  #centred-text { text-align: center ;
  position:absolute;
top:50px;
left:auto ;
right:auto;
width:60%;}

.c   { text-align: center ; left:auto ; }
#counter { font-size:24pt ; color:red ;}
#two {font-weight: bolder;color: red ; font-size: 24pt ;}


</style>

<script type="text/javascript">
     google.setOnLoadCallback(drawGauge);
    google.setOnLoadCallback(drawGauge2);
    

 function drawGauge() {

   var jsonData =      $.ajax({
         url: "myDataLatest.php",
         dataType: "json",
     async: false
        }).responseText;
    
     var dataall = new google.visualization.DataTable(jsonData);

        var options = {
          width: 300, height: 120,
          redFrom: 1300, redTo: 1500,
      
      max:100,
        };

        var gauge = new google.visualization.Gauge(document.getElementById('gaugeSingle'));

        gauge.draw(dataall, options);
   
   }
   

  
  function drawGauge2() {

   var jsonData =      $.ajax({
         url: "myDataAverage.php",
         dataType: "json",
     async: false
        }).responseText;
    
     var dataall = new google.visualization.DataTable(jsonData);

        var options = {
          width: 300, height: 120,
          redFrom: 1300, redTo: 1500,
      
      max:100,
        };

        var gauge = new google.visualization.Gauge(document.getElementById('gaugeAverage'));

        gauge.draw(dataall, options);
   
   }
</script>


  </head>
  <body>



  
<div class  = "container-fluid">

      <div class = "row">
        <div class = "col-md-12 c">
 
<h2>View my Data</h1>
</div></div>




<div class = "row">
<div class = "col-md-12">

<h2 class = "c">Data Gauges - Latest value & Average value</h2>
<p>
This page displays data that has been sent from an Arduino. The data first goes to a computer running Pythom.
The python code writes the data to a MYSQL database. After that the data is processed so that it can be visualised.
</p>



<div class = "row">


<div class="col-md-6 c">  
<div id = "gaugeSingle"></div>
</div>
<div class="col-md-6 c"> 
<div id = "gaugeAverage"></div>
</div>

</div>



<?php
include "connectDatabaseRemote.php" ;
$myTable = 'myData' ;
$query = "SELECT * FROM myData ";
$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
//echo "<br>" . $query . "<br>" ;
echo "N = " . $n ;

$query = "SELECT max(d3) as maximus,min(d3) as minimus, AVG(d3) AS mean FROM myData" ;
$result = mysqli_query($dbServer,$query) ;
$data = mysqli_fetch_assoc($result) ;
// echo "<br>" . $query . "<br>" ;
$max = $data["maximus"];
$min = $data["minimus"] ;
$avg = $data["mean"] ;
echo "<br>" ;
echo "Maximum " . $max . " , Minimum " . $min . " and average = " . $avg ;
echo "<br>" ;

$query = "SELECT id,d3 as val FROM myData
ORDER BY id DESC limit 1 " ;
$result = mysqli_query($dbServer,$query) ;

echo "<h2>Last result</h2>" ;
echo "<br>" . $query . "<br>" ;
while ($data = mysqli_fetch_assoc($result) )
{
$id = $data["id"] ;
$val = $data["val"] ;
echo "<br>" ;
echo $id . " -  Value -  " . $val ;
//echo "<br>" ;
}
?>

<div id = "counter"><h1><?php echo $n ; ?></h1></div>




<div class = "row">
<div class = "col-md-12 c">
<h2>
  View - Sensor - Arduino - Data
</h2>
</div></div>


  </body>
</html>




