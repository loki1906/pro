<?php

session_start();
require_once ('./DB/Zapytanie.php');
if (!empty($_GET['id'])) {
    $_SESSION['idPrzedm'] = $_GET['id'];
    $idPrzedm = $_SESSION['idPrzedm'];
}
$idPrzedm = $_SESSION['idPrzedm'];
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if (strlen($login) == 6) {


//----------------------------- tytuł
        $akcja1 = 'select';
        $tab = "";
        $gdzie1 = '';
        $plik = '';
        $kolumny1 = array("p.nazwa");
        $wartosci = "";
        $warunki = "s.nr_albumu = '" . $_SESSION['login'] . "' and p.id=" . $idPrzedm . " ";
        $selecty1 = Zapytanie::stworzZapytanie($akcja1, $login, $tab, $kolumny1, $wartosci, $warunki);
        $wyniki1 = Zapytanie::wykonajZapytanie($selecty1);
        $liczbaKolumn1 = Zapytanie::policzKolumny($kolumny1);
        $title = Zapytanie::zwrocWyniki($wyniki1, $liczbaKolumn1, $gdzie1, $plik);
//----------------------------- tabela
        $gdzie = 'skladowa.php';
        $akcja = 'select';
        $kolumny = array("sk.id", "sk.tytul", "sk.rodzaj", "o.ocena");
        $selecty = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki);
        $wyniki = Zapytanie::wykonajZapytanie($selecty);
        $liczbaKolumn = Zapytanie::policzKolumny($kolumny);
        $tabela = Zapytanie::zwrocWyniki($wyniki, $liczbaKolumn, $gdzie, $plik);
//-----------------------------------------------------------------------
//        $where = "s.nr_albumu = '".$_SESSION['login']."' and p.id=".$id." ";
//        $kol = array("sk.id","sk.tytul","sk.rodzaj");
//        $dokad = 'skladowa.php';
//        $tab = DB::stworzSelectStudent($kol, $where, $dokad);
        $opis = 'Składowe przedmiotu do zaliczenia.';
        $tabHead = '<th id="td_lewy">Składowa</th><th>Rodzaj</th><th id="td_prawy">Ocena</th>';
        require_once ('szablon_stud.php');
    } elseif (strlen($login) == 11) {



        if (!empty($_POST['tytul']) && !empty($_POST['komentarz']) && !empty($_POST['rodzaj'])) {
            if (!empty($_FILES)) {

                $plik_tmp = $_FILES['plik']['tmp_name'];
                $plik_nazwa = $_FILES['plik']['name'];
                $plik_rozmiar = $_FILES['plik']['size'];

                $b = strchr($plik_nazwa, ".");
                if ($b == '.pdf') {
                    if (is_uploaded_file($plik_tmp)) {
                        move_uploaded_file($plik_tmp, "pliki/wykladowca/$plik_nazwa");
                    }
                }
            } elseif (empty($_FILES)) {
                $plik_nazwa = '';
            }
            require_once './DB/Zapytanie.php';
            $akcjaI = 'insert';
            $tabI = 'skladowa';
            $kolumnyI = array('tytul', 'komentarz', 'rodzaj', 'link', 'data', 'id_przedmiot');
            $aktDataI = date('d.m.Y H:i');
            $wartosciI = array("'" . $_POST['tytul'] . "'", "'" . $_POST['komentarz'] . "'", "'" . $_POST['rodzaj'] . "'", "'" . $plik_nazwa . "'", "STR_TO_DATE( '" . $aktDataI . "', '%d.%m.%Y' )", $idPrzedm);
            $warunkiI = '';
            $selectyI = Zapytanie::stworzZapytanie($akcjaI, $login, $tabI, $kolumnyI, $wartosciI, $warunkiI);
            $wynikiI = Zapytanie::wykonajZapytanie($selectyI);
            header('Location:localhost/Inzynier/przedmiot.php');
        }

        $akcja1W = 'select';
        $tabW = "";
        $gdzie1W = '';
        $plikW = '';
        $kolumny1W = array("p.nazwa");
        $wartosciW = "";
        $warunkiW = "w.pesel = '" . $_SESSION['login'] . "' and p.id=" . $idPrzedm . " ";
        $selecty1W = Zapytanie::stworzZapytanie($akcja1W, $login, $tabW, $kolumny1W, $wartosciW, $warunkiW);
        $wyniki1W = Zapytanie::wykonajZapytanie($selecty1W);
        $liczbaKolumn1W = Zapytanie::policzKolumny($kolumny1W);
        $title = Zapytanie::zwrocWyniki($wyniki1W, $liczbaKolumn1W, $gdzie1W, $plikW);
//----------------------------- tabela
        $gdzieW = 'skladowa.php';
        $akcjaW = 'select';
        $kolumnyW = array("sk.id", "sk.tytul", "sk.rodzaj");
        $selectyW = Zapytanie::stworzZapytanie($akcjaW, $login, $tabW, $kolumnyW, $wartosciW, $warunkiW);
        $wynikiW = Zapytanie::wykonajZapytanie($selectyW);
        $liczbaKolumnW = Zapytanie::policzKolumny($kolumnyW);
        $tabela = Zapytanie::zwrocWyniki($wynikiW, $liczbaKolumnW, $gdzieW, $plikW);
//---------------------------- dodawanie skladowych

        $tabela2 = ' <table id="wys_tab"><tr id="th_inf" ><th id="td_lewy">Tytul</th><th>Komentarz</th><th>Rodzaj</th><th id="td_prawy">Plik (pdf)</th></tr>
            <form action="przedmiot.php" method="post" enctype="multipart/form-data">
            <td align = "center">
                <input type="text" name="tytul"></td>
            <td align = "center">
                <textarea name="komentarz" style="resize: none;" rows="5" cols="40"></textarea></td>
            <td align = "center">
                <select name="rodzaj">
                <option value="laboratorium">Laboratorium</option>
                <option value="kolokwium">Kolokwium</option>
                <option value="egzamin">Egzamin</option>
                <option value="seminarium">Seminarium</option>
                <option value="prezentacja">Prezentacja</option>
                </select>
            </td>
            <td align = "center">
                <input type="file" name="plik" >
            <td align="center">
                <input id="butt" type="submit" value="Zapisz"></td>
                </tr></table>';
        $opis = 'Składowe przedmiotu do zaliczenia.';
        $tabHead = '<th id="td_lewy">Składowa</th><th id="td_prawy">Rodzaj</th>';
        require_once ('szablon_wyk.php');
    }
} else {
    header('Location:localhost/Inzynier/index.php');
}
