<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php include "layouts/sidebar.php"; ?>