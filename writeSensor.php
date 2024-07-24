<?php

include "../connectTempleDB.php";
// $ymd = $_POST["yearMonthDay"];


 $cnt = $_POST["cnt"];
 $data = $_POST["data"];
 $name = $_POST["sensorName"];


/*
 $name = "1734";
 $data = 34;
 $cnt = 5;

*/
// echo "writing check";


$query = "INSERT INTO arduinoSensor (sensorName,dataX,dataY) 
VALUES ('$name','$cnt' ,'$data')";

 // echo "<br>" . $query . "<br>";

 mysqli_query($dbServer,$query);

$d = "DONE";
echo $query;

exit();


?>