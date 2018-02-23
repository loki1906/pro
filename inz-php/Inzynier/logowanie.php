<?php
require_once ('./DB/User.php');
$user = new User();
$logow = $user->logowanie();
if($logow==true){
    $aaa = $user->dajDateLogowania();
} else {
    header('Location:localhost/Inzynier/index.php?blad=1');
}
