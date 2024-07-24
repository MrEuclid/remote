<?php

include "../connectTempleDB.php";

 $name = $_POST['sensorName'];
//$name = "1234A";
// read database and export for use in plotly

$query = "SELECT *  FROM arduinoSensor  WHERE sensorName = '$name' ";

// echo "<br>" . $query . "<br>";


$result = mysqli_query($dbServer,$query);
$n = mysqli_num_rows($result);
echo $n;
//$myJSON = json_encode($n);
// echo "<br>";
//echo $myJSON;
// echo "<br>";

exit();

?>