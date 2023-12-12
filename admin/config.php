<?php 
// Connexion à la base de données (modifier les informations de connexion)
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "rihla_tours";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}