<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/fonction.php';

$id_objet = $_GET['id_objet'];
$id_membre = $_GET['id_membre'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jours_emprunt = (int)$_POST['jours_emprunt'];
    $date_emprunt = date('Y-m-d H:i:s');
    $date_retour = date('Y-m-d H:i:s', strtotime("+$jours_emprunt days"));
    
    $query = "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $id_objet, $id_membre, $date_emprunt, $date_retour);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: listeObjet.php?id_membre=$id_membre");
    }
}
?>