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
//<tr>
//<td colspan="0" >
//<a href=rejestr.php><b>Zarejestruj się</b></a>
//</td>
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
        <meta name="description" content="Figury ogrodowe jak i donice fontanny do waszych ogrodów w okolicach będzina na terenie śląska" />
        <meta name="keywords" content="Figury ogrodowe, figury dekoracyjne, ozdoby ogrodowe, figury betonowe, donice ogrodowe, fontanny ogrodowe, będzin, śląsk" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <link rel="stylesheet" type="text/css" href="styl.css"/>
    </head>

    <body>
    <script type="text/javascript" src="whcookies.js"></script> 
        <div id="wrapper">
            <div>
                <iframe src="http://www.facebook.com/plugins/like.php?href=https://www.facebook.com/pages/Figury-ogrodowe-z-bia%C5%82ego-betonu/1512669775615801&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe> 
            </div>
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
            <div id="content_area"><?php echo $content; ?>
           
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
                </br>
                <a href="http://www.licznikwejsc.pl"><img src="http://licznikwejsc.pl/count.php?www=http://figury-ogr.pl&style=1&start=100" alt="Darmowy licznik wejść" title="" /></a>

            </div>
            
<!--            <footer>
                <p>stooooooopka</p>
            </footer>-->
            
        </div>

    </body>
</html> 