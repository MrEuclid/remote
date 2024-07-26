<?php
// make pie

  include "../connectTempleDB.php";


$query = "CREATE TEMPORARY TABLE t1 SELECT * FROM psmarks ORDER BY RAND() LIMIT 50";
mysqli_query($dbServer,$query);


  $query = "SELECT round(mark,0) as m , count(id) AS N
            FROM  t1
            WHERE mark <= 10 
            GROUP BY m
            ORDER BY m" ;

// $query = "SELECT * FROM t1";
//echo "<br>" . $query . "<br>" ;
 include "make_json_from_query.php";

?>
