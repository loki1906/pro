<?php

require_once ('./DB/ConnectDB.php');

class User {

    public $login,
            $dataLog;

    function __construct() {
        session_start();
        if (!empty($_POST['login'])) {
            $this->login = $_POST['login'];
        } else {
            $this->login = $_SESSION['login'];
        }
        $this->dataLog = date('d.m.Y H:i');
    }

    function logowanie() {

        $instancja = ConnectDB::getInstance()->_pdo;
        if (isset($instancja)) {
            session_start();
            if (!empty($_POST['login']) && !empty($_POST['haslo'])) {
                $passw = $_POST['haslo'];
                $pass =str_replace("'","",$passw);
                $haslo = sha1(md5($pass));
                $login = str_replace("'","",$this->login);
                $sel = $instancja->query("select * from login where login like BINARY '" . $login . "' and haslo like BINARY '" . $haslo . "';");
                $count = $sel->rowCount();
                if (!empty($count)) {
                    if ($count == 1) {
                        $_SESSION['login'] = $this->login;
                        header('Location:localhost/Inzynier/aktualnosci.php');
                        return true;
                    } else {
                        header('Location:localhost/Inzynier/index.php?blad=1');
                    }
                } else {
                    header('Location:localhost/Inzynier/index.php?blad=1');
                }
            } else {
                header('Location:localhost/Inzynier/index.php?blad=2');
            }
        }
    }

    function dajDateLogowania() {
        $instancja = ConnectDB::getInstance()->_pdo;
        $instancja->query("update login set data_log = STR_TO_DATE('" . $this->dataLog . "','%d.%m.%Y %H:%i') where login like '" . $this->login . "';");
        echo $this->dataLog;
    }

    function wylogowanie() {
        session_start();
        $instancja = ConnectDB::getInstance()->_pdo;
        $instancja->query("update login set data_wylog = STR_TO_DATE('" . $this->dataLog . "','%d.%m.%Y %H:%i') where login like '" . $this->login . "';");
        unset($_SESSION['login']);
        session_destroy();
        header('Location:localhost/Inzynier/index.php');
    }

}
