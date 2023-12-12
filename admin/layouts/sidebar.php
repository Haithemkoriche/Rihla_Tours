<?php include "header.php" ?>
<!-- Menu icon (hamburger icon) -->
<div id="sidebarCollapse">
    <i class="fas fa-bars"></i>
</div>

<!-- Sidebar -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar pt-3 bg-light" style="padding-left: 30px;">
    <!-- Close button within the sidebar -->
    <i id="closeSidebar" class="fas fa-times-circle"></i>
    <img src="../assets/img/logo.png" width="120" height="100" alt="" srcset="">
    <div class="position-sticky">
        <ul class="nav flex-column mt-5">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cogs"></i> Services
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Clients
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-plane"></i> Vols
                </a>
            </li>
        </ul>
        
    </div>
    <!-- <div class="row align-items-center btn btn-danger" style="position: absolute; bottom: 30px;"> -->
        
        <a href="/rihla/admin/deconnexion.php" class="nav-link text-white btn btn-danger" style="position: absolute; bottom: 30px; margin-right:15px;"><i class="fa fa-power-off text-white"></i>Déconnexion</a>
    <!-- </div> -->
</nav>

