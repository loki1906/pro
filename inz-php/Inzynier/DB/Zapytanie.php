<?php

require_once ('./DB/ConnectDB.php');

class Zapytanie {

    const studentJoin = ' login l join student s on l.login = s.nr_albumu join grupa g on s.id_grupa = g.id 
                        join przedmiot p on g.id = p.id_grupa left join skladowa sk on sk.id_przedmiot = p.id 
                        left join ocena o on o.id_skladowa = sk.id and o.id_student = s.id ';
    const wykladowcaJoin = ' login l left join wykladowca w on l.login = w.pesel left join wyk_przed wp on w.id = wp.wykladowca_id 
            left join przedmiot p on wp.przedmiot_id = p.id right join skladowa sk on sk.id_przedmiot = p.id left join grupa g on p.id_grupa = g.id 
             left join student s on s.id_grupa = g.id left join ocena o on o.id_skladowa = sk.id and o.id_student = s.id ';
    const select = 'select distinct ';
    const delete = 'delete ';
    const insert = 'insert into ';
    const values = ' values ';
    const update = 'update ';
    const set = ' set ';
    const from = ' from ';
    const where = ' where ';

    function stworzZapytanie($akcja, $login, $tab, $kolumny, $wartosci, $warunki) {
        if (!empty($kolumny)) {
            $i = 0;
            $kol = '';
            foreach ($kolumny as $value) {
                $kol .= $value;
                if ($i < count($kolumny) - 1) {
                    $kol .= ", ";
                }
                $i++;
            }
        }
        if (!empty($wartosci)) {
            $a = 0;
            $wart = '';
            foreach ($wartosci as $val) {
                $wart .= $val;
                if ($a < count($wartosci) - 1) {
                    $wart .= ", ";
                }
                $a++;
            }
        }
        switch ($akcja) {
            case 'select':
                if (strlen($login) == 6) {
                    $zapytanie = self::select . $kol . self::from . self::studentJoin . self::where . $warunki;
                } elseif (strlen($login) == 11) {
                    $zapytanie = self::select . $kol . self::from . self::wykladowcaJoin . self::where . $warunki;
                }
                break;

            case 'insert':
                $zapytanie = self::insert . $tab . "(" . $kol . ")" . self::values . "(" . $wart . ")";
                break;

            case 'update':
                $ile = 0;
                $rownanie = '';
                foreach ($kolumny as $value) {
                    $aa = 0;
                    foreach ($wartosci as $val) {
                        if ($ile == $aa) {
                            $rownanie .= $value . " = " . $val;
                            if ($aa < count($wartosci) - 1) {
                                $rownanie .= ", ";
                            }
                        }
                        $aa++;
                    }
                    $ile++;
                }
                $zapytanie = self::update . $tab . self::set . $rownanie . self::where . $warunki;
                break;

            case 'delete':

                $zapytanie = self::delete . self::from . $tab . self::where . $warunki;

                break;
        }
        return $zapytanie;
    }

    function wykonajZapytanie($zapytanie) {
        $instancja = ConnectDB::getInstance()->_pdo;
        $que = $instancja->query($zapytanie);
        $quefetch = $que->fetchAll(PDO::FETCH_ASSOC);                               
        return $quefetch;
    }

    function policzKolumny($kolumny) {
        $liczbaKolumn = count($kolumny);
        return $liczbaKolumn;
    }

    function zwrocWyniki($quefetch, $liczbaKolumn, $gdzie, $plik) {
        $ile = 0;
        $wartosc = null;
        foreach ($quefetch as $value) {
            foreach ($value as $val) {
                $ile++;
            }
        }
        if ($ile == 1 && empty($gdzie) && empty($plik)) {                       // pojedyncza wartość 
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    $wartosc = $val;
                }
            }
        } elseif ($ile > 1 && empty($gdzie) && empty($plik)) {                  // tabela bez przekierowan
            $i = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($i % $liczbaKolumn == 0) {
                        $wartosc .= '<tr id="tr_tab">';
                    }
                    $wartosc .= '<td align="center">' . $val . '</td>';

                    $i++;
                }
            }
        } elseif ($ile > 1 && !empty($gdzie) && empty($plik)) {                 // tabela z przekierowaniami
            $ii = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($ii % $liczbaKolumn == 0) {
                        $wartosc .= '<tr id="tr_tab">';
                        $wartosc .= '<td align="center"><a href="' . $gdzie . '?id=' . $val . '">';
                    } elseif ($ii % $liczbaKolumn == 1) {
                        $wartosc .= $val . '</a></td>';
                    } else {
                        $wartosc .= '<td align="center">' . $val . '</td>';
                    }
                    $ii++;
                }
            }
        } elseif ($ile >= 1 && !empty($gdzie) && $plik == 'up') {                 // tabela z uploadem
            $iii = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($ile == 1) {
                        $wartosc .= '</tr><tr id="tr_tab">
                            <td align = "center">' . $val . '</td>
                                    <td align = "center"> 
                                    <form action="' . $gdzie . '" method="post" enctype="multipart/form-data">
                                    <input type="file" name="plik" >
                                    <input type="submit" value="Wrzuć plik" name="submit">
                                    </form>
                                    </td>';
                    } elseif ($iii % $liczbaKolumn == 0) {
                        $wartosc .= '</tr><tr id="tr_tab">';
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    } elseif ($iii % $liczbaKolumn == $liczbaKolumn) {
                        $wartosc .= '<td align = "center">' . $val . '</td>
                                    <td align = "center"> 
                                    <form action="' . $gdzie . '" method="post" enctype="multipart/form-data">
                                    <input type="file" name="plik" >
                                    <input type="submit" value="Wrzuć plik" name="submit">
                                    </form>
                                    </td>';
                    } else {
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    }
                    $iii++;
                }
            }
        } elseif ($ile > 1 && !empty($gdzie) && $plik == 'down') {               // tabela z downloadem
            $iii = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($iii % $liczbaKolumn == 0) {
                        $wartosc .= '</tr><tr id="tr_tab">';
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    } elseif ($iii % $liczbaKolumn == $liczbaKolumn - 1) {
                        $wartosc .= '<td  align = "center">Plik: ' . $val . '
                                    <form action="' . $gdzie . '" method="post" name="download">
                                        <input name="file" value="' . $val . '" type="hidden">
                                        <input type="submit" value="Pobierz">
                                     </form>
                                </td>';
                    } else {
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    }
                    $iii++;
                }
            }
        } elseif ($ile > 1 && !empty($gdzie) && $plik == 'update') {                 // tabela z uploadem i downloadem
            $iii = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($iii % $liczbaKolumn == 0) {
                        $wartosc .= '</tr><tr id="tr_tab">';
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    } elseif ($iii % $liczbaKolumn == $liczbaKolumn - 4) {
                        $wartosc .= '<td  align = "center">Plik: ' . $val . '
                                    <form action="' . $gdzie . '" method="post" name="download">
                                        <input name="file" value="' . $val . '" type="hidden">
                                        <input type="submit" value="Pobierz">
                                     </form>
                                </td>';
                    } elseif ($iii % $liczbaKolumn == $liczbaKolumn - 1) {
                        $wartosc .= '<td  align = "center">
                                    <form action="' . $gdzie . '" method="post" name="update">
                                        <select name="ocena">
                                        <option value="2">2</option>
                                        <option value="2.5">2.5</option>
                                        <option value="3">3</option>
                                        <option value="3.5">3.5</option>
                                        <option value="4">4</option>
                                        <option value="4.5">4.5</option>
                                        <option value="5">5</option>
                                        </select>
                                        <input type="hidden" name="idStud" value="' . $val . '">
                                        <input type="submit" value="Uaktualnij">
                                     </form>
                                </td>';
                    } else {
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    }
                    $iii++;
                }
            }
        } elseif ($ile >= 1 && !empty($gdzie) && $plik == 'del') {                 // tabela z uploadem
            $iii = 0;
            foreach ($quefetch as $value) {
                foreach ($value as $val) {
                    if ($ile == 1) {
                        $wartosc .= '</tr><tr id="tr_tab">
                            <td align = "center">' . $val . '</td>
                                    <td align = "center"> 
                                    <form action="' . $gdzie . '" method="get" enctype="multipart/form-data">
                                    <input type="hidden" name="usun" value="tak">
                                    <input type="submit" value="Usuń plik" >
                                    </form>
                                    </td>';
                    } elseif ($iii % $liczbaKolumn == 0) {
                        $wartosc .= '</tr><tr id="tr_tab">';
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    } elseif ($iii % $liczbaKolumn == $liczbaKolumn) {
                        $wartosc .= '<td align = "center">' . $val . '</td>
                                    <td align = "center"> 
                                    <form action="' . $gdzie . '" method="post" enctype="multipart/form-data">
                                    <input type="file" name="plik" >
                                    <input type="submit" value="Wrzuć plik" name="submit">
                                    </form>
                                    </td>';
                    } else {
                        $wartosc .= '<td align = "center">' . $val . '</td>';
                    }
                    $iii++;
                }
            }
        }
        return $wartosc;
    }

}
