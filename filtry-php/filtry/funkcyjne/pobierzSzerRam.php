<?php
require_once '../db.php';
session_start();
$nazwa = $_GET['nazwa'];
$material = $_GET['material'];
$dlugosc = $_GET['dlugosc'];
if (!empty($nazwa) && !empty($material) && !empty($dlugosc)){
    $sel = mysql_query("select distinct szerokosc from ramka where rodzaj = '".$nazwa."' and material = '".$material."' and dlugosc = ".$dlugosc.";") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo '<option value="' . $row['szerokosc'] . '" >' . $row['szerokosc'] . '</option>';
        }  
//    echo $material;
}



