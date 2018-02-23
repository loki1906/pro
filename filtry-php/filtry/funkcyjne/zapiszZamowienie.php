<?php
require_once '../db.php';
session_start();
if(isset($_POST['zamowienie'])){
    $zamowienie = $_POST['zamowienie'];
}
$nrZamowienia = $_POST['nrZamowienia'];
$rodzFiltra = $_POST['rodzFiltra'];
$idMat = (empty($_POST['idMat']))? 0 : $_POST['idMat'];
$iloscMaterialu = (empty($_POST['ilMater']))? 0 : $_POST['ilMater'];
$idNar = (empty($_POST['idNar']))? 0 : $_POST['idNar'];
$iloscNaroznika = (empty($_POST['ilNar']))? 0 : $_POST['ilNar'];
$idRam = (empty($_POST['idRam']))? 0 : $_POST['idRam'];
$ilRam = (empty($_POST['ilRam']))? 0 : $_POST['ilRam'];
$idPro = (empty($_POST['idPro']))? 0 : $_POST['idPro'];
$ilPro = (empty($_POST['ilPro']))? 0 : $_POST['ilPro'];
$osoba = $_POST['osoba'];

if($idMat!=0 && $iloscMaterialu!=0){
    $sel = mysql_query("select ilosc from material where idMaterialu = '".$idMat."';") or die(mysql_error());
    $row = mysql_fetch_array($sel);
    $wartMat = $row['ilosc'] - $iloscMaterialu ;
    $ins1 = mysql_query("UPDATE material SET ilosc=".$wartMat." WHERE idMaterialu=".$idMat.";") or die(mysql_error());
}
if($idNar!=0 && $iloscNaroznika!=0){
    $sel = mysql_query("select ilosc from naroznik where idNaroznika = '".$idNar."';") or die(mysql_error());
    $row = mysql_fetch_array($sel);
    $wartNar = $row['ilosc'] - $iloscNaroznika ;
    $ins1 = mysql_query("UPDATE naroznik SET ilosc=".$wartNar." WHERE idNaroznika=".$idNar.";") or die(mysql_error());
}
if($idRam!=0 && $ilRam!=0){
    $sel = mysql_query("select ilosc from ramka where idRamki = '".$idRam."';") or die(mysql_error());
    $row = mysql_fetch_array($sel);
    $wartRam = $row['ilosc'] - $ilRam ;
    $ins1 = mysql_query("UPDATE ramka SET ilosc=".$wartRam." WHERE idRamki=".$idRam.";") or die(mysql_error());
}
if($idPro!=0 && $ilPro!=0){
    $sel = mysql_query("select ilosc from profil where idProfilu = '".$idPro."';") or die(mysql_error());
    $row = mysql_fetch_array($sel);
    $wartpro = $row['ilosc'] - $ilPro ;
    $ins1 = mysql_query("UPDATE profil SET ilosc=".$wartpro." WHERE idProfilu=".$idPro.";") or die(mysql_error());
}

if (!empty($nrZamowienia) && !empty($rodzFiltra) && !empty($osoba) ){
    $sel = mysql_query("INSERT INTO `historia`"
            . "(`kto`, `dzien`, `czynnosc`, `Zlecenie_NrZlecenia`, `Rodzaj_filtra_idRodzaju_filtra`, "
            . "`Material_idMaterialu`, `il_msterialu`, `Profil_idProfilu`, `il_profili`, `Ramka_idRamki`, "
            . "`il_ramek`, `Naroznik_idNaroznika`, `il_naroznikow`) "
            . "VALUES ('".$osoba."',curdate(),'zamowienie','".$nrZamowienia."','".$rodzFiltra."',".$idMat.","
            . "".$iloscMaterialu.",".$idPro.",".$ilPro.",".$idRam.",".$ilRam.",".$idNar.",".$iloscNaroznika.");") or die(mysql_error());
                
}
    echo "<script> window.location.replace('../rozchod.php') </script>" ;