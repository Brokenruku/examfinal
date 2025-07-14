<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';

$id_objet = $_GET['id_objet'];
$id_membre = $_GET['id_membre'];

$query = "SELECT o.nom_objet, co.nom_categorie FROM objet o JOIN categorie_objet co ON o.id_categorie = co.id_categorie WHERE o.id_objet = ?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $id_objet);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$objet = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Emprunter un objet</h4>
                </div>
                <div class="card-body">
                    <h5>Objet : <?= htmlspecialchars($objet['nom_objet']) ?></h5>
                    <p>Catégorie : <?= htmlspecialchars($objet['nom_categorie']) ?></p>
                    
                    <form method="post" action="emprunterObjet.php">
                        <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                        <input type="hidden" name="id_membre" value="<?= $id_membre ?>">
                        
                        <div class="mb-3">
                            <label for="jours_emprunt" class="form-label">Nombre de jours d'emprunt :</label>
                            <input type="number" class="form-control" name="jours_emprunt" min="1" max="30" value="7" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Confirmer l'emprunt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>