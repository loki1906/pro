<?php
require_once '../db.php';
session_start();
if(isset($_POST['zamowienie'])){
    $zamowienie = $_POST['zamowienie'];
}
if(isset($_POST['material'])){
    $material = $_POST['material'];
}
if(isset($_POST['dlugosc'])){
    $dlugosc = $_POST['dlugosc'];
}
if(isset($_POST['ilosc'])){
    $ilosc = $_POST['ilosc'];
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['akcja'])){
    $akcja = $_POST['akcja'];
}
if (isset($_POST['margines'])) {
    $margines = $_POST['margines'];
}

if($akcja == 'nowy'){
    if (!empty($material) && !empty($dlugosc) && !is_null($ilosc) && !is_null($margines)){
        $sel = mysql_query("INSERT INTO profil_nosny (material,dlugosc,ilosc,margines) VALUES ('".$material."',".$dlugosc.",".$ilosc.",".$margines.");") or die(mysql_error());
    }
    echo "<script> window.location.replace('../nowyElement.php') </script>" ;
} elseif($akcja == 'dostawa'){
    if (!empty($id) && !empty($ilosc)){
        $sel = mysql_query("update profil_nosny set ilosc = ilosc + ".$ilosc." where id = ".$id.";") or die(mysql_error());
    }
    echo "<script> window.location.replace('../dostawa.php') </script>" ;
} elseif($akcja == 'rozchod'){
    if (!empty($id) && !empty($ilosc)){
        $sel = mysql_query("update profil_nosny set ilosc = ilosc - ".$ilosc." where id = ".$id.";") or die(mysql_error());
    }
    if (!empty($zamowienie)){
        $sel = mysql_query("INSERT INTO `zamowienie`(`numer`, `data`, `kod_el`, `ilosc_el`) VALUES ('".$zamowienie."',current_date,'prn".$id."',".$ilosc.");") or die(mysql_error());
    }
    echo "<script> window.location.replace('../rozchod.php') </script>" ;
}