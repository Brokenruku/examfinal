<?php
define('APP_ROOT', true);
require_once 'includes/fonction.php';
require_once 'includes/config.php';

$id_emprunt = $_POST['id_emprunt'];
$id_membre = $_POST['id_membre'];
$etat = $_POST['etat'];

$sql = "INSERT INTO etat_objet (id_emprunt, etat) 
            VALUES ('$id_emprunt', '$etat')";

if (mysqli_query($mysqli, $sql)) {
    header("Location: ficheMembre.php?id=$id_membre");
}
?>