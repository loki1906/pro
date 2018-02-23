<?php 
session_start();

require_once 'db.php';
if (!empty($_SESSION['login'])) {
    $login = $_SESSION['login'];
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
        $mat .= '<option value="' . $row['id'] . '">' . $row['nazwa'] . '</option>';
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
    
$tytul = 'Dostawa';
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
                            Typ:<br> <select name="id">'.$nar.'</select> <br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszMaterial.php" method="POST" >
                            Nazwa - jednostka:<br>
                                <select name="id">'.$mat.'</select> <br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form> 
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
                            Material - długosc:<br> 
                            <select name="id">'.$proN.'</select><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            <br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form> 
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszProfZam.php" method="POST" >
                            Material - długość / ilość kieszeni:<br> 
                            <select name="id">'.$proZ.'</select><br>
                            Ilość:<br><input type="number" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form>
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
                            Rodzaj - typ / wymiar:<br> 
                            <select name="id">'.$rodz.'</select><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszInne.php" method="POST" >
                            Nazwa:<br> 
                                <select name="id">'. $inne.'</select> <br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="dostawa">
                            <input id="dostawaBtn" type="submit" value="Dostawa!">
                            </form>
                        </td>
                    </tr>
                </table>';



include_once 'szablon.php';
