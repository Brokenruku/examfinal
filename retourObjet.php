<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';

$id_emprunt = $_GET['id_emprunt'];
$id_membre = $_GET['id_membre'];

$sql = "SELECT e.*, o.nom_objet 
        FROM emprunt e
        JOIN objet o ON e.id_objet = o.id_objet
        WHERE e.id_emprunt = $id_emprunt";

$result = mysqli_query($mysqli, $sql);
$emprunt = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Retourner un objet</h4>
                </div>
                <div class="card-body">
                    <h5>Objet : <?php echo $emprunt['nom_objet']; ?></h5>
                    <p>Emprunté le : <?php echo date('d/m/Y', strtotime($emprunt['date_emprunt'])); ?></p>
                    
                    <form method="post" action="retourObjetMethod.php">
                        <input type="hidden" name="id_emprunt" value="<?php echo $id_emprunt; ?>">
                        <input type="hidden" name="id_membre" value="<?php echo $id_membre; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">État de l'objet :</label>
                            <select name="etat" class="form-select" required>
                                <option value="OK">OK </option>
                                <option value="Endommagé">Endommagé</option>
                            </select>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enregistrer le retour</button>
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