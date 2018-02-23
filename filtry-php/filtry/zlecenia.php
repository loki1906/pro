<?php 
session_start();

require_once 'db.php';
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
} else {
    echo "<script> window.location.replace('index.php') </script>" ;
}

$data = '';
$selData = mysql_query("select DISTINCT  DATE_FORMAT(data,'%Y-%m') as okres from zamowienie order by okres;") or die(mysql_error());
    while ($row = mysql_fetch_array($selData)) {
        $data .= '<option value="' . $row['okres'] . '">' . $row['okres'] . '</option>';
    }

$tytul = 'Zlecenia';
$text = '<table>'
        . '<tr>'
            . '<td width="200px" height="30px">'
            . ' Wybierz miesiąc:</td><td width="100px" height="50px"><select id="data" name="data" onchange="loadNrZlec(this.value)" onFocus="loadNrZlec(this.value)">'.$data.'</select><br>'
            . '</td>'
        . '</tr><tr>'
            . '<td width="200px" height="30px">'
            . ' Wybierz nr zamówienia:</td><td width="100px" height="50px"><select id="nrZam" name="zamowienie" onchange="loadZlec(this.value)" onFocus="loadZlec(this.value)"></select>'
            . '</td>'
        . '</tr>'
        . '<tr><span id="nazwa"></span><td></td><td><span id="ilosc"></span></td></tr>'
        . '</table>'
        . '<div id="naTab"></div>'
        . '<script>
                function loadNrZlec(str) {
                    var xhttp;
                    if (str == "") {
                        document.getElementById("nrZam").value = "aa";
                        return;
                    }
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            document.getElementById("nrZam").innerHTML = xhttp.responseText;
                        }
                    }
                    xhttp.open("GET", "funkcyjne/pobierzNrZlec.php?data=" + str, true);
                    xhttp.send();
                }
            </script>
            <script>
                function loadZlec(str) {
                    var xhttp;
                    if (str == "") {
                        
                        return;
                    }
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            document.getElementById("naTab").innerHTML = xhttp.responseText;
                            
                        }
                    }
                    xhttp.open("GET", "funkcyjne/pobierzZlec.php?data=" + document.getElementById("data").value + "&numer=" + str, true);
                    xhttp.send();
                }
            </script>';
include_once 'szablon.php';


