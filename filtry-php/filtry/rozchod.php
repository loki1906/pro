<?php 
session_start();

require_once 'db.php';
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
    if($_SESSION['upr'] != 'produkcja'){
        echo "<script> window.location.replace('magazyn.php') </script>" ;
    }
} else {
    echo "<script> window.location.replace('index.php') </script>" ;
}

$nar = '';
$selNar = mysql_query("select id, typ from naroznik order by typ;") or die(mysql_error());
    while ($row = mysql_fetch_array($selNar)) {
        $nar .= '<option value="' . $row['id'] . '">' . $row['typ'] . '</option>';
    }

$mat = '';
$selMat = mysql_query("select id, concat(nazwa,' - ', case when jednostka='mk' then 'm2' else jednostka end) as nazwa from material order by nazwa;") or die(mysql_error());
    while ($row = mysql_fetch_array($selMat)) {
        $mat .= '<option value="' . $row['id'] . '"><p>' . $row['nazwa'] . '</p></option>';
    }
    
$proN = '';
$selProN = mysql_query("select id, concat(material, ' - ', dlugosc ) as nazwa from profil_nosny order by nazwa;") or die(mysql_error());
    while ($row = mysql_fetch_array($selProN)) {
        $proN .= '<option value="' . $row['id'] . '">' . $row['nazwa'] . '</option>';
    }
    
$proZ = '';
$selProZ = mysql_query("SELECT id, concat(COALESCE(material,''), ' - ', COALESCE(dlugosc,''), ' / ', COALESCE(ilosc_kieszeni,'')) as nazwa"
        . " FROM profil_zamykajacy order by nazwa;") or die(mysql_error());
    while ($row = mysql_fetch_array($selProZ)) {
        $proZ .= '<option value="' . $row['id'] . '">' . $row['nazwa'] . '</option>';
    }

$rodz = '';
$selRodz = mysql_query("SELECT id, concat(rodzaj,' - ',typ,' / ',wymiar) as nazwa FROM ramka order by nazwa ;") or die(mysql_error());
    while ($row = mysql_fetch_array($selRodz)) {
        $rodz .= '<option value="' . $row['id'] . '">' . $row['nazwa'] . '</option>';
    }
    
    
$inne = '';
$selInne = mysql_query("select id, nazwa from inne order by nazwa;") or die(mysql_error());
    while ($row = mysql_fetch_array($selInne)) {
        $inne .= '<option value="' . $row['id'] . '">' . $row['nazwa'] . '</option>';
    }
    

$tytul = 'Rozchód';

$text = '<table id="nowyElemntTab" border="1">
                    <tr>
                        <th width="50%">
                            <h2>Narożnik</h2>
                        </th>
                        <th>
                            <h2>Materiał</h2>
                        </th>
                        
                    </tr>
                    <tr>
                        <td>
                            <form action="funkcyjne/zapiszNaroznik.php" method="POST" >
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Typ:<br> <select name="id"  onchange="loadNar(this.value)" onFocus="loadNar(this.value)">'.$nar.'</select> <br>
                            Ilość:<br> <input type="number" id="ilNar" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form>
                            <script>
                                function loadNar(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilNar").value = 0;
                                        document.getElementById("ilNar").max = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilNar").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilNar").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlNar.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszMaterial.php" method="POST" >
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Nazwa - jednostka:<br>
                                <select name="id" onchange="loadMat(this.value)" onFocus="loadMat(this.value)">'.$mat.'</select> <br>
                            Ilość:<br> <input type="number" id="ilMat" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form> 
                            <script>
                                function loadMat(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilMat").value = 0;
                                        document.getElementById("ilMat").max = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilMat").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilMat").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlMat.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    <tr>
                        <th>
                            <h2>Profil nośny</h2>
                        </th>
                        <th width="50%">
                            <h2>Profil zamykający</h2>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <form action="funkcyjne/zapiszProfNos.php" method="POST">
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Material - długosc:<br> 
                            <select name="id" onFocus="loadIlProN(this.value)" onchange="loadIlProN(this.value)">'.$proN.'</select><br>
                            Ilość:<br> <input type="number" id="ilProN" name="ilosc" min="0" step="0.1"><br>
                            <br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form>
                            <script>

                                function loadIlProN(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilProN").max = 0;
                                        document.getElementById("ilProN").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilProN").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilProN").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlProN.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszProfZam.php" method="POST" >
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Material - długość / ilość kieszeni:<br> 
                            <select name="id" onFocus="loadIlProZ(this.value)" onchange="loadIlProZ(this.value)">'.$proZ.'</select><br>
                            Ilość:<br><input type="number" id="ilProZ" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form>
                            <script>

                                function loadIlProZ(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilProZ").max = 0;
                                        document.getElementById("ilProZ").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilProZ").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilProZ").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlProZ.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h2>Ramka</h2>
                        </th>
                        <th>
                            <h2>Inne</h2>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <form action="funkcyjne/zapiszRamke.php" method="POST" >
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Rodzaj - typ / wymiar:<br> 
                            <select name="id" onFocus="loadIlRam(this.value)" onchange="loadIlRam(this.value)">'.$rodz.'</select><br>
                            Ilość:<br> <input type="number" id="ilRam" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form>
                            <script>

                                function loadIlRam(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilRam").max = 0;
                                        document.getElementById("ilRam").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilRam").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilRam").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlRam.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszInne.php" method="POST" >
                            Numer zamówienia:&emsp; <input type="text" name="zamowienie"><br><br>
                            Nazwa:<br> 
                                <select name="id" onFocus="loadIlInn(this.value)" onchange="loadIlInn(this.value)">'. $inne.'</select> <br>
                            Ilość:<br> <input type="number" id="ilInne" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="rozchod">
                            <input id="rozchodBtn" type="submit" value="Do zamówienia">
                            </form>
                            <script>

                                function loadIlInn(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilInne").max = 0;
                                        document.getElementById("ilInne").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilInne").max = parseInt(xhttp.responseText);
                                            document.getElementById("ilInne").value = parseInt(xhttp.responseText);
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlInn.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    </tr>
                </table>';


include_once 'szablon.php';
