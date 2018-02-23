<?php
require_once '../db.php';
session_start();
$nazwa = $_GET['nazwa'];
$material = $_GET['material'];
$dlugosc = $_GET['dlugosc'];
$szerokosc = $_GET['szerokosc'];
if (!empty($nazwa) && !empty($material) && !empty($dlugosc) && !empty($szerokosc)){
    $sel = mysql_query("select distinct wysokosc from ramka where rodzaj = '".$nazwa."' and material = '".$material."' and dlugosc = ".$dlugosc." and szerokosc = ".$szerokosc." ;") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo '<option value="' . $row['wysokosc'] . '" >' . $row['wysokosc'] . '</option>';
        }  
//    echo $material;
}



