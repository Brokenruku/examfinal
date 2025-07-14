<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

?>

<form action="loginMethod.php" method="post">
    <label for="email"> email : </label>
    <input type="text" name="email" required>

    <br>

    <label for="mdp"> mdp : </label>
    <input type="text" name="mdp" required>

    <br>   
    <input type="submit" value="iviyv">
</form>

<br>

<a href="nvProfile.php">nouveau membre</a>

<?php
include 'includes/footer.php';
?>