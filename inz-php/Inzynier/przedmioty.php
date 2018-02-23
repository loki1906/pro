<?php

session_start();
$title = 'Przedmioty';

require_once ('./DB/Zapytanie.php');
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if (strlen($login) == 6) {

        //----------------------------- tytuł
        $akcja1 = 'select';
        $tab = "";
        $gdzie1 = '';
        $plik = '';
        $kolumny1 = array("g.nazwa");
        $wartosci = "";
        $warunki = "s.nr_albumu = '" . $_SESSION['login'] . "'";
        $selecty1 = Zapytanie::stworzZapytanie($akcja1, $login, $tab, $kolumny1, $wartosci, $warunki);
        $wyniki1 = Zapytanie::wykonajZapytanie($selecty1);
        $liczbaKolumn1 = Zapytanie::policzKolumny($kolumny1);
        $title = Zapytanie::zwrocWyniki($wyniki1, $liczbaKolumn1, $gdzie1, $plik);
        //----------------------------- tabela
        $gdzie = 'przedmiot.php';
        $akcja = 'select';
        $kolumny = array("p.id", "p.nazwa", "p.skrot");
        $selecty = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki);
        $wyniki = Zapytanie::wykonajZapytanie($selecty);
        $liczbaKolumn = Zapytanie::policzKolumny($kolumny);
        $tabela = Zapytanie::zwrocWyniki($wyniki, $liczbaKolumn, $gdzie, $plik);
        //----------------------------------
        $opis = 'Lista przedmiotów, które masz w tym semestrze.';
        $tabHead = '<th id="td_lewy">Przedmiot</th><th id="td_prawy">Skrót</th>';
        require_once ('szablon_stud.php');
    } elseif (strlen($login) == 11) {


        $tabW = "";
        $plikW = '';
        $wartosciW = "";
        $warunkiW = "w.pesel = '" . $_SESSION['login'] . "'";
        $gdzieW = 'przedmiot.php';
        $akcjaW = 'select';
        $kolumnyW = array("p.id", "p.nazwa");
        $selectyW = Zapytanie::stworzZapytanie($akcjaW, $login, $tabW, $kolumnyW, $wartosciW, $warunkiW);
        $wynikiW = Zapytanie::wykonajZapytanie($selectyW);
        $liczbaKolumnW = Zapytanie::policzKolumny($kolumnyW);
        $tabela = Zapytanie::zwrocWyniki($wynikiW, $liczbaKolumnW, $gdzieW, $plikW);

        $opis = 'Lista przedmiotów i grup ktore prowadzisz w tym semestrze.';
        $tabHead = '<th id="td_sam">Przedmiot</th>';
        require_once ('szablon_wyk.php');
    }
} else {
    header('Location:localhost/Inzynier/index.php');
}

