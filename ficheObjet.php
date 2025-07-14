<?php
define('APP_ROOT', true);
define('IMG_DEFAUT', 'assets/img/objet/1.png');

require_once 'includes/config.php';
include 'includes/header.php';
include 'includes/fonction.php';

$objectId = $_GET['id_objet'];
$result = afficherFiche($mysqli, $objectId);
$row = mysqli_fetch_assoc($result);

?>
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

    <?php if ($row['empruntMembre'] == 'pas de membreemprunt') { ?>
        <a href='emprunterObjet.php?id_objet=<?= $objectId ?>' class='btn btn-primary'>Emprunter</a>
    <?php } ?>
</div>
<?php
include 'includes/footer.php';
?>