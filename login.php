<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/fonction.php';

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header text-center">
                    <h4>Connexion</h4>
                </div>
                <div class="card-body">
                    <form action="loginMethod.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="mdp" required>
                        </div>

                        <div class="d-grid">
                            <input type="submit" class="btn btn-primary" value="Se connecter">
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="nvProfile.php">Créer un nouveau compte</a>
                </div>
            </div>

        </div>
    </div>
</div>

<br>
<a href="nvProfile.php">nouveau membre</a>

<?php
include 'includes/footer.php';
?>