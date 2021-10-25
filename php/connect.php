<?php

// $con = mysqli_connect("localhost", "root", "root") or die ("No connection"); 
// mysqli_select_db($con, "ClothingShop") or die("db will not open")

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

 $mysqli = new mysqli("localhost", "root", "root", "ClothingShop"); 

 /* Check connection */

 if($mysqli->connect_error){
     die("$mysqli->connect_errno: $mysqli->connect_error");
 }
?>