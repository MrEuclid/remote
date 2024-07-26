<?php 



 $sensor = $_POST['sensorName'];

// $sensor = "office";
// $d1 = '2023-01-01';
// $d2 = '2023-11-01';
//$code = "SMC";
$file = $sensor . "_level_1_visit_report.xlsx" ;
 header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=".$file);

include "../connectTempleDB.php";

?>
 <meta charset="utf-8">



<head>
<title>Export to Excel</title>

</head>
<body>

<?php



$output = [];
$data = [];
$i = 0;

 $query = "SELECT * FROM arduinoSensor WHERE sensorName  = '$sensor' ";
   
include "../print_query_data_plain.php" ;


?>

</body>
</html>
