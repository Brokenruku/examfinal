<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';
?>

<div class="container mt-5">
    <h3 class="text-center mb-4">Créer un nouveau profil</h3>

    <form action="nvProfileMethod.php" method="post" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" name="nom" required>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date d'anniversaire :</label>
            <input type="date" class="form-control" name="date_naissance" required>
        </div>

        <div class="mb-3">
            <label for="genre" class="form-label">Genre :</label>
            <select name="genre" class="form-select">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="text" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville :</label>
            <input type="text" class="form-control" name="ville" required>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" name="mdp" required>
        </div>

        <div class="mb-3">
            <label for="image_profil" class="form-label">Image de profil :</label>
            <input type="file" class="form-control" name="image_profil" accept="image/*" required>
        </div>

        <div class="d-grid">
            <input type="submit" value="Enregistrer" name="submit" class="btn btn-success">
        </div>
    </form>
</div>

<?php
include 'includes/footer.php';
?>