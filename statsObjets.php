<?php
define('APP_ROOT', true);
require_once 'includes/config.php';
require_once 'includes/headerDedans.php';

$sql_ok = "SELECT COUNT(*) as count FROM etat_objet WHERE etat = 'OK'";
$result_ok = mysqli_query($mysqli, $sql_ok);
$isan_OK = mysqli_fetch_assoc($result_ok)['count'];

$sqlPas_ok = "SELECT COUNT(*) as count FROM etat_objet WHERE etat != 'OK'";
$resultPas_ok = mysqli_query($mysqli, $sqlPas_ok);
$isanPas_ok = mysqli_fetch_assoc($resultPas_ok)['count'];
?>

<div class="container mt-5">
    <h2>Statistiques des objets retournés</h2>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Objets en bon état</div>
                <div class="card-body">
                    <h1 class="card-title text-center"><?php echo $isan_OK; ?></h1>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Objets endommagés ou perdus</div>
                <div class="card-body">
                    <h1 class="card-title text-center"><?php echo $isanPas_ok; ?></h1>
                </div>
            </div>
        </div>
    </div>
    
    <a href="listeMembre.php" class="btn btn-secondary mt-3">Retour</a>
</div>

<?php
include 'includes/footer.php';
?>