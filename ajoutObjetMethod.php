<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/fonction.php';

$id_membre = $_POST['id_membre'];
$nom_objet = $_POST['nom_objet'];
$id_categorie = $_POST['id_categorie'];

$ok_insertionObjet = insertObjet($mysqli, $id_membre, $nom_objet, $id_categorie);

$id_objet = mysqli_insert_id($mysqli);

$uploadDir = 'assets/img/objects/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
    $imageName = basename($_FILES['images']['name'][$key]);
    $uploadFile = $uploadDir . uniqid() . '_' . $imageName;
    
    if (move_uploaded_file($tmp_name, $uploadFile)) {
        $ok_insertImageObjet = insertImageObjet($mysqli, $id_objet, $uploadFile); 
    }
}

header("Location: listeObjet.php?id_membre=" . $id_membre);
?>