<?php 
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/rihla/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="/rihla/assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Espace Client</title>
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="/rihla/assets/img/logo.png" height="78" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla/#vols">Vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla/#hotel">Hôtel</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger me-2" href="deconnexion.php">Se Déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- start client dashboard -->
    <div class="container mt-5">
        <h1 class="text-center">Espace Client</h1>
        <div class="row mt-4">
            <!-- Réservation d'hôtel -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mes Réservations d'Hôtel</h5>
                        <p class="card-text">Consultez et gérez vos réservations d'hôtel.</p>
                        <a href="mes_hotel.php" class="btn btn-primary">Voir les Réservations</a>
                    </div>
                </div>
            </div>

            <!-- Réservation de vol -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mes Réservations de Vol</h5>
                        <p class="card-text">Consultez et gérez vos réservations de vol.</p>
                        <a href="mes_vols.php" class="btn btn-primary">Voir les Réservations</a>
                    </div>
                </div>
            </div>

            <!-- Réservation de destination -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mes Réservations de Destination</h5>
                        <p class="card-text">Consultez et gérez vos réservations de destination.</p>
                        <a href="#" class="btn btn-primary">Voir les Réservations</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Compte Client -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mon Compte Client</h5>
                        <p class="card-text">Gérez votre compte client et vos informations personnelles.</p>
                        <a href="#" class="btn btn-primary">Accéder au Compte</a>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mes Notifications</h5>
                        <p class="card-text">Consultez vos notifications importantes.</p>
                        <a href="#" class="btn btn-primary">Voir les Notifications</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end client dashboard -->

    <!-- Inclure les fichiers JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

</body>

</html>
