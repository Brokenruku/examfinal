<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$membres = getMembre($mysqli);
?>

<div class="container">
    <h2>Liste des membres</h2>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Genre</th>
                    <th>Date de naissance</th>
                    <th>Actions</th>
                </tr>
            </thead> 
            <tbody>
                <?php if ($membres && mysqli_num_rows($membres) > 0) {?>
                    <?php while ($membre = mysqli_fetch_assoc($membres)){ ?>
                        <tr
                            <td>
                                <?php if (!empty($membre['image_profil'])){ ?>
                                    <img src="<?= ($membre['image_profil']) ?>" class="rounded-circle" width="50" height="50" alt="Photo profil">
                                <?php }else{ ?>
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                <?php }?>
                            </td>
                            <td><?= ($membre['nom']) ?></td>
                            <td><?= ($membre['email']) ?></td>
                            <td><?= ($membre['ville']) ?></td>
                            <td><?= ($membre['genre']) ?></td>
                            <td><?= date('d/m/Y', strtotime($membre['date_naissance'])) ?></td>
                            <td>
                                <a href="ficheMembre.php?id=<?= $membre['id_membre'] ?>" class="btn btn-sm btn-primary">Voir</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan="7" class="text-center">Aucun membre trouvé</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';
?>