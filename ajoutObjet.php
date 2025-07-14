<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$selectedCategories = isset($_POST['catg']) ? $_POST['catg'] : [];  
$result = filtrationObject($mysqli, $selectedCategories);
?>

<?php
include 'includes/footer.php';
?>