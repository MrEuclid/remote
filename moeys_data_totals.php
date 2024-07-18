<?php 



include "includes/connect_db_euclid_pio.php" ;
// include "UsingPHP2.php" ;

$query = "SELECT Date ,School, SUM(Males) AS Male,SUM(Females) AS Female
 ,(SUM(Males) + SUM(Females)) AS Total 
FROM PIO_results 
WHERE School IN ('SMC', 'BK' , 'BSPH2')
GROUP BY Date,School
ORDER BY Date DESC " ;

include "includes/make_json_from_query.php" ;

?>
