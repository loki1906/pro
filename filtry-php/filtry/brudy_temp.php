
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<div id = "view">
                <?php
                echo $text;
                ?>

                <table id="zlecTab" border="1">
                    <tr>
                        <th>
                            <h2>Numer zamówienia</h2>
                        </th>
                    </tr>
                    <tr>
                        <td align="center">
                            <br>
                            <form id="myform"  method="POST" >  <!--"funkcyjne/zapiszZamowienie.php"-->
                                <input type="text" id="nrZamowienia" name="nrZamowienia">
                                <script>
                                    function sprawdz(){
                                        var pole = document.getElementById(\'nrZamowienia\');
                                        
                                        if(pole.value.trim() == \'\' || pole.value.trim() == null){
                                            alert(\'uzupełnij numer zamówienia\');
                                        } else {
                                            document.getElementById(\'myform\').action = "funkcyjne/zapiszZamowienie.php";
                                        }
                                    }
                                    
                                </script>
                                <br>
                                </td>
                                </tr>
                                <tr>
                                    <th>
                                <h2>Rodzaj filtra</h2>
                                </th>
                    </tr>
                    <tr>
                        <td align="center">
                            <br>
                            <select name="rodzFiltra">
                                <?php
                                $selRodz = mysql_query("select idRodzaju_filtra, nazwa from rodzaj_filtra;") or die(mysql_error());
                                while ($row = mysql_fetch_array($selRodz)) {
                                    echo '<option value="' . $row['idRodzaju_filtra'] . '">' . $row['nazwa'] . '</option>';
                                }
                                ?>
                            </select> 
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <th>
                    <h2>Materiał</h2>
                    </th>
                    </tr>
                    <tr>
                        <td align="center">
                            Typ
                            <br>
                            <select name="idMat" onchange="loadMat(this.value)" onFocus="loadMat(this.value)">
                                <?php
                                $selMat = mysql_query("select idMaterialu, typ from material;") or die(mysql_error());
                                while ($row = mysql_fetch_array($selMat)) {
                                    echo '<option value="\' . $row[\'idMaterialu\'] . \'">\' . $row[\'typ\'] . \'</option>';
                                }
                                ?>
                            </select> 
                            <br>
                            Ilość<br> <input id="ilMater" name="ilMater" type="number" name="iloscMaterialu" min="0">
                            <br>
                            <script>
                                function loadMat(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilMater").value = 0;
                                        document.getElementById("ilMater").max = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilMater").max = xhttp.responseText;
                                            document.getElementById("ilMater").value = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlMat.php?id=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>

                    </tr>
                    <tr>
                        <th >
                    <h2>Narożnik</h2>
                    </th>
                    </tr>
                    <tr>
                        <td align="center">
                            Typ
                            <br>
                            <select name="idNar" onchange="loadNar(this.value)" onFocus="loadNar(this.value)">
                                <?php
                                $selNar = mysql_query("select idNaroznika, typ from naroznik;") or die(mysql_error());
                                while ($row = mysql_fetch_array($selNar)) {
                                    echo '<option value="\' . $row[\'idNaroznika\'] . \'" >\' . $row[\'typ\'] . \'</option>';
                                }
                                ?>
                            </select> 
                            <br>
                            Ilość<br> <input id="ilNar" name="ilNar" type="number" name="iloscNaroznika" min="0">
                            <br>
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
                                            document.getElementById("ilNar").max = xhttp.responseText;
                                            document.getElementById("ilNar").value = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlNar.php?nazwa=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th >
                    <h2>Ramka</h2>
                    </th>
                    </tr>
                    <tr>
                        <td align="center">
                            Nazwa
                            <br>
                            <select id="ram" onchange="loadMatRam(this.value)" onFocus="loadMatRam(this.value)">
                                <?php
                                $selRam = mysql_query("select distinct rodzaj from ramka;") or die(mysql_error());
                                while ($row = mysql_fetch_array($selRam)) {
                                    echo '<option value="\' . $row[\'rodzaj\'] . \'" >\' . $row[\'rodzaj\'] . \'</option>';
                                }
                                ?>
                            </select> 

                            <br>
                            Material<br>
                            <select id="matRam" onFocus="loadDlRam(this.value)" onchange="loadDlRam(this.value)">

                            </select> 
                            <script>
                                function loadMatRam(str) {
                                    loadDlRam("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("matRam").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("matRam").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzMatRam.php?nazwa=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            <br>
                            Długość<br>
                            <select id="dlRam" onFocus="loadSzerRam(this.value)" onchange="loadSzerRam(this.value)">

                            </select> 
                            <script>

                                function loadDlRam(str) {
                                    loadSzerRam("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("dlRam").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("dlRam").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzDlRam.php?nazwa=" + document.getElementById("ram").value + "&material=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            <br>
                            Szerokość<br> <select id="szRam" onchange="loadWysRam(this.value)" onFocus="loadWysRam(this.value)">

                            </select> 
                            <script>

                                function loadSzerRam(str) {
                                    loadWysRam("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("szRam").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("szRam").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzSzerRam.php?nazwa=" + document.getElementById("ram").value + "&material=" + document.getElementById("matRam").value + "&dlugosc=" + str, true);
                                    xhttp.send();
                                }
                            </script><br> 
                            Wysokość<br> <select id="wysRam" onchange="loadIlRam(this.value);loadIdRam(this.value);" onFocus="loadIlRam(this.value);loadIdRam(this.value);" >

                            </select> <br>
                            <script>

                                function loadWysRam(str) {
                                    loadIlRam("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("wysRam").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("wysRam").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzWysRam.php?nazwa=" + document.getElementById("ram").value + "&material=" + document.getElementById("matRam").value + "&dlugosc=" + document.getElementById("dlRam").value + "&szerokosc=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            Ilość ramek<br> <input id="ilRam" name="ilRam" type="number" name="iloscRamek" min="0"><br>
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
                                            document.getElementById("ilRam").max = xhttp.responseText;
                                            document.getElementById("ilRam").value =  xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlRam.php?nazwa=" + document.getElementById("ram").value + "&material=" + document.getElementById("matRam").value + "&dlugosc=" + document.getElementById("dlRam").value + "&szerokosc=" + document.getElementById("szRam").value + "&wysokosc=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            <input id="idRam" type="hidden" name="idRam" />
                            <script>

                                function loadIdRam(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("idRam").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("idRam").value = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIdRam.php?nazwa=" + document.getElementById("ram").value + "&material=" + document.getElementById("matRam").value + "&dlugosc=" + document.getElementById("dlRam").value + "&szerokosc=" + document.getElementById("szRam").value + "&wysokosc=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th>
                    <h2>Profil</h2>
                    </th>
                    </tr>
                    <tr>
                        <td align="center">                            
                            Nazwa
                            <br>
                            <select id="pro" onchange="loadMatPro(this.value)" onFocus="loadMatPro(this.value)">
                                <?php
                                $selPro = mysql_query("select distinct typ from profil;") or die(mysql_error());
                                while ($row = mysql_fetch_array($selPro)) {
                                    echo '<option value="\' . $row[\'typ\'] . \'" >\' . $row[\'typ\'] . \'</option>';
                                }
                                ?>
                            </select> <br>
                            Material<br>
                            <select id="matPro" onFocus="loadDlPro(this.value)" onchange="loadDlPro(this.value)">

                            </select> 
                            <script>
                                function loadMatPro(str) {
                                    loadDlPro("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("matPro").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("matPro").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzMatPro.php?nazwa=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            <br>
                            Długość<br>
                            <select id="dlPro" onFocus="loadIlPro(this.value);loadIdPro(this.value);" onchange="loadIlPro(this.value);loadIdPro(this.value);" >

                            </select> 
                            <script>
                                function loadDlPro(str) {
                                    loadIlPro("");
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("dlPro").innerHTML = "";
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("dlPro").innerHTML = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzDlPro.php?nazwa=" + document.getElementById("pro").value + "&material=" + str, true);
                                    xhttp.send();
                                }
                            </script><br>
                            Ilość:<br> <input id="ilPro" name="ilPro" type="number" name="iloscProfilu" min="0"><br>
                            <script>

                                function loadIlPro(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("ilPro").max = 0;
                                        document.getElementById("ilPro").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("ilPro").max = xhttp.responseText;
                                            document.getElementById("ilPro").value = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIlPro.php?nazwa=" + document.getElementById("pro").value + "&material=" + document.getElementById("matPro").value + "&dlugosc=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                            <input type="hidden" name="idPro" id="idPro"/>
                            <script>

                                function loadIdPro(str) {
                                    var xhttp;
                                    if (str == "") {
                                        document.getElementById("idPro").value = 0;
                                        return;
                                    }
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("idPro").value = xhttp.responseText;
                                        }
                                    }
                                    xhttp.open("GET", "funkcyjne/pobierzIdPro.php?nazwa=" + document.getElementById("pro").value + "&material=" + document.getElementById("matPro").value + "&dlugosc=" + str, true);
                                    xhttp.send();
                                }
                            </script>
                        </td>
                    </tr>
                </table>
                </br>
                <input type="hidden" name="osoba" value="<?php echo $_SESSION['login'] ?>"/>
                <input id="zapiszBtn" onclick="sprawdz()" type="submit" value="Zapisz">
                </form>
            </div>