<?php

require_once '../db.php';

error_reporting(E_ALL);
ini_set('display_errors', true);
$filename = date("d").'.sql';
$file = fopen('22.sql',"a");
echo var_dump($file);
echo var_dump(error_get_last());
$selTab = mysql_query("SHOW TABLES") or die(mysql_error().'11');
$tab = 0;
    while ($rowTab = mysql_fetch_array($selTab)) {
        $listaTab[$tab] = $rowTab['Tables_in_1040903_GmK'];
        $tab++;
    }
    $kol=0;
    foreach ($listaTab as $tablica) {
        unset($listaKol);
        //$selKol = mysql_query("SELECT column_name FROM information_schema.columns WHERE table_name = '". $tablica ."'") or die(mysql_error().'12');
$selKol = mysql_query("show columns from `". $tablica ."` from 1040903_GmK" ) or die(mysql_error().'12');

        $sel = 0;
        while ($rowKol = mysql_fetch_array($selKol)) {
            //$listaKol[$sel] = $rowKol['column_name'];
		$listaKol[$sel] = $rowKol['Field'];
            $sel++;

        }
        
        $select = 'select ';
        $kolumny ='';
        for ($i = 0; $i < count($listaKol); $i++) {
            if($listaKol[$i] == end($listaKol)){
                $kolumny .= $listaKol[$i] ;
            } else {
                $kolumny .= $listaKol[$i].',';
            }
        }

        fwrite($file, "\n" . '---------------------'.$tablica.'---------------------' . "\n");
        $selCreate = mysql_query('SHOW CREATE TABLE '.$tablica) or die(mysql_error().'13');
        while ($rowCreate = mysql_fetch_array($selCreate)) {
            $create = $rowCreate['Create Table'] . "\n \n";
        }
        fwrite($file, $create);
        
        $select .= $kolumny . ' from '.$tablica.' ;';
        $selAll = mysql_query($select) or die(mysql_error().'14');
        while ($rowAll = mysql_fetch_array($selAll)) {
            $inserty = 'insert into '.$tablica .' values (\'';
            for ($i = 0; $i < count($listaKol); $i++) {
                if($listaKol[$i] == end($listaKol)){
                    $inserty .= $rowAll[$listaKol[$i]] ;
                } else {
                    $inserty .= $rowAll[$listaKol[$i]].'\' ,\'';
                }
            }
            $inserty .= '\');'." \n";
            fwrite($file, $inserty);
        }
        
    }
 	
    fclose($file);

    //    header('Content-Description: File Transfer');
    //    header('Content-Type: application/text');
    //    header('Content-Disposition: attachment; filename='.date("d").'.sql');
    //    readfile(date("d").'.sql');
