<?php
include "admin/config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}
$_SESSION["vol_success"] = false;
$id_hotel = $_GET['hotel'];
$id_utilisateur = $_SESSION["user_id"];
// Remplacez les placeholders par les valeurs réelles
$sql = "INSERT INTO demande_reservation_hotel (id_utilisateur, id_hotel, etat) VALUES (?, ?, 'en_attente')";
// Utilisez une requête préparée pour éviter les injections SQL
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("ii", $id_utilisateur, $id_hotel);
    if ($stmt->execute()) {
        // La demande de réservation a été insérée avec succès
        $_SESSION["hotel_success"] = true;
        header("location: index.php");
        exit();
    } else {
        // Erreur lors de l'insertion de la demande de réservation
        echo "Erreur lors de la demande de réservation : " . $stmt->error;
    }

    $stmt->close();
} else {
    // Erreur de préparation de la requête
    echo "Erreur de préparation de la requête : " . $conn->error;
}
