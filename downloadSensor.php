<?php
header('Content-type: text/csv; charset=UTF-8');
header('Content-disposition: attachment; filename=sensor.csv');

include "../connectTempleDB.php";

 $sensor = $_GET['sensorName'];
// $sensor = "office" ;
    //  header('Content-Type: text/csv; charset=utf-8');  
    //  header('Content-Disposition: attachment; filename=data.csv');  

      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'sensor', 'X',"Y","Z","T"));  
  	 $query = "SELECT * FROM arduinoSensor WHERE sensorName  = '$sensor' ";
		$result = mysqli_query($dbServer,$query);
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
echo "done";
?>