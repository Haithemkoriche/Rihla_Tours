<?php include "header.php" ?>
<!-- Menu icon (hamburger icon) -->
<div id="sidebarCollapse">
    <i class="fas fa-bars"></i>
</div>

<!-- Sidebar -->
<nav id="sidebar" class="col-md-4 col-lg-4 d-md-block sidebar pt-3 bg-light" style="padding-left: 30px;">
    <!-- Close button within the sidebar -->
    <i id="closeSidebar" class="fas fa-times-circle"></i>
     <a href="/rihla/"><i class="fas fa-arrow-left mr-2"></i>  Retour au site</a>
    <div class="d-flex justify-content-center mt-4 ">
    <img src="../assets/img/logo.png" class="img img-fluid" width="120" height="78" alt="" srcset="">
    </div>
    <div class="position-sticky">
        <ul class="nav flex-column mt-5">
            <li class="nav-item">
                <a class="nav-link active" href="/rihla/admin/index.php">
                    <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservations.php">
                    <i class="fas fa-bookmark"></i> Gestion des Réservations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clients.php">
                    <i class="fas fa-users"></i> Gestion des Clients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/rihla/admin/vols.php">
                    <i class="fas fa-plane"></i> Gestion des Vols 
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/rihla/admin/hotels.php">
                    <i class="fas fa-hotel"></i> Gestion des Hôtels
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="destinations.php">
                    <i class="fas fa-map-marked-alt"></i> Gestion des Destinations
                </a>
            </li>
        </ul>
        
    </div>
    
    <a href="/rihla/admin/deconnexion.php" class="nav-link text-white btn btn-danger" style="position: absolute; bottom: 30px; margin-right:15px;"><i class="fa fa-power-off text-white"></i>Déconnexion</a>
</nav>
