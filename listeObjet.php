<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$id_membre = $_GET['id_membre'];
var_dump($_GET['id_membre']);
$result = afficherObjet($mysqli);
?>

<a href="ajoutObjet.php?id_membre=<?= $id_membre ?>" class="btn btn-primary">
    Ajouter un nouvel objet
</a>

<h2>recherche</h2>
<form action="filtration.php" method="post">
    <div class="mb-3">
        <label class="form-label">Filtrer par catégorie :</label>

        <br>

        <?php
        $categories = mysqli_query($mysqli, "SELECT * FROM categorie_objet ORDER BY nom_categorie");

        while ($cat = mysqli_fetch_assoc($categories)) {
        ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="catg[]" id="cat-<?php echo $cat['id_categorie']; ?>" value="<?php echo $cat['id_categorie']; ?>">
                <label class="form-check-label" for="cat-<?php echo $cat['id_categorie']; ?>"><?php echo $cat['nom_categorie']; ?></label>
            </div>
        <?php
        }
        ?>

        <br>

        <label class="form-label">Filtrer avec deroulant :</label>
        <select name="catg[]" class="form-select" >
            <?php
            $categories = mysqli_query($mysqli, "SELECT * FROM categorie_objet ORDER BY nom_categorie");
            while ($cat = mysqli_fetch_assoc($categories)) {
            ?>
                <option value="<?php echo ($cat['id_categorie']); ?>">
                    <?php echo ($cat['nom_categorie']); ?>
                </option>
            <?php
            }
            ?>
        </select>
        
    </div>
    <button type="submit" class="btn btn-primary">Filtrer</button>
</form>

<br>

<div class="container">
    <h2>Liste des objets disponibles</h2>
    <div class="row">
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if (!empty($row['imagee'])) { ?>
                            <a href="ficheObjet.php?id_objet=<?= $id_objet ?>"><img src="<?= htmlspecialchars($row['imagee']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nomObjet']) ?>" style="height: 200px; object-fit: cover;"></a>
                        <?php } else { ?>
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                Pas d'image
                            </div>
                        <?php } ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nomObjet']) ?></h5>
                            <p class="card-text">
                                <strong>Catégorie:</strong> <?= htmlspecialchars($row['categorie']) ?><br>
                                <strong>Propriétaire:</strong> <?= htmlspecialchars($row['proprietaire']) ?><br>

                                <?php if ($row['empruntMembre'] !== 'pas de membreemprunt') { ?>
                                    <strong>Emprunté par:</strong> Membre #<?= htmlspecialchars($row['empruntMembre']) ?><br>
                                    <strong>Date emprunt:</strong> <?= htmlspecialchars($row['date_emprunt']) ?><br>
                                    <strong>Date retour:</strong> <?= ($row['date_retour'] !== 'pas de dater retour' ? htmlspecialchars($row['date_retour']) : 'Non retourné') ?><br>
                                <?php } else { ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php } ?>
                            </p>

                            <?php if ($row['empruntMembre'] == 'pas de membreemprunt') { ?>
                                <a href='emprunterObjet.php?id_objet=<?= $id_objet ?>' class='btn btn-primary'>Emprunter</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-12">
                <div class="alert alert-info">Aucun objet disponible pour le moment.</div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>