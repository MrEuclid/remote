<?php

// load team 

 include "../connectTempleDB.php";

  $team = $_POST['team'];
// $team = "Rabbit*34";
  // split on asterisk
 // echo "Team was =  " . $team . "<br>";

 $t =  explode("*",$team);

 $t0 = $t[0];
// echo "Team =>" . $t0 . "<br>";

// $team = 'student';

// have fixed collation on mobile network

$output = [] ;
$i = 0;


$query = "SELECT question FROM mathsCompetitionResults
			WHERE  teamName = '$t0'  ";

// echo "<br>" . $query. "<br>";

$result = mysqli_query($dbServer,$query) ;

WHILE ($data = mysqli_fetch_row($result))
{
	$output[$i] = $data[0];
	$i++;
}

// echo  $query ;

echo json_encode($output);

exit() ;
?>