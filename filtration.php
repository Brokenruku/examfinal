<?php
define('APP_ROOT', true);
define('DEFAULT_OBJECT_IMAGE', 'assets/img/objet/1.png');
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$selectedCategories = isset($_POST['catg']) ? $_POST['catg'] : [];  
$result = filtrationObject($mysqli, $selectedCategories);
?>

<div class="container">
    <h2>Liste des objets disponibles</h2>
    <div class="row">
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php
                        $imagePath = !empty($row['imagee']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $row['imagee'])
                            ? $row['imagee']
                            : DEFAULT_OBJECT_IMAGE;
                        ?>
                        <img src="<?= $imagePath ?>" class="card-img-top" alt="<?=  ($row['nomObjet']) ?>" style="height: 200px; object-fit: cover;">

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