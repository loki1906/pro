<?php

require_once '../db.php';
session_start();

$host = "localhost";
$user = "loki";
$passwd = "password";
$database = "magazyn";

$mysqldump=exec('path mysqldump');
echo $mysqldump;
//$sel = mysql_query("mysqldump --opt -h localhost -u loki -ppassword magazyn > C:\\xampp\\htdocs\\filtry\\magazyn.sql");
$command = "mysqldump.exe --opt -h localhost -u loki -ppassword magazyn > C:\\xampp\\htdocs\\filtry\\magazyn.sql";

echo exec("dir");//$command);


//echo "<script> window.location.replace('../index.php') </script>" ;