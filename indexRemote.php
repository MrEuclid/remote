<!DOCTYPE html>
<html lang="en">
  <head>
 
<meta http-equiv="refresh" content="5">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    



    <meta charset="utf-8">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Viewing data</title>

<style type="text/css">

#counter {position:absolute; top:100px ; left:200px ; font-size:28pt ; color:red ;}

#two {font-weight: bolder;color: red ; font-size: 24pt ;}
</style>


  </head>
  <body>
  
    <div class  = "container-fluid">
      <div class = "row">
        <div class = "col-md-12 c">
   <h1><img id = "pio1" src = "images/PioLogo.png" width = "50px" height = "50px">
View my Data
   <img id = "pio2" src = "images/PioLogo.png" width = "50px" height = "50px">
 </h1>
</div></div>


<div class = "row">
<div class = "col-md-12 c">

<h2>Data</h2>
<p>
This page displays data that has been sent from an Arduino. The data first goes to a computer running Pythom.
The python code writes the data to a MYSQL database. After that the data is prcessed so that it can be visulaised.
</p>

<?php echo "Hi" ;
// phpinfo() ;
include "connectDatabaseRemote.php" ;
$myTable = 'mySensor' ;
$query = "SELECT cnt,data FROM mySensor ORDER BY time DESC LIMIT 1";
$result = mysqli_query($dbServer,$query) ;
$n = mysqli_num_rows($result) ;
$data = mysqli_fetch_assoc($result);
$sensorData = $data["data"];

echo $sensorData ;

if ($sensorData == 1) {
echo "The robot sees <font color=\"red\">red</font>!";}

if ($sensorData == 2) {

echo "The robot sees <font color=\"green\">green</font>!";}
if ($sensorData == 3) {
echo "The robot sees <font color=\"blue\">blue</font>!";}
if ($sensorData == 4) {
echo "The robot sees <font color=\"yellow\">yellow</font>!";}


echo "Value  = " . $data["data"] ;
?>

<div id = "counter"><h1 id = "code"><?php echo $sensorData ; ?></h1></div>

  </div></div>


<div class = "row">
<div class = "col-md-12 c">
<h2>
  View - Sensor - Arduino - Data
</h2>
</div></div>


  </body>
</html>


<script type="text/javascript">
  
   $(document).ready(function(){
 
     $('window').on('unload', function(){

      var c = $('#code').val() ;
      c = parseInt(c);
      console.log(c)
  


    })
   })

</script>

