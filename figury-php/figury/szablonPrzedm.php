<!DOCTYPE html>
<?php
require "uwierzyt1.php";
//session_start();
//
//if(empty($_SESSION["zalogowany"]))$_SESSION["zalogowany"]=0;
//
//if($_SESSION["zalogowany"]==0)
//{
//    $logow='
//<table>
//<tr>
//
//<form action="logowanie.php" method="post">
//<td>Login: </td><td><input type="text" name="loogin"></td>
//</tr>
//<tr>
//<td>Hasło: </td><td><input type="password" name="hasloo"></td>
//</tr>
//<tr>
//<td></td><td align="right"><input type="submit" value="wejdź"></td>
//</form>
//</tr>
//</table>';
//}
// else 
//{
//     $logow='<h3>Witaj '. $_SESSION["login"].'</h3></br> <a href="profil.php">edycja profilu</a> </br>
//         <a href="koszyk.php">koszyk</a> </br> <a href="wylogowanie.php">Wyloguj</a>';
//}
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="styl.css"/>
    </head>

    <body>
        <!--<div id="l1">
        <a href="zwierz.php"><img id="lf" src="figury.gif" ></a>
        </div>
        <div id="l2">
        <a href="zwierz.php"><img id="lf" src="figury.gif" ></a>
        </div>
        <div id="l3">
        <a href="zwierz.php"><img id="lf" src="figury.gif" ></a>
        </div>
        <div id="l4">
        <a href="zwierz.php"><img id="lf" src="figury.gif" ></a>
        </div>-->
        <div id="wrapper">

            <div id="banner">
            </div>
            <nav id="navigation">
                <ol>
                    <li><a href="index.php">o nas</a>

                    </li>

                    <li><a href="produkty.php">produkty</a>
                        <ul>
                            <li><a href="donice.php">donice</a></li>
                            <li><a href="fontanny.php">fontanny i naczynia przelewowe</a></li>
                            <li><a href="figury.php">figury</a></li>
                        </ul>
                    </li>

                    <li><a href="zamowienia.php">zamówienia</a></li>

                    <li><a href="kontakt.php">kontakt</a>

                    </li>
                </ol>
            </nav>
            <div id="content_area">
                <?php
                require "uwierzyt1.php";

                while ($rek = mysql_fetch_array($que)) {

                    echo '<table border="1" rules="cols" height="100" width="100%">
	 <tr >
	<td align="center" width="250"><h3> 
	<a href="szablonProdukt.php?nr=' . $rek['NrKat'] . '"><u>' . $rek['NrKat'] . '</u></a>
	</h3></td>
	<td> Cena: ' . $rek['Cena'] . ' zł<br />
	</td>
	</tr>
	<tr >
	<td align="center" width="200" >	
	
	<a href="szablonProdukt.php?nr=' . $rek['NrKat'] . '"><img id="fotaLista" src="' . $rek['Zdjecie1'] . '" height="150" ></a> 
	</td>
	<td>Wysokość: ' . $rek['Wysokosc'] . 'cm<br />Waga: ' . $rek['Waga'] . 'kg<br /><br />
	Dodatkowe informacje: ' . $rek['Dodatkowe'] . '<br />
	</td>
		</tr>
		</table>';
                };
                ?>
            </div>

            <div id="sidebar">
<?php
require "uwierzyt1.php";

$que = mysql_query("SELECT * FROM aktualnosci ORDER BY ida DESC LIMIT 3");

while ($aaa = mysql_fetch_array($que)) {
    echo '<table frame="below">
<tr><td><h4>' . $aaa['tytul'] . '</h4></td></tr>
<tr><td>' . $aaa['tresc'] . '</br></td></tr>
<tr><td><a href="' . $aaa['odnosnik'] . '.php">sam sprawdź</a></td></tr>
</table>';
};
?>
            </div>

<!--            <footer>
                <p>stooooooopka</p>
            </footer>-->
        </div>

    </body>
</html> 