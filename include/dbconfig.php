<?php
$host = "localhost:3307";
$database = "finance";
$uid="root";
$password="asdf";

$con_Mysql = mysql_connect($host,$uid,$password);
$connect = mysql_select_db($database);
?>