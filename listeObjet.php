<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$id_membre = $_GET['id_membre'];
var_dump($id_membre);
?>

<?php
include 'includes/footer.php';
?>