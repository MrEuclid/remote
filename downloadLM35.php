<?php

include "connectDatabaseRemote.php";



      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'time', 'temperature'));  
  	 $query = "SELECT * FROM myRoom";
		$result = mysqli_query($dbServer,$query);
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

?>