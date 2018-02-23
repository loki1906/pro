<?php

session_start();

require_once ('./DB/Zapytanie.php');
//------------------------------------------- download file 
if (!empty($_POST['file'])) {
    $file = $_POST['file'];
    header('Content-Description: File Transfer');
//    header('Content-Type: application/pdf');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $file . '"');
    readfile('pliki/wykladowca/' . $file);
    exit();
}

if (!empty($_GET['info'])) {
    $info = "Plik: <strong>" . $_GET['info'] . "</strong> przesłany na serwer!";
}

if (!empty($_GET['id'])) {
    $_SESSION['idSklad'] = $_GET['id'];
}

$idSklad = $_SESSION['idSklad'];

if(!empty($_GET['usun'])){
    $usun = $_GET['usun'];
    if($usun == 'tak'){
        $akcjaUD = 'update';
        $tabUD = 'ocena';
        $kolumnyUD = array('link', 'data_dodania');
        $aktDataUD = '';
        $wartosciUD = array("null", "null");
        $warunkiUD = "id_student = " . $_SESSION['idStud'] . " and id_skladowa = " . $idSklad . "";
        $selectyUD = Zapytanie::stworzZapytanie($akcjaUD, $login, $tabUD, $kolumnyUD, $wartosciUD, $warunkiUD);
        $wyniki = Zapytanie::wykonajZapytanie($selectyUD);
        header('Location:localhost/Inzynier/skladowa.php');
    }
}

if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if (strlen($login) == 6) {
        //----------------------------- tytuł
        $akcja = 'select';
        $tab = "";
        $gdzie = '';
        $plik = '';
        $kolumny1 = array("sk.tytul");
        $wartosci = "";
        $warunki = "s.nr_albumu = '" . $_SESSION['login'] . "' and sk.id=" . $idSklad . " ";
        $selecty1 = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny1, $wartosci, $warunki);
        $wyniki1 = Zapytanie::wykonajZapytanie($selecty1);
        $liczbaKolumn1 = Zapytanie::policzKolumny($kolumny1);
        $title = Zapytanie::zwrocWyniki($wyniki1, $liczbaKolumn1, $gdzie, $plik);
        //-----------------------------opis
        $kolumny2 = array("sk.komentarz");
        $selecty2 = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny2, $wartosci, $warunki);
        $wyniki2 = Zapytanie::wykonajZapytanie($selecty2);
        $liczbaKolumn2 = Zapytanie::policzKolumny($kolumny2);
        $opis = Zapytanie::zwrocWyniki($wyniki2, $liczbaKolumn2, $gdzie, $plik);
        //----------------------------- tabela
        $kolumny = array("o.ocena", "sk.link");
        $plik1 = 'down';
        $gdzie1 = 'skladowa.php';
        $selecty = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki);
        $wyniki = Zapytanie::wykonajZapytanie($selecty);
        $liczbaKolumn = Zapytanie::policzKolumny($kolumny);
        $tabela = Zapytanie::zwrocWyniki($wyniki, $liczbaKolumn, $gdzie1, $plik1);
        //----------------------------- jaki rodzaj
        $kolumny3 = array("sk.rodzaj");
        $selecty3 = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny3, $wartosci, $warunki);
        $wyniki3 = Zapytanie::wykonajZapytanie($selecty3);
        $liczbaKolumn3 = Zapytanie::policzKolumny($kolumny3);
        $rodzaj = Zapytanie::zwrocWyniki($wyniki3, $liczbaKolumn3, $gdzie, $plik);
        if ($rodzaj == 'laboratorium' || $rodzaj == 'seminarium' || $rodzaj == 'prezentacja') {
            //-----------------------czy juz jest plik
            $kolumnyP = array("o.link");
            $selectyP = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumnyP, $wartosci, $warunki);
            $wynikiP = Zapytanie::wykonajZapytanie($selectyP);
            $liczbaKolumnP = Zapytanie::policzKolumny($kolumnyP);
            $rodzajD = Zapytanie::zwrocWyniki($wynikiP, $liczbaKolumnP, $gdzie, $plik);
            if (empty($rodzajD)) {
                $tabela2 = '<table id="wys_tab"><tr id="th_inf" ><th id="td_lewy">Plik studenta</th><th id="td_prawy">Plik od wysłania</th></tr>';
                $kolumny4 = array("o.link");
                $plik4 = 'up';
                $gdzie4 = 'skladowa.php';
                $selecty4 = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny4, $wartosci, $warunki);
                $wyniki4 = Zapytanie::wykonajZapytanie($selecty4);
                $liczbaKolumn4 = Zapytanie::policzKolumny($kolumny4);
                $tabela2 .= Zapytanie::zwrocWyniki($wyniki4, $liczbaKolumn4, $gdzie4, $plik4);
                $tabela2 .= '</table><p> plik powinien zawierac: Imie, Nazwisko, Grupe, Skrót Przedmiotu, Tytuł Lab. <br> powinien również być w formacie .pdf np: Kamil_Czarnecki_IP40_PBD_Optymalizacja.pdf </p>';
            } else {
                $tabela2 = '<table id="wys_tab"><tr id="th_inf" ><th id="td_lewy">Plik studenta</th><th id="td_prawy">Akcja </th></tr>';
                $kolumny5 = array("o.link");
                $plik5 = 'del';
                $gdzie5 = 'skladowa.php';
                $selecty5 = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumny5, $wartosci, $warunki);
                $wyniki5 = Zapytanie::wykonajZapytanie($selecty5);
                $liczbaKolumn5 = Zapytanie::policzKolumny($kolumny5);
                $tabela2 .= Zapytanie::zwrocWyniki($wyniki5, $liczbaKolumn5, $gdzie5, $plik5);
//                $tabela2 .= '</table><p> plik powinien zawierac: Imie, Nazwisko, Grupe, Skrót Przedmiotu, Tytuł Lab. <br> powinien również być w formacie .pdf np: Kamil_Czarnecki_IP40_PBD_Optymalizacja.pdf </p>';
            }
        }


        //--------------------------------------- upload pliku
        if (!empty($_FILES)) {
            $plik_tmp = $_FILES['plik']['tmp_name'];
            $plik_nazwa = $_FILES['plik']['name'];
            $plik_rozmiar = $_FILES['plik']['size'];
            $b = strchr($plik_nazwa, ".");
            if ($b == '.pdf') {
                if (is_uploaded_file($plik_tmp)) {
                    move_uploaded_file($plik_tmp, "pliki/student/$plik_nazwa");
                    //--------------------select czy isnieje rekord
                    $kolumnyS = array("o.id");
                    $warunkiS = "id_student = " . $_SESSION['idStud'] . " and id_skladowa = " . $idSklad . "";
                    $selectyS = Zapytanie::stworzZapytanie($akcja, $login, $tab, $kolumnyS, $wartosci, $warunki);
                    $wynikiS = Zapytanie::wykonajZapytanie($selectyS);
                    $liczbaKolumnS = Zapytanie::policzKolumny($kolumnyS);
                    $sprawdz = Zapytanie::zwrocWyniki($wynikiS, $liczbaKolumnS, $gdzie, $plik);

                    if (!empty($sprawdz)) {
                        //------------------- jesli tak to update
                        $akcjaU = 'update';
                        $tabU = 'ocena';
                        $kolumnyU = array('link', 'data_dodania');
                        $aktDataU = date('d.m.Y H:i');
                        $wartosciU = array("'" . $plik_nazwa . "'", "STR_TO_DATE( '" . $aktDataU . "',  '%d.%m.%Y' )");
                        $warunkiU = "id_student = " . $_SESSION['idStud'] . " and id_skladowa = " . $idSklad . "";
                        $selectyU = Zapytanie::stworzZapytanie($akcjaU, $login, $tabU, $kolumnyU, $wartosciU, $warunkiU);
                        $wyniki = Zapytanie::wykonajZapytanie($selectyU);
                        header('Location:localhost/Inzynier/skladowa.php?info=' . $plik_nazwa . '');
                    } else {
                        //------------------- jak nie to insert
                        $akcjaI = 'insert';
                        $tabI = 'ocena';
                        $kolumnyI = array('link', 'data_dodania', 'id_student', 'id_skladowa');
                        $aktDataI = date('d.m.Y H:i');
                        $wartosciI = array("'" . $plik_nazwa . "'", "STR_TO_DATE( '" . $aktDataI . "',  '%d.%m.%Y' )", $_SESSION['idStud'], $idSklad);
                        $warunkiI = '';
                        $selectyI = Zapytanie::stworzZapytanie($akcjaI, $login, $tabI, $kolumnyI, $wartosciI, $warunkiI);
                        $wynikiI = Zapytanie::wykonajZapytanie($selectyI);
                        header('Location:localhost/Inzynier/skladowa.php?info=' . $plik_nazwa . '');
                    }
                }
            }
        }

        $tabHead = '<th id="td_lewy">Ocena</th><th id="td_prawy">Plik od wykładowcy</th>';
        require_once ('szablon_stud.php');
    } elseif (strlen($login) == 11) {
        //------------------------------------- tytuł
        $akcjaW = 'select';
        $tabW = "";
        $gdzie1W = '';
        $plik1W = '';
        $kolumny1W = array("sk.tytul");
        $wartosciW = "";
        $warunki1W = " pesel = '" . $_SESSION['login'] . "' and sk.id=" . $idSklad . " ";
        $selecty1W = Zapytanie::stworzZapytanie($akcjaW, $login, $tabW, $kolumny1W, $wartosciW, $warunki1W);
        $wyniki1W = Zapytanie::wykonajZapytanie($selecty1W);
        $liczbaKolumn1W = Zapytanie::policzKolumny($kolumny1W);
        $title = Zapytanie::zwrocWyniki($wyniki1W, $liczbaKolumn1W, $gdzie1W, $plik1W);
        //------------------------------------ tabela
        $gdzieW = 'skladowa.php';
        $plikW = 'update';
        $warunkiW = " sk.id=" . $idSklad . " ";
        $kolumnyW = array("s.imie", "s.nazwisko", "g.nazwa", "o.link", "o.data_dodania", "o.ocena", "s.id");
        $selectyW = Zapytanie::stworzZapytanie($akcjaW, $login, $tabW, $kolumnyW, $wartosciW, $warunkiW);
        $wynikiW = Zapytanie::wykonajZapytanie($selectyW);
        $liczbaKolumnW = Zapytanie::policzKolumny($kolumnyW);
        $tabela = Zapytanie::zwrocWyniki($wynikiW, $liczbaKolumnW, $gdzieW, $plikW);

        if (!empty($_POST['idStud']) && !empty($_POST['ocena'])) {
            $akcjaO = 'select';
            $tabO = "";
            $gdzieO = '';
            $wartosciO = '';
            $plikO = '';
            $kolumnyO = array("o.id");
            $warunkiO = "id_student = " . $_POST['idStud'] . " and id_skladowa = " . $idSklad . "";
            $selectyO = Zapytanie::stworzZapytanie($akcjaO, $login, $tab, $kolumnyO, $wartosciO, $warunkiO);
            $wynikiO = Zapytanie::wykonajZapytanie($selectyO);
            $liczbaKolumnO = Zapytanie::policzKolumny($kolumnyO);
            $sprawdz = Zapytanie::zwrocWyniki($wynikiO, $liczbaKolumnO, $gdzieO, $plikO);

            if (!empty($sprawdz)) {
                //------------------- jesli tak to update
                $akcjaUO = 'update';
                $tabUO = 'ocena';
                $kolumnyUO = array('ocena', 'data');
                $aktDataUO = date('d.m.Y H:i');
                $wartosciUO = array("'" . $_POST['ocena'] . "'", "STR_TO_DATE( '" . $aktDataUO . "',  '%d.%m.%Y' )");
                $warunkiUO = "id_student = " . $_POST['idStud'] . " and id_skladowa = " . $idSklad . "";
                $selectyUO = Zapytanie::stworzZapytanie($akcjaUO, $login, $tabUO, $kolumnyUO, $wartosciUO, $warunkiUO);
                $wyniki = Zapytanie::wykonajZapytanie($selectyUO);
                header('Location:localhost/Inzynier/skladowa.php');
            } else {
                //------------------- jak nie to insert
                $akcjaIO = 'insert';
                $tabIO = 'ocena';
                $kolumnyIO = array('ocena', 'data', 'id_student', 'id_skladowa');
                $aktDataIO = date('d.m.Y H:i');
                $wartosciIO = array("'" . $_POST['ocena'] . "'", "STR_TO_DATE( '" . $aktDataIO . "',  '%d.%m.%Y' )", $_POST['idStud'], $idSklad);
                $warunkiIO = '';
                $selectyIO = Zapytanie::stworzZapytanie($akcjaIO, $login, $tabIO, $kolumnyIO, $wartosciIO, $warunkiIO);
                $wynikiIO = Zapytanie::wykonajZapytanie($selectyIO);
                header('Location:localhost/Inzynier/skladowa.php');
            }
        }

        $opis = 'Lista studentów dla składowej.';
        $tabHead = '<th id="td_lewy">Imie</th><th>Nazwisko</th><th>Grupa</th><th>Plik</th><th>Data dodania</th><th id="td_prawy">Ocena</th>';
        require_once ('szablon_wyk.php');
    }
} else {
    header('Location:localhost/Inzynier/index.php');
}
