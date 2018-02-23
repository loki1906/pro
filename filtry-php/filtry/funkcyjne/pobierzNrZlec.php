<?php
require_once '../db.php';
session_start();
$data = $_GET['data'];
if (!empty($data)){
    $sel = mysql_query("select distinct numer from zamowienie where DATE_FORMAT(data,'%Y-%m')='".$data."';") or die(mysql_error());
    $i = 0;
    while ($row=mysql_fetch_array($sel))
        {
            if($i == 0){
                echo  '<option value="-1">wszystkie</option><option value="' . $row['numer'] . '">' . $row['numer'] . '</option>';
            }else{
               echo  '<option value="' . $row['numer'] . '">' . $row['numer'] . '</option>';
            }
            $i++;
        }  
}



