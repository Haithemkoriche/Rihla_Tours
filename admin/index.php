<?php 
include "config.php"; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}

// Récupération du nombre d'hôtels
$query_hotels = "SELECT COUNT(*) AS total_hotels FROM hotels"; // Remplacez 'hotels' par le nom de votre table d'hôtels
$result_hotels = $conn->query($query_hotels);
$row_hotels = $result_hotels->fetch_assoc();
$nombre_hotels = $row_hotels['total_hotels'];

// Récupération du nombre de vols
$query_vols = "SELECT COUNT(*) AS total_vols FROM vols"; // Remplacez 'vols' par le nom de votre table de vols
$result_vols = $conn->query($query_vols);
$row_vols = $result_vols->fetch_assoc();
$nombre_vols = $row_vols['total_vols'];

// Récupération du nombre de destinations
$query_destinations = "SELECT COUNT(*) AS total_destinations FROM destinations"; // Remplacez 'destinations' par le nom de votre table de destinations
$result_destinations = $conn->query($query_destinations);
$row_destinations = $result_destinations->fetch_assoc();
$nombre_destinations = $row_destinations['total_destinations'];

?>
<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main id="content" class="content active col-md-8 ms-sm-auto col-lg-8 px-md-4 mt-5">
<div class="container-fluid">
        <h1 class="mt-4 text-center mt-2 mb-2">Tableau de Bord</h1>
        <p class="text-center mt-5 mb-5">Bienvenue dans le système de gestion de Best Tour</p>

        <div class="row">
            <!-- Widget pour les hôtels -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre d'Hôtels</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre_hotels; ?> Hôtels</h5>
                    </div>
                </div>
            </div>

            <!-- Widget pour les vols -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Vols</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre_vols; ?> Vols</h5>
                    </div>
                </div>
            </div>

            <!-- Widget pour les destinations -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Destinations</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre_destinations; ?> Destinations</h5>
                    </div>
                </div>
            </div>

            <!-- Ajoutez d'autres widgets selon vos besoins -->

        </div>
    </div>
</main>
<?php include "layouts/footer.php" ?>
