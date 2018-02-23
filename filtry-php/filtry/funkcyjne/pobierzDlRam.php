<?php
require_once '../db.php';
session_start();
$nazwa = $_GET['nazwa'];
$material = $_GET['material'];
if (!empty($nazwa) && !empty($material)){
    $sel = mysql_query("select distinct dlugosc from ramka where rodzaj = '".$nazwa."' and material = '".$material."';") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo '<option value="' . $row['dlugosc'] . '" >' . $row['dlugosc'] . '</option>';
        }  
//    echo $material;
}



