<?php
require_once '../db.php';
session_start();
if(isset($_POST['zamowienie'])){
    $zamowienie = $_POST['zamowienie'];
}
if (isset($_POST['rodzaj'])) {
    $rodzaj = $_POST['rodzaj'];
}
if (isset($_POST['typ'])) {
    $typ = $_POST['typ'];
}
if (isset($_POST['wymiar'])) {
    $wymiar = $_POST['wymiar'];
}
if (isset($_POST['ilosc'])) {
    $ilosc = $_POST['ilosc'];
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
if (isset($_POST['akcja'])) {
    $akcja = $_POST['akcja'];
}
if (isset($_POST['margines'])) {
    $margines = $_POST['margines'];
}

if($akcja == 'nowy'){
    if (!empty($rodzaj) && !empty($typ) && !empty($wymiar) && !is_null($ilosc) && !is_null($margines)){
        $sel = mysql_query("INSERT INTO `ramka`( `rodzaj`, `typ`, `wymiar`, `ilosc`,`margines`)"
                . " VALUES ('".$rodzaj."','".$typ."','".$wymiar."',".$ilosc.",".$margines.");") or die(mysql_error());
    }
    echo "<script> window.location.replace('../nowyElement.php') </script>" ;
} elseif($akcja == 'dostawa'){
    if (!empty($id) && !empty($ilosc)){
        $sel = mysql_query("update ramka set ilosc = ilosc + ".$ilosc." where id = ".$id.";") or die(mysql_error());
    }
    echo "<script> window.location.replace('../dostawa.php') </script>" ;
} elseif($akcja == 'rozchod'){
    if (!empty($id) && !empty($ilosc)){
        $sel = mysql_query("update ramka set ilosc = ilosc - ".$ilosc." where id = ".$id.";") or die(mysql_error());
    }
    
    if (!empty($zamowienie)){
        $sel = mysql_query("INSERT INTO `zamowienie`(`numer`, `data`, `kod_el`, `ilosc_el`) VALUES ('".$zamowienie."',current_date,'ram".$id."',".$ilosc.");") or die(mysql_error());
    }
    echo "<script> window.location.replace('../rozchod.php') </script>" ;
}