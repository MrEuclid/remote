<?php

include "connectDatabaseRemote.php";

// $ymd = $_POST["yearMonthDay"];

 $hm = $_POST["hourMinute"];
 $temp = $_POST["temperature"];
 $thing = $_POST["thing"];


/*
 $hm = "17-34";
 $temp = 34.397;
 $thing = 'LM35_1737';

*/
// echo "writing check";

 $query = "SELECT max(hourMinute) AS M from myRoom";
 $result = mysqli_query($dbServer,$query);
 $data = mysqli_fetch_row($result);
 $m = $data[0];
// echo "<br>" . $query . "<br>";
// echo $hm . " m " .$m;
if ($hm > $m)
{$output = [];
$i = 0;
$query = "INSERT INTO myRoom (thing,hourMinute,temperature) 
VALUES ('$thing','$hm' ,'$temp')";

// echo "<br>" . $query . "<br>";

mysqli_query($dbServer,$query);

 $d = "OK" ;
}
else
	{$d = "NO";}
echo json_encode($d);


?>