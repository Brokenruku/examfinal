<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/fonction.php';

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$result = verfInfo($mysqli, $email, $mdp);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id_membre = $row['id_membre'];
    header("Location: listeObjet.php?id_membre=$id_membre");
} else {
    header("Location: login.php?error=1");
}
?>