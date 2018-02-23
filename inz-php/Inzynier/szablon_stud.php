<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <META http-equiv="Content-Language" content="pl">
            <title><?php echo $wartosci; ?></title>
            <link rel="stylesheet" type="text/css" href="styl_stud.css"/>
    </head>
    <body>
        <div id="centrum">
            <div id="glowny">
                <div id="menu">
                    <table id="tab_centrum">
                        <tr>
                            <td width="25%" align="center"><b id="kropka">• </b><a href="aktualnosci.php">Aktualności</a></td>
                            <td width="25%" align="center"><b id="kropka">• </b><a href="przedmioty.php">Przedmioty</a></td>
                            <td width="25%" align="center"><b id="kropka">• </b><a href="zaleglosci.php">Zaległości</a></td>
                        </tr>
                    </table>
                </div>
                <div id="info">
                    <table id="tab_info">
                        <th id="th_inf" colspan="2" color="#8dff1c">Dane użytkownika</th>
                        <tr>
                            <td id="td_inf_g" width="50%">
                                <b id="kropka">• </b>Nr albumu:
                            </td>
                            <td id="td_inf1_g" width="50%">
                                <?php echo $_SESSION['album']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="td_inf" width="50%">
                                <b id="kropka">• </b>Imię:
                            </td>
                            <td id="td_inf1" width="50%">
                                <?php echo $_SESSION['imie']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="td_inf" width="50%">
                                <b id="kropka">• </b>Nazwisko:
                            </td>
                            <td id="td_inf1" width="50%">
                                <?php echo $_SESSION['nazwisko']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td id="td_inf" width="50%">
                                <b id="kropka">• </b>Grupa:
                            </td>
                            <td id="td_inf1" width="50%">
                                <?php echo $_SESSION['grupa'] . " - " . $_SESSION['rodzaj']; ?>
                            </td>
                        </tr>
                        <tr id="wyl" align="center">
                            <td colspan="2">
                                <a href="wyloguj.php">wyloguj</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <table id="wys_glowna">
                    <tr id="tytul">
                        <td colspan="100%" align="center">
                            <span id="x">
                                <?php
                                if (!empty($info)) {
                                    echo $info;
                                }
                                ?>
                            </span>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('x').innerHTML = ''
                                }, 3000)
                            </script>
                            <h1><?php echo $title; ?></h1>
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <table id="wys_tab" >
                                <tr height="30px">

                                    <p>
                                        <?php
                                        echo $opis . '<br>';
//                                        echo $selecty;
                                        ?>
                                    </p>
                                </tr>
                                <tr id="th_inf" >
                                    <?php echo $tabHead; ?>
                                </tr>

                                <?php
                                echo $tabela;
                                ?>
                            </table>
                            <?php
                            if (!empty($tabela2)) {
                                echo $tabela2;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
