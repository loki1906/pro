<?php 
session_start();

require_once 'db.php';
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
} else {
    echo "<script> window.location.replace('index.php') </script>" ;
}
$narozniki = '';
$materialy = '';
$ramki = '';
$profileNosne = '';
$profileZamykajace = '';
$inne = '';
$tytul = 'Magazyn';


    $sel = mysql_query("select id,typ, ilosc from naroznik;") or die(mysql_error());
while ($row=mysql_fetch_array($sel))
        {
           $narozniki .= '<tr>'
                   . '<td>'. $row['typ'].'</td>'
                   . '<td>'. $row['ilosc'].' szt. </td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="naroznik">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $narozniki .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $narozniki .= '</form></td></tr>';
        }  


    $sel2 = mysql_query("select id, nazwa, ilosc, jednostka from material;") or die(mysql_error());
while ($row=mysql_fetch_array($sel2))
        {
            $jednostka = ($row['jednostka']=='mk')? 'metr <sup>2</sup>' : 'metr b.';
            $materialy .= '<tr>'
                    . '<td>'. $row['nazwa'].'</td>'
                    . '<td>'. $row['ilosc'].' '. $jednostka.'</td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="material">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $materialy .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $materialy .= '</form></td></tr>';
        }  

        
    $sel3 = mysql_query("select id,rodzaj, typ, wymiar, ilosc from ramka;") or die(mysql_error());
while ($row=mysql_fetch_array($sel3))
        {
           $ramki .= '<tr>'
                   . '<td>'. $row['rodzaj'].' - '. $row['typ'].' / '. $row['wymiar'].'</td>'
                   . '<td>'. $row['ilosc'].' szt. </td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="ramka">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $ramki .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $ramki .= '</form></td></tr>';
        }  

        
    $sel4 = mysql_query("select id,material, dlugosc, ilosc from profil_nosny;") or die(mysql_error());
while ($row=mysql_fetch_array($sel4))
        {
           $profileNosne .= '<tr>'
                   . '<td>'. $row['material'].' - '. $row['dlugosc'].'</td>'
                   . '<td>'. $row['ilosc'].' szt. </td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="profil_nosny">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $profileNosne .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $profileNosne .= '</form></td></tr>';
        }  

        
    $sel5 = mysql_query("select id,material, dlugosc, ilosc_kieszeni, ilosc from profil_zamykajacy;") or die(mysql_error());
while ($row=mysql_fetch_array($sel5))
        {
           $profileZamykajace .= '<tr>'
                   . '<td>'. $row['material'].' - '. $row['dlugosc'].' / '.$row['ilosc_kieszeni'].'</td>'
                   . '<td>'. $row['ilosc'].' szt. </td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="profil_zamykajacy">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $profileZamykajace .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $profileZamykajace .= '</form></td></tr>';
        }  
        
    $sel6 = mysql_query("select id,nazwa, ilosc from inne;") or die(mysql_error());
while ($row=mysql_fetch_array($sel6))
        {
           $inne .= '<tr>'
                   . '<td>'. $row['nazwa'].'</td>'
                   . '<td>'. $row['ilosc'].' szt. </td>'
                    . '<td><form action="funkcyjne/usunZMagazynu.php" method="POST" >'
                    . '<input type="hidden" name="tablica" value="inne">'
                    . '<input type="hidden" name="id" value="'. $row['id'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $inne .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                    $inne .=  '</form></td></tr>';
        }  
        
        $text = '<table id="magazynTab" border="1">
                    <tr><th colspan="3">
                        <h2>Narożniki: </h2>
                    </th></tr>'.
                        $narozniki
                        .'
                    <tr><th colspan="3">
                        <h2>Matriały: </h2>
                    </th></tr>'.
                         $materialy
                        .'
                    <tr><th colspan="3">
                        <h2>Ramki: </h2>
                    </th></tr>'.
                        $ramki
                        .'
                    <tr><th colspan="3">
                        <h2>Profile nośne: </h2>
                    </th></tr>'.
                        $profileNosne
                        .'
                    <tr><th colspan="3">
                        <h2>Profile zamykające: </h2>
                    </th></tr>'.
                        $profileZamykajace
                        .'
                    <tr><th colspan="3">
                        <h2>Inne: </h2>
                    </th></tr>'.
                        $inne
                        .'
                </table>';
include_once 'szablon.php';