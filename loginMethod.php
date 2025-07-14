<?php
define('APP_ROOT', true);
require_once 'includes/config.php';

require_once 'includes/fonction.php';

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$ok_login = verfInfo($mysqli, $email,$mdp);

if ($ok_login = true) {
    header("Location: x.php?");
} else {
    header("Location: login.php?");
}

?>
