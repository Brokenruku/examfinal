<?php
define('APP_ROOT', true);
require_once 'includes/config.php';

require_once 'includes/fonction.php';

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$ok_login = verfInfo($mysqli, $email,$mdp);

if ($ok_login = true) {
    $id_membre = getIDemail($mysqli, $email,$mdp);
    header("Location: listeObjet.php?id_membre=$id_membre");
} else {
    header("Location: login.php?error=1");
}

?>
