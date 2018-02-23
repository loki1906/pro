
<?php
require_once 'db.php';
//session_start();
$blad = null;
$ilMat = 0;
if (!empty($_GET["blad"])) {
    $blad = $_GET["blad"];
    if ($blad == 1) {
        echo "niepoprawne dane logowania";
    } elseif ($blad == 2) {
        echo "uzupełnij dane logowania";
    } elseif ($blad == 3) {
        echo "prawidłowe wylogowanie";
    }
}

?>
<html>
    <head>
        <title>home</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styl2.css">
    </head>

    <body>
	<div id="prv-billboard" ></div>
   
        <div id="menu">
            <div id="tytul">
                <?php
                echo $tytul;
                ?>
            </div>

        </div>
        <div id="leweMenu">
            <?php
            if (!empty($_SESSION['login'])) {
                if($_SESSION['upr'] == 'produkcja'){

                    echo    '<div id="elMen" onclick="window.location.href = \'rozchod.php\'">  
                                <p id="tytMenu" ><br/>&emsp;Rozchód</p>
                            </div><div id="elMen" onclick="window.location.href = \'nowyElement.php\'"> 
                                <p id="tytMenu" ><br/>Nowy element</p> </div>';

                }
                        
            echo    '<div id="elMen" onclick="window.location.href = \'dostawa.php\'">    
                        <p id="tytMenu" ><br/>&emsp;Dostawa</p>
		    </div><div id="elMen" onclick="window.location.href = \'magazyn.php\'"> 
                        <p id="tytMenu" ><br/>&emsp;Magazyn</p>
                    </div><div id="elMen" onclick="window.location.href = \'zlecenia.php\'">    
                        <p id="tytMenu" ><br/>&emsp;Zlecenia</p>
                    </div>  ';
            }
                ?>
            <div> 
                <?php
                    if (!empty($_SESSION['login'])) {
                        if($_SESSION['upr'] == 'produkcja'){
                            echo '<a href="back/backup.php"><img id="butt" src="back-butt.png" alt="odswiez"  /></a>';
                        }
                        echo '<a href="funkcyjne/wyloguj.php"><img id="butt" src="butt.png" alt="wylogowanie" /></a>
                        <a href=""><img id="butt" src="butt-odswiez.png" alt="odswiez"  /></a>';
                    }
                    ?>
            </div>
            <?php
                    if (!empty($_SESSION['login'])) {
                        echo    '<div id="alert">     
                                <img id="pinezka" src="pinezka1.png" />';
                    } else {
                        echo '<div>';
                    }
            ?>

                <table width="100%">
                    <?php
                    if (!empty($_SESSION['login'])) {
                            $alert = '<tr><td colspan="2" align="center"><font color="#008000">INNE</font></td></tr>';
                        $sInn = mysql_query("select nazwa from inne where ilosc<=margines ");
                        while ($row = mysql_fetch_array($sInn)) {
                            $alert .= '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }
                        $alert .= '<tr><td colspan="2" align="center"><font color="#008000">NAROŻNIKI</font></td></tr>';
                        $sNa = mysql_query("select typ as nazwa from naroznik where ilosc<=margines");
                        while ($row = mysql_fetch_array($sNa)) {
                            $alert .=  '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }    
                        $alert .= '<tr><td colspan="2" align="center"><font color="#008000">MATERIAŁ</font></td></tr>';
                        $sMa = mysql_query("select concat(nazwa,' - ',jednostka) as nazwa from material where ilosc<=margines");
                        while ($row = mysql_fetch_array($sMa)) {
                            $alert .=  '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }    
                        $alert .= '<tr><td colspan="2" align="center"><font color="#008000">PROFILE NOŚNE</font></td></tr>';
                        $sPN = mysql_query("select concat(material, ' - ', dlugosc ) as nazwa from profil_nosny where ilosc<=margines");
                        while ($row = mysql_fetch_array($sPN)) {
                            $alert .=  '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }   
                        $alert .= '<tr><td colspan="2" align="center"><font color="#008000">PROFILE ZAMYKAJACE</font></td></tr>';
                        $sPZ = mysql_query("SELECT concat(COALESCE(material,''), ' - ', COALESCE(dlugosc,''), ' / ', COALESCE(ilosc_kieszeni,'')) as nazwa 
                            FROM profil_zamykajacy where ilosc<=margines");
                        while ($row = mysql_fetch_array($sPZ)) {
                            $alert .=  '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }    
                        $alert .= '<tr><td colspan="2" align="center"><font color="#008000">RAMKI</font></td></tr>';
                        $sRa = mysql_query("SELECT concat(rodzaj,' - ',typ,' / ',wymiar) as nazwa FROM ramka where ilosc<=margines");
                        while ($row = mysql_fetch_array($sRa)) {
                            $alert .=  '<tr>'
                            . '<td>' . $row['nazwa'] . '</td>'
                            . '<td width="10%"><img id="alertW" src="alert.png"/></td>'
                            . '</tr>';
                        }
                        echo $alert;
                    }
                    ?>
                    
                </table>
            </div>
        </div>
        <div id="central">

            <div id = "view">
                
                <?php
                echo $text;
                ?>
            </div>

        </div>

    </body>
</html>
