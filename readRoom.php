<?php

include "connectDatabaseRemote.php";

// read database and export for use in plotly

$query = "SELECT id,temperature  FROM myRoom ORDER BY id DESC LIMIT 1";
$result = mysqli_query($dbServer,$query);
$data = mysqli_fetch_row($result);
$output =[];
$dataX = [];
$dataY = [];
$time = [];
$i = 0 ;


	$dataX[$i] = $data[0] ; // id = x
	$dataY[$i] = $data[1] ; // temperature = y 
	
	$output[$i][0] = $data[0];
	$output[$i][1] = $data[1];




// print_r($output);
$myJSON = json_encode($output);
// echo "<br>";
echo $myJSON;
// echo "<br>";
?>