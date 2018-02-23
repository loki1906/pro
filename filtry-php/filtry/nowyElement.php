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
$tytul = 'Nowy element';
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
                            Typ:<br> <input type="text" name="typ"><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
                            </form>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszMaterial.php" method="POST" >
                            Nazwa:<br> <input type="text" name="nazwa"><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            Jednostka:<br>
                            <input type="radio" name="jednostka" value="mk" checked>metr kwadratowy
                            <br>
                            <input type="radio" name="jednostka" value="mb">metr bierzący
                            <br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
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
                            Material:<br> <select name="material">
                                <option value="plastik">Plastik</option>
                                <option value="metal">Metal</option>
                            </select><br>
                            Długość:<br> <input type="number" name="dlugosc" min="0"><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
                            </form> 
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszProfZam.php" method="POST" >
                            Material:<br> 
                            <select name="material">
                                <option value="Plastik 4A">Plastik 4A</option>
                                <option value="Plastik 4B">Plastik 4B</option>
                                <option value="Plastik 4C">Plastik 4C</option>
                                <option value="Plastik 4D">Plastik 4D</option>
                                <option value="plastik 4M">Plastik 4M</option>
                            </select><br>
                            Długość:<br> <input type="number" name="dlugosc" min="0"><br>
                            Ilość kieszeni:<br><input type="number" name="iloscWciec" min="0"><br>
                            Ilość:<br><input type="number" name="ilosc" min="0" step="0.1"><br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
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
                            Rodzaj:<br> 
                            <select name="rodzaj">
                                <option value="plastik">Plastik</option>
                                <option value="metal">Metal</option>
                                <option value="karton">Karton</option>
                            </select><br>
                            Typ:<br> <input type="text" name="typ"><br>
                            Wymiar:<br> <input type="text" name="wymiar" min="0"><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
                            </form>
                        </td>
                        <td>
                            <form action="funkcyjne/zapiszInne.php" method="POST" >
                            Nazwa:<br> <input type="text" name="nazwa"><br>
                            Ilość:<br> <input type="number" name="ilosc" min="0" step="0.1"><br>
                            Margines:<br> <input type="number" name="margines" min="0" step="0.1"><br>
                            <input type="hidden" name="akcja" value="nowy">
                            <input id="nowyBtn" type="submit" value="Dodaj nowy!">
                            </form>
                        </td>
                    </tr>
                </table>';

include_once 'szablon.php';
