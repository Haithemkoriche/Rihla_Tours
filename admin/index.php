<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main class="content col-md-8 ms-sm-auto col-lg-8 px-md-4 mt-5">
<div class="container-fluid">
        <h1 class="mt-4 text-center mt-2 mb-2">Tableau de Bord</h1>
        <p class="text-center mt-5 mb-5">Bienvenue dans le système de gestion de Best Tour</p>

        <!-- Ici, vous pouvez ajouter des widgets ou des tableaux pour afficher les données -->
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Réservations</div>
                    <div class="card-body">
                        <h5 class="card-title">150 Réservations</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Revenus</div>
                    <div class="card-body">
                        <h5 class="card-title">15000 DZD</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Réservations</div>
                    <div class="card-body">
                        <h5 class="card-title">150 Réservations</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Réservations</div>
                    <div class="card-body">
                        <h5 class="card-title">150 Réservations</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Réservations</div>
                    <div class="card-body">
                        <h5 class="card-title">150 Réservations</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Nombre de Réservations</div>
                    <div class="card-body">
                        <h5 class="card-title">150 Réservations</h5>
                        <!-- Remplacez par des données dynamiques -->
                    </div>
                </div>
            </div>
            <!-- Répétez pour d'autres statistiques comme les clients, les vols, etc. -->
        </div>
    </div>
</main>
<?php include "layouts/footer.php" ?>
