<?php
    defined('APP_ROOT') or die('Accès interdit');

    $mysqli = mysqli_connect('172.60.0.11', 'ETU004064', 'ojNrVuY2', 'emprunter');

    if (mysqli_connect_error()) {
        die('Erreur DB (' . mysqli_connect_errno() . ') ' 
            . mysqli_connect_error());
    }

    mysqli_set_charset($mysqli, 'utf8mb4');
?>