<?php

define('APP_ROOT', true);
define('IMG_DEFAUT', 'assets/img/objet/1.png');

require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$id_membre = $_GET['id_membre'];
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
        <select name="catg[]" class="form-select">
            <?php
            $categories = mysqli_query($mysqli, "SELECT * FROM categorie_objet ORDER BY nom_categorie");
            while ($cat = mysqli_fetch_assoc($categories)) {
            ?>
                <option value="<?php echo $cat['id_categorie']; ?>">
                    <?php echo $cat['nom_categorie']; ?>
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
                        <?php
                        $imagelien = !empty($row['imagee']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $row['imagee'])
                            ? $row['imagee']
                            : IMG_DEFAUT;
                        ?>
                        <img src="<?= $imagelien ?>" class="card-img-top" alt="<?=  ($row['nomObjet']) ?>" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?=  ($row['nomObjet']) ?></h5>
                            <p class="card-text">
                                <strong>Catégorie:</strong> <?=  ($row['categorie']) ?><br>
                                <strong>Propriétaire:</strong> <?=  ($row['proprietaire']) ?><br>

                                <?php if ($row['empruntMembre'] !== 'pas de membreemprunt') { ?>
                                    <strong>Emprunté par:</strong> Membre #<?=  ($row['empruntMembre']) ?><br>
                                    <strong>Date emprunt:</strong> <?=  ($row['date_emprunt']) ?><br>
                                    <strong>Date retour:</strong> <?= ($row['date_retour'] !== 'pas de dater retour' ?  ($row['date_retour']) : 'Non retourné') ?><br>
                                <?php } else { ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php } ?>
                            </p>

                            <a href='emprunterObjet.php?id_objet=<?= $row['id_objet'] ?>&id_membre=<?= $id_membre ?>' class='btn btn-primary'>Emprunter</a>
                            <a href='ficheObjet.php?id_objet=<?= $row['id_objet'] ?>&id_membre=<?= $id_membre ?>' class="btn btn-primary">Fiche</a>
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