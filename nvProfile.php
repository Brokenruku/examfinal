<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';
?>

<form action="nvProfileMethod.php" method="post">

    <label for="nom"> nom : </label>
    <input type="text" name="nom" required>

    <br>

    <label for="date_naissance">Date d'anniv :</label>
    <input type="date" id="date" name="date_naissance" required>

    <br>

    <select name="genre">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Autre">Autre</option>
    </select>
    
    <br>

    <label for="email"> email : </label>
    <input type="text" name="email" required>

    <br>

    <label for="ville"> ville : </label>
    <input type="text" name="ville" required>

    <br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required>

    <br>

    <legend>mettre une image</legend>
    <label for="image_profil">Choisir une image :</label>
    <input type="file" name="image_profil" accept="assets/image/*" required>
    
    <br>

    <input type="submit" value="enregistrer">
</form>

<?php
include 'includes/footer.php';
?>