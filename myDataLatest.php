<?php 



include "connectDatabaseRemote.php" ;
// include "UsingPHP2.php" ;

$query = "SELECT d1 FROM myData ORDER BY id DESC LIMIT 1" ;


include "make_json_from_query.php" ;

?>
