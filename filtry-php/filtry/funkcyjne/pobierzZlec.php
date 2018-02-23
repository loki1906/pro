<?php
require_once '../db.php';
session_start();
$data = $_GET['data'];
$numer = $_GET['numer'];
$tabela = '';
if (!empty($data) && !empty($numer)){
    $sel = mysql_query("select id,numer,kod_el,ilosc_el from zamowienie where DATE_FORMAT(data,'%Y-%m')='".$data."' and (-1='".$numer."' or numer='".$numer."');") or die(mysql_error());
    $res = '<table width="500px"  border="" bgcolor="white"><tr><th>Nr zlecenia</th><th>Element</th><th>Ilość</th></tr>';
    while ($row=mysql_fetch_array($sel))
        {
            {
            if(substr($row['kod_el'],0,3)=='nar'){
                $tabela = 'naroznik';
                $selNar = mysql_query("select typ as nazwa from naroznik where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selNar);
            } elseif(substr($row['kod_el'],0,3)=='mat'){
                $tabela = 'material';
                $selMat = mysql_query("select concat(nazwa,' - ',jednostka) as nazwa from material where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selMat);
            } elseif(substr($row['kod_el'],0,3)=='prn'){
                $tabela = 'profil_nosny';
                $selPrn = mysql_query("select concat(material, ' - ', dlugosc ) as nazwa from profil_nosny where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selPrn);
            } elseif(substr($row['kod_el'],0,3)=='prz'){
                $tabela = 'profil_zamykajacy';
                $selPrz = mysql_query("SELECT concat(COALESCE(material,''), ' - ', COALESCE(dlugosc,''), ' / ', COALESCE(ilosc_kieszeni,'')) as nazwa 
                                        FROM profil_zamykajacy where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selPrz);
            } elseif(substr($row['kod_el'],0,3)=='ram'){
                $tabela = 'ramka';
                $selRam = mysql_query("SELECT concat(rodzaj,' - ',typ,' / ',wymiar) as nazwa FROM ramka where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selRam);
            } elseif(substr($row['kod_el'],0,3)=='inn'){
                $tabela = 'inne';
                $selInn = mysql_query("select nazwa from inne where id=".substr($row['kod_el'],3)."" );
                $row2=mysql_fetch_array($selInn);
            } 
               $res.=  '<tr>'
                       . '<td width=20%>'. $row['numer'].'</td>'
                       . '<td width="50%">'. $row2['nazwa'].'</td>'
                       . '<td width=20%>'. $row['ilosc_el'].' szt. </td>'
                       . '<td><form action="funkcyjne/usunZlec.php" method="POST" >'
                            . '<input type="hidden" name="tablica" value="'.$tabela.'">'
							. '<input type="hidden" name="idZlec" value="'.$row['id'].'">'
                            . '<input type="hidden" name="id" value="'. substr($row['kod_el'],3).'">'
                            . '<input type="hidden" name="ilosc" value="'.$row['ilosc_el'].'">';
                        if($_SESSION['upr'] == 'produkcja'){
                            $res .= '<input id="usunBtn" type="submit" value="Usuń!">';
                        }
                          $res .= '</form></td>'
                       . '</tr>';
            }
        }  
    $res .= '</table>';
    echo $res;
}



