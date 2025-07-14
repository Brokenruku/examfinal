<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';
require_once 'includes/fonction.php';

$id_membre = $_GET['id_membre'];

?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter un nouvel objet</h2>

    <form action="ajoutObjetMethod.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_membre" value="<?= $id_membre ?>">

        <div class="mb-3">
            <label for="nom_objet" class="form-label">Nom de l'objet :</label>
            <input type="text" class="form-control" name="nom_objet" required>
        </div>

        <div class="mb-3">
            <label for="id_categorie" class="form-label">Catégorie :</label>
            <select class="form-select" name="id_categorie" required>
                <?php
                $categories = getCategorie($mysqli);
                $cat_ids = mysqli_query($mysqli, "SELECT id_categorie, nom_categorie FROM categorie_objet");
                while ($cat = mysqli_fetch_assoc($cat_ids)) {
                ?>
                    <option value="<?= $cat['id_categorie'] ?>"><?= $cat['nom_categorie'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Images (la première sera l'image principale) :</label>
            <input type="file" class="form-control" name="images[]" multiple accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter l'objet</button>
    </form>
</div>

</form>
<?php
include 'includes/footer.php';
?>