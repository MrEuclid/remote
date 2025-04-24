<?php

// load team 

 include "../connectTempleDB.php";

  $team = $_POST['teamName'];

// $team = 'student';

// have fixed collation on mobile network

$output = [] ;
$i = 0;


$query = "SELECT question FROM mathsCompetitionResults
			WHERE  teamName = '$team'  ";

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