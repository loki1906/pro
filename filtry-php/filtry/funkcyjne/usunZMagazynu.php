<?php
require_once '../db.php';
session_start();
$tablica = $_POST['tablica'];
$id = $_POST['id'];

if (!empty($id) && !empty($tablica)){
    $sel = mysql_query("DELETE FROM ".$tablica." WHERE id=".$id.";") or die(mysql_error());
//    echo "DELETE FROM ".$tablica." WHERE id=".$id.";";
    
    $kod = substr($tablica,0,3).$id;
    $sel2 = mysql_query("select id from zamowienie where kod_el = '".$kod."' ;")or die(mysql_error());
    
    while ($row=mysql_fetch_array($sel2))
        {
           $sel = mysql_query("DELETE FROM zamowienie WHERE id=".$row['id'].";") or die(mysql_error());
        } 
        echo "<script> window.location.replace('../magazyn.php') </script>" ;
}