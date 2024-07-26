<?php

include "../connectTempleDB.php";

 $sensor = $_POST["sensorName"];
// $sensor = "office";
// read database and export for use in plotly

$query = "SELECT dataX ,dataY 
				 FROM arduinoSensor WHERE sensorName = '$sensor' ";

make_json_from_query;

// echo "<br>";

?>