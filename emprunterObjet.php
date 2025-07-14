<?php
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';

$id_objet = $_GET['id_objet'];
$id_membre = $_GET['id_membre'];

$sql = "SELECT o.nom_objet, co.nom_categorie 
        FROM objet o 
        JOIN categorie_objet co ON o.id_categorie = co.id_categorie 
        WHERE o.id_objet = '$id_objet'";
$result = mysqli_query($mysqli, $sql);
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
                    <h5>Objet : <?php echo $objet['nom_objet']; ?></h5>
                    <p>Catégorie : <?php echo $objet['nom_categorie']; ?></p>
                    
                    <form method="post" action="empruntertraitement.php">
                        <input type="hidden" name="id_objet" value="<?php echo $id_objet; ?>">
                        <input type="hidden" name="id_membre" value="<?php echo $id_membre; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nombre de jours :</label>
                            <input type="number" name="jours" class="form-control" min="1" max="30" value="7" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Emprunter</button>
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