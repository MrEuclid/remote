<?php

include "connectDatabaseRemote.php";

// $ymd = $_POST["yearMonthDay"];
 $hm = $_POST["hourMinute"];
 $temp = $_POST["temperature"];



// $hm = "12-34";
// $temp = 34.397;



$output = [];
$i = 0;
$query = "INSERT INTO myRoom (hourMinute,temperature) 
VALUES ('$hm' ,'$temp')";

// echo "<br>" . $query . "<br>";

mysqli_query($dbServer,$query);



exit();


?>