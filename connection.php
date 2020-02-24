<?php
$servername="localhost";
$username="root";
$password="";
$basename="vijesti";

$dbc = mysqli_connect($servername,$username,$password,$basename) or die("Connection failed ". mysqli_connect_error());
mysqli_set_charset($dbc,"utf8");
if ($dbc) { 
    $a="Connected successfully"; }
?>