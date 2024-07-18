
<?php

include "../includes/mySession.php" ;
include "../connectDatabase.php" ;
$query = "SELECT 
sites.province AS Province,

count(patients.id) AS N, 
round(100*(count(patients.id) / (SELECT count(id) FROM patients WHERE school_id > '')),2) AS ColPercent,
sum(case when gender = 'F' then 1 else 0 end) AS Female,
round(sum(case when gender = 'F' then 1 else 0 end) / count(patients.id)*100,2) AS femalePercent,
sum(case when gender = 'M' then 1 else 0 end) AS Male,
round(sum(case when gender = 'M' then 1 else 0 end) / count(patients.id)*100,2) AS malePercent
from patients
join sites on sites.code = school_id
join finished_level_3 on patients.id = finished_level_3.patient_id

AND date_finished >= '$start'
AND date_finished <= '$finish'



GROUP bY  province



" ;

include "makeJSONFromQuery.php";
?>