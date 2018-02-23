<?php

session_start();
$title = 'Zaległości';

require_once ('./DB/Zapytanie.php');
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if (strlen($login) == 6) {

        $opis = 'Znajdują sie tu składowe przedmiotów w których masz braki';
        $tabHead = '<th id="td_lewy">Przedmiot</th><th>Składowa</th><th>Linki</th><th id="td_prawy">Oceny</th>';
        $gdzie = '';
        $plik = '';
        $akcja = 'select';
        $tab = "";
        $kolumny = array("p.nazwa", "sk.tytul", "case when o.link is null then 'brak' else o.link end linki",
            "case when o.ocena is null then 'brak' when o.ocena = 2 then 'do poprawy' else o.ocena end oceny");
        $wartosci = "";
        $warunki = "s.nr_albumu = '" . $_SESSION['login'] . "' and l.data_log> sk.data and (o.link is null or o.ocena is null or o.ocena = 2)";
        $selecty = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki);
        $wyniki = Zapytanie::wykonajZapytanie($selecty);
        $liczbaKolumn = Zapytanie::policzKolumny($kolumny);
        $tabela = Zapytanie::zwrocWyniki($wyniki, $liczbaKolumn, $gdzie, $plik);
        require_once ('szablon_stud.php');
    } else {
        header('Location:localhost/Inzynier/index.php');
    }
}