<?php
$host = "userdb1";
$user = "1040903_GmK";
$passwd = "AkK6Nt23uiZsql";
$database = "1040903_GmK";

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
die("nie połączono : " . mysql_error());
}

?>