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
    
</main>
<?php include "layouts/footer.php" ?>
