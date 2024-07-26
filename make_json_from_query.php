<?php

// makes a json object from mysql query in format for Google Visualisation


$result = mysqli_query($dbServer,$query) ;

// get headings and heading types 

$columns = mysqli_field_count($dbServer) ;
$col_name = mysqli_fetch_fields($result) ;
// echo $columns;
$header = array() ;
for ($i = 0 ; $i < $columns ; $i++)
  {
$fieldinfo=mysqli_fetch_field_direct($result,$i);
$fieldname = $fieldinfo->name ;
$fieldtype = $fieldinfo->type ;

//  echo $fieldname . " " . $fieldtype . "<br>" ;
IF ($fieldtype == 252 OR $fieldtype == 253  )
{$fieldtype = "string" ;}
IF ($fieldtype == 10 )
{$fieldtype = "string" ;}

IF ($fieldtype == 3 OR $fieldtype == 5 OR $fieldtype == 16 OR $fieldtype == 8 OR $fieldtype == 246)
{$fieldtype = "number" ;}

$header[$i][0] = $fieldname ;
$header[$i][1] = $fieldtype ;

}


$col=array();
$cols = array() ;
$cols = [];
for ($i = 0 ; $i < $columns ; $i++)
{
$col[]=array();
$col[$i]["id"]="";
$col[$i]["label"]=$header[$i][0];
$col[$i]["pattern"]="";
$col[$i]["type"]=$header[$i][1];
array_push($cols,$col[$i]) ;
}


// now fill the cells with data
// get a new result array

$result = mysqli_query($dbServer,$query) ;

$rows = [] ;
$cellh = array() ;
$cellv = array() ;
$row = [] ;
$j = 0 ;
while ($data = mysqli_fetch_row($result))
{

$temp = [] ;
for ($i = 0 ; $i < $columns ; $i++)
{ 

// echo $i . " = " . $header[$i][0] . " data " . $data[$i] . "<br>" ;
//$cellh[$i]["v"]=$header[$i][0];
// array_push($temp,$cellh[$i]) ;
 $cellv[$i]["v"]= $data[$i];
 array_push($temp,$cellv[$i]) ;
 
}  // for loop

/*
 echo "<br>" ;
 echo "Row " . $j . "<br>" ;
 print_r($temp) ;
 echo "<br>" ;
*/
 $rows[$j] = array('c' => $temp);
$j++ ;
}  // while loop 


$jsondata=array("cols"=>$cols,"rows" => $rows);

 echo json_encode($jsondata) ;
// echo json_encode($jsondata, JSON_NUMERIC_CHECK);

// print_r($jsondata) ;



?>