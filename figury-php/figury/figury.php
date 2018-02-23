<?php
$title="figury";
require "uwierzyt1.php";

$que = mysql_query("SELECT * FROM figury WHERE NrKat like 'fig%' ");

	include 'szablonPrzedm.php';
?>


