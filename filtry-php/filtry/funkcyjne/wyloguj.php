<?php

session_start();
unset($_SESSION['login']);
session_destroy();
echo "<script> window.location.replace('../index.php?blad=3') </script>" ;