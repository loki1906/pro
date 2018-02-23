
<?php
require_once '../db.php';
session_start();
//if (!empty($nazwa)){
    $sel = mysql_query("select distinct rodzaj from ramka ;") or die(mysql_error());
    while ($row=mysql_fetch_array($sel))
        {
           echo '<option value="' . $row['rodzaj'] . '" >' . $row['rodzaj'] . '</option>';
        }  
//    echo $material;
//}






