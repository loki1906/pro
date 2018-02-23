<?php
require_once '../db.php';
session_start();
$tablica = $_POST['tablica'];
$id = $_POST['id'];
$ilosc = $_POST['ilosc'];
$idZlec = $_POST['idZlec'];

if (!empty($id) && !empty($tablica)){
    $sel = mysql_query("update ".$tablica." set ilosc = ilosc + ".$ilosc." where id = ".$id.";") or die(mysql_error());
//    echo "DELETE FROM ".$tablica." WHERE id=".$id.";";
    
    //$kod = substr($tablica,0,3).$id;
    //$sel2 = mysql_query("select id from zamowienie where kod_el = '".$kod."' and numer = '". $idZlec ."' ;")or die(mysql_error());
   
    //while ($row=mysql_fetch_array($sel2))
     //   {
           $sel = mysql_query("DELETE FROM zamowienie WHERE id=".$idZlec.";") or die(mysql_error());
     //   } 
        echo "<script> window.location.replace('../zlecenia.php') </script>" ;
}