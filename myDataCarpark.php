<?php 



include "connectDatabaseRemote.php" ;
// include "UsingPHP2.php" ;

$query = "SELECT id,n,carparkID FROM myCarPark ORDER BY id " ;

// gets number of cars at specific times from myCarpark table.


include "make_json_from_query.php" ;

?>
