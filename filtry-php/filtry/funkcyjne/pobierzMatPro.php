<?php
require_once '../db.php';
session_start();
$nazwa = $_GET['nazwa'];
$material=null;
if (!empty($nazwa)){
    $sel = mysql_query("select distinct material from profil where typ = '".$nazwa."';") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo '<option value="' . $row['material'] . '" >' . $row['material'] . '</option>';
        }  
//    echo $material;
}