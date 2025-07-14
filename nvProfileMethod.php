<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/fonction.php';

$nom = $_POST['nom'];
$date_naissance = $_POST['date_naissance'];
$genre = $_POST['genre'];
$email = $_POST['email'];
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];

$uploadDir = 'assets/img/profiles/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$imageName = basename($_FILES['image_profil']['name']);
$uploadFile = $uploadDir . uniqid() . '_' . $imageName;

if (move_uploaded_file($_FILES['image_profil']['tmp_name'], $uploadFile)) {
    $image_profil = $uploadFile;

    $ok_nvProfil = insertMembre($mysqli, $nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil);

    if ($ok_nvProfil) {
        $id_membre = getIDemail($mysqli, $email, $mdp);
        header("Location: listeObjet.php?id_membre=" . "$id_membre");
    } else {
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
?>