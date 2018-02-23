<?php
$host = "localhost";
$user = "looki";
$passwd = "looki";
$database = "figury";

//$host = "serwer1419412.home.pl/sql/";
//$user = "15187217_sklep";
//$passwd = "ossowska69";
//$database = "15187217_sklep";

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