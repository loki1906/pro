<?php

require_once ('./DB/ConnectDB.php');

class Wykladowca {

    public $imie,
            $nazwisko;

    function __construct() {
        $instancja = ConnectDB::getInstance()->_pdo;
        $que = $instancja->query("select w.imie imie, w.nazwisko nazwisko from wykladowca w  where  w.pesel like '" . $_SESSION['login'] . "';");
        foreach ($que as $value) {
            $this->imie = $value['imie'];
            $this->nazwisko = $value['nazwisko'];
        }
    }

    function stworzDaneSesyjne() {
        $_SESSION['imie'] = $this->imie;
        $_SESSION['nazwisko'] = $this->nazwisko;
    }

}
