<?php 



include "connectDatabaseRemote.php" ;
// include "UsingPHP2.php" ;

$query = "SELECT AVG(d1)*5 AS Average FROM myData " ;


include "make_json_from_query.php" ;

?>
