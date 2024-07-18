<?php


    $server = 'localhost' ;
    $username = 'euclid_remote';
    $password = 'pythagoras' ;
    $database = 'euclid_remote' ;
    $dbServer =mysqli_connect ($server,$username,$password,$database);
    mysqli_select_db($dbServer,$database)or die("Unable to select database: " . mysqli_error()) ;

    mysqli_query($dbServer,"SET NAMES 'utf8'");


?>
