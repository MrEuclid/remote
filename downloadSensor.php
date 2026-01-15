<?php
 //header('Content-type: text/csv; charset=UTF-8');
 //header('Content-disposition: attachment; filename=sensor.csv');

include "../connectTempleDB.php";

 $sensor = $_POST['sensorName'];
 // $sensor = "G11test2" ;
    //  header('Content-Type: text/csv; charset=utf-8');  
    //  header('Content-Disposition: attachment; filename=data.csv');  
        $file = fopen("data.csv","w");
      // $output = fopen("php://output", "w");  
     fputcsv($file, array('ID', 'sensor', 'X',"Y","Z","T"));  
  	 $query = "SELECT * FROM arduinoSensor WHERE sensorName  = '$sensor' ";


		$result = mysqli_query($dbServer,$query);
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($file, $row);  
      }  
      fclose($file);  

  include "../print_query_data_plain.php";

?>
