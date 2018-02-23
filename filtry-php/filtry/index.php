<?php 
session_start();

require_once 'db.php';
if (!empty($_SESSION['login'])) {
    echo "<script> window.location.replace('rozchod.php') </script>" ;
} 
$tytul = 'Logowanie';
$text = '       <table id="tab_info">
                        <th colspan="3" color="#8dff1c">Logowanie</th>
                        <tr>
                            <td align="center" width="50%">
                                <b id="kropka">• </b>Login:
                            </td>
                            <td align="center" width="50%">
                                <b id="kropka">• </b>Hasło:
                            </td>
                            <td width="50%">
                                &emsp;
                            </td>
                        </tr>
                        <tr>
                        <form action="funkcyjne/logowanie.php" method="post" >
                            <td align="center">
                                <input id="login" type="text" name="login">
                            </td>
                            <td align="center">
                                <input type="password" name="haslo">
                            </td>
                            <td align="center">
                                <input id="button" type="submit" value="wejdź">
                            </td>
                        </form>
                        </tr>
                    </table>
        ';
include_once 'szablon.php';

