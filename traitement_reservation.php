<?php
session_start();
include 'admin/config.php'; // Assurez-vous d'inclure le fichier de configuration de la base de données

if (isset($_SESSION['user_id'])) {
    // L'utilisateur est connecté, nous pouvons procéder à l'insertion dans la base de données

    // Récupérez l'ID de l'utilisateur depuis la session
    $userId = $_SESSION['user_id'];
    // Récupérez l'ID de la destination depuis la requête GET
    $destinationId = $_GET['id'];

    // Requête SQL pour insérer la réservation dans la table 'reservations'
    $insertQuery = "INSERT INTO reservations (user_id, destination_id, etat) VALUES ($userId, $destinationId, 'en_attente')";

    if ($conn->query($insertQuery) === TRUE) {
        // La réservation a été insérée avec succès
        $_SESSION['reservation_success'] = true;
        // Redirigez l'utilisateur vers une page de confirmation de réservation
        header("Location: index.php");
        exit;
    } else {
        // Erreur lors de l'insertion dans la base de données
        echo "Erreur lors de la réservation : " . $conn->error;
    }
} else {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit;
}
?>
