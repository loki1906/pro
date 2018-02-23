<?php
require_once '../db.php';
session_start();
$id = $_GET['id'];
if (!empty($id)){
    $sel = mysql_query("select ilosc from profil_zamykajacy where id = ".$id." ;") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo $row['ilosc'];
        }  

}



