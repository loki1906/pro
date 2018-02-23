<?php

require_once ('./DB/ConnectDB.php');

class Student {

    public $id,
            $album,
            $imie,
            $nazwisko,
            $grupa,
            $rodzaj;

    function __construct() {
        $instancja = ConnectDB::getInstance()->_pdo;
        $que = $instancja->query("select s.id id, s.nr_albumu album, s.imie imie, s.nazwisko nazwisko, g.nazwa grupa, g.rodzaj rodzaj from student s, grupa g "
                . "where s.id_grupa=g.id and s.nr_albumu like '" . $_SESSION['login'] . "';");
        foreach ($que as $value) {
            $this->id = $value['id'];
            $this->album = $value['album'];
            $this->imie = $value['imie'];
            $this->nazwisko = $value['nazwisko'];
            $this->grupa = $value['grupa'];
            $this->rodzaj = $value['rodzaj'];
        }
    }

    function stworzDaneSesyjne() {
        $_SESSION['idStud'] = $this->id;
        $_SESSION['album'] = $this->album;
        $_SESSION['imie'] = $this->imie;
        $_SESSION['nazwisko'] = $this->nazwisko;
        $_SESSION['grupa'] = $this->grupa;
        $_SESSION['rodzaj'] = $this->rodzaj;
    }

}
