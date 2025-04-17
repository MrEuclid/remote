<?php
echo "connecting";

    $server = 'localhost' ;
    $username = 'teacherj_esp32';
    $password = 'pythagoras1950' ;
    $database = 'teacherj_remote' ;
    $dbServer = mysqli_connect($server,$username,$password,$database);
    mysqli_select_db($dbServer,$database) or die("Unable to select database: " . mysqli_error()) ;

 $sensor = $_POST['sensor'];
 $place = $_POST['place'];
 $value1 = $_POST['value1'];
 $value2 = $_POST['value2'];
 $value3 = $_POST['value2'];;


/*
 $sensor =  "DHT11";
 $location = "Hpme3";
 $value1 = 48;
 $value2 = 65;
 $value3 = 0;
 
*/
$query = "INSERT INTO sensorData
(sensor,place,value1,value2,value3)
VALUES
(
'$sensor',
'$place',
'$value1',
'$value2',
'$value3'
)";


// echo "<br>" . $query . "<br>";

mysqli_query($dbServer,$query);

$query = "SELECT * FROM sensorData";
$result = mysqli_query($dbServer,$query);
// echo "<br>" . $query . "<br>" ;
$n = mysqli_num_rows($result);
// echo "Rows " . $n;


?>
