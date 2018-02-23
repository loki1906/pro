
<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['login'])) {
    include_once 'DB/User.php';
    $blad = null;
    if (!empty($_GET['blad'])) {
        $blad = $_GET['blad'];
        if ($blad == 1) {
            $wysBlad = 'niepoprawne dane logowania';
        } elseif ($blad == 2) {
            $wysBlad = 'uzupełnij dane logowania';
        }
    }
} else {
    header("location:aktualnosci.php");
}
?>
<html lang="pl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logowanie</title>
        <link rel="stylesheet" type="text/css" href="styl.css"/>
    </head>
    <body>
        <div id="centrum">
            <div id="glowny">
                <div id="menu">
                    <table id="tab_centrum">
                        <tr>
                            <td id="tytul" align="center">Witaj na platformie wydziału WIMiM Politechniki Śląskiej</td>

                        </tr>
                    </table>
                </div>
                <div id="info">
                    <table id="tab_info">
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
                        <form action="logowanie.php" method="post" >
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
                    <span id="x" align="center">
                    <?php
                    if (!empty($wysBlad)) {
                        echo $wysBlad;
                    }
                    ?>
                </span>
                <script>
                    setTimeout(function() {
                        document.getElementById('x').innerHTML = ''
                    }, 3000);
                </script>
                </div>
                
            </div>
        </div>
    </body>
</html>

