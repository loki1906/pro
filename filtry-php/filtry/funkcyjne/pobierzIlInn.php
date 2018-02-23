<?php
require_once '../db.php';
session_start();
$id = $_GET['id'];
if (!empty($id) ){
    $sel = mysql_query("select distinct ilosc from inne where id = ".$id." ;") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo  $row['ilosc'];
        }  
}



