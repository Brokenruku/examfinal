<?php
require_once 'includes/config.php';

$id_objet = $_GET['id_objet'];
$id_membre = $_GET['id_membre'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jours = $_POST['jours'];
    $date_emprunt = date('Y-m-d H:i:s');
    $date_retour = date('Y-m-d H:i:s', strtotime("+$jours days"));
    
    $sql = "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) 
            VALUES ('$id_objet', '$id_membre', '$date_emprunt', '$date_retour')";
    
    if (mysqli_query($mysqli, $sql)) {
        header("Location: listeObjet.php?id_membre=$id_membre");
        exit();
    }
}
?>