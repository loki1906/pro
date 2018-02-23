<?php
require_once '../db.php';
session_start();
if (!empty($_POST['login']) && !empty($_POST['haslo'])) {
//    $login = $_POST['login'];
    $login = str_replace(';','aaa',$_POST['login']);
    $login = str_replace('\'','aaa',$login);
    $login = str_replace('"','aaa',$login);
    $pass = $_POST['haslo'] . 'o';
    $haslo = md5($pass);
    $sel = mysql_query("select * from pracownicy where login like '" . $login . "' and pass like '" . $haslo . "';");
    $count = mysql_num_rows($sel);
    if ($count == 1) {
        $selUpr = mysql_query("select upr from pracownicy where login like '" . $login . "' and pass like '" . $haslo . "';");
        while ($rowUpr = mysql_fetch_array($selUpr)) {
            $_SESSION['upr'] = $rowUpr['upr'];
        }
        $_SESSION['login'] = $login;
        
        
        echo "<script> window.location.replace('../rozchod.php') </script>" ;
        return true;
    } elseif ($count == 0) {
        echo "<script> window.location.replace('../index.php?blad=0') </script>" ;
    } else {
        echo "<script> window.location.replace('../index.php?blad=1') </script>" ;
    }
} else {
    echo "<script> window.location.replace('../index.php?blad=2') </script>" ;
}