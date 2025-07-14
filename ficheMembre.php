<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listeMembre.php");
}

$id_membre = $_GET['id'];
$membre = getMembrePID($mysqli, $id_membre);
$objets = getObjPMembre($mysqli, $id_membre);
$emprunts = getEmpPMembre($mysqli, $id_membre);
?>

<div class="container">
    <?php
    if ($membre) {
    ?>
        <div class="row mb-4">
            <div class="col-md-3">
                <?php
                if (!empty($membre['image_profil'])) {
                ?>
                    <img src="<?= ($membre['image_profil']) ?>" class="img-thumbnail" alt="Photo profil">
                <?php
                } else {
                ?>
                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-user fa-5x text-white"></i>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-md-9">
                <h2><?= ($membre['nom']) ?></h2>
                <ul class="list-unstyled">
                    <li><strong>Email:</strong> <?= ($membre['email']) ?></li>
                    <li><strong>Ville:</strong> <?= ($membre['ville']) ?></li>
                    <li><strong>Genre:</strong> <?= ($membre['genre']) ?></li>
                    <li><strong>Date de naissance:</strong> <?= date('d/m/Y', strtotime($membre['date_naissance'])) ?></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h3>Ses objets</h3>
                <?php
                if ($objets && mysqli_num_rows($objets) > 0) {
                ?>
                    <div class="list-group">
                        <?php
                        while ($objet = mysqli_fetch_assoc($objets)) {
                        ?>
                            <a href="ficheObjet.php?id=<?= $objet['id_objet'] ?>" class="list-group-item list-group-item-action">
                                <?= ($objet['nom_objet']) ?> (<?= ($objet['categorie']) ?>)
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-info">aucun objet.</div>
                <?php
                }
                ?>
            </div>

            <div class="col-md-6">
                <h3>Ses emprunts</h3>
                <?php
                if ($emprunts && mysqli_num_rows($emprunts) > 0) {
                ?>
                    <div class="list-group">
                        <?php while ($emprunt = mysqli_fetch_assoc($emprunts)) { ?>
                            <div class="list-group-item">
                                <strong><?= ($emprunt['nom_objet']) ?></strong><br>
                                Emprunté le: <?= date('d/m/Y', strtotime($emprunt['date_emprunt'])) ?><br>
                                <?php if ($emprunt['date_retour']) { ?>
                                    Retour prévu le: <?= date('d/m/Y', strtotime($emprunt['date_retour'])) ?>
                                    <?php if (empty($emprunt['id_etat'])) { ?>
                                        <a href="retourObjet.php?id_emprunt=<?= $emprunt['id_emprunt'] ?>&id_membre=<?= $id_membre ?>" class="btn btn-sm btn-warning float-end">Retour</a>
                                    <?php } ?>
                                <?php } else { ?>
                                    En cours
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-info">emprunt en cours</div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger">Membre non trouvé</div>
    <?php
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>