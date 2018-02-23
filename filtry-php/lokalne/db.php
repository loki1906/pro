<?php
$host = "localhost";
$user = "loki";
$passwd = "password";
$database = "magazyn";

$dbc = mysql_connect($host,$user,$passwd);
if(!$dbc)
{
die("nie połączono : " . mysql_error());
}
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_general_ci`"); 

$db_selected = mysql_select_db($database, $dbc);
if(!$db_selected)
{
die("cant connect : " . mysql_error());
}

?>