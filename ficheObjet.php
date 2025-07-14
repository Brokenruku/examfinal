<?php
define('APP_ROOT', true);

require_once 'includes/config.php';
include 'includes/header.php';
include 'includes/fonction.php';

$objectId = $_GET['id_objet'];
$result = afficherFiche($mysqli, $objectId);
$row = mysqli_fetch_assoc($result);

?>
<?php if (!empty($row['imagee'])) { ?>
    <a href="ficheObjet.php?id_objet=<?= $objectId ?>"><img src="<?= htmlspecialchars($row['imagee']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nomObjet']) ?>" style="height: 200px; object-fit: cover;"></a>
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
        <a href='emprunterObjet.php?id_objet=<?= $objectId ?>' class='btn btn-primary'>Emprunter</a>
    <?php } ?>
</div>
<?php
include 'includes/footer.php';
?>