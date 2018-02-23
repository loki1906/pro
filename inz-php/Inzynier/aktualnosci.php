<?php
session_start();
$title = 'Aktualności';

require_once ('./DB/Zapytanie.php');
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if (strlen($login) == 6) {

        require_once ('./Users/Student.php');
        $student = new Student();
        $student->stworzDaneSesyjne();
        $opis = 'Znajdują sie tu oceny, które zostały dodane dzisiaj lub po Twoim ostatnim wylogowaniu.';
        $tabHead = '<th id="td_lewy">Przedmiot</th><th>Składowa</th><th id="td_prawy">Ocena</th>';
//        -------------------- select aktualnosci ST
        $gdzie = '';
        $plik = '';
        $akcja = 'select';
        $tab = "";
        $kolumny = array("p.nazwa", "sk.tytul", "o.ocena");
        $wartosci = "";
        $warunki = "s.nr_albumu = '" . $_SESSION['login'] . "' and o.data >= l.data_wylog and o.ocena is not null";
        $selecty = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki);
        $wyniki = Zapytanie::wykonajZapytanie($selecty);
        $liczbaKolumn = Zapytanie::policzKolumny($kolumny);
        $tabela = Zapytanie::zwrocWyniki($wyniki, $liczbaKolumn, $gdzie, $plik);

        require_once ('szablon_stud.php');
    } elseif (strlen($login) == 11) {

        require_once ('./Users/Wykladowca.php');
        $wykladowca = new Wykladowca();
        $wykladowca->stworzDaneSesyjne();
        $gdzieW = '';
        $plikW = '';
        $akcjaW = 'select';
        $tabW = "";
        $kolumnyW = array("p.nazwa", "sk.tytul", "s.imie", "s.nazwisko", "o.link");
        $wartosciW = "";
        $warunkiW = "w.pesel = '" . $_SESSION['login'] . "' and o.data_dodania >= l.data_wylog ";
        $selectyW = Zapytanie::stworzZapytanie($akcjaW, $login, $tabW, $kolumnyW, $wartosciW, $warunkiW);
        $wynikiW = Zapytanie::wykonajZapytanie($selectyW);
        $liczbaKolumnW = Zapytanie::policzKolumny($kolumnyW);
        $tabela = Zapytanie::zwrocWyniki($wynikiW, $liczbaKolumnW, $gdzieW, $plikW);
        $opis = 'Znajdują sie tu składowe, w których zachodziły zmiany dzisiaj lub od Twojego ostatniego logowania.';
        $tabHead = '<th id="td_lewy">Przedmiot</th><th>Składowa</th><th>Imie</th><th>Nazwisko</th><th id="td_prawy">Nazwa pliku</th>';
        require_once ('szablon_wyk.php');
    }
} else {
    header('Location:localhost/Inzynier/index.php');
}


