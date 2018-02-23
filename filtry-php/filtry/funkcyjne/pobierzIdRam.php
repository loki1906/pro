<?php
require_once '../db.php';
session_start();
$nazwa = $_GET['nazwa'];
$material = $_GET['material'];
$dlugosc = $_GET['dlugosc'];
$szerokosc = $_GET['szerokosc'];
$wysokosc = $_GET['wysokosc'];
if (!empty($nazwa) && !empty($material) && !empty($dlugosc) && !empty($szerokosc) && !empty($wysokosc)){
    $sel = mysql_query("select idRamki from ramka where rodzaj = '".$nazwa."' and material = '".$material."' and dlugosc = ".$dlugosc." and szerokosc = ".$szerokosc." and wysokosc = ".$wysokosc." ;") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo  $row['idRamki'];
        }  
//    echo $material;
}



