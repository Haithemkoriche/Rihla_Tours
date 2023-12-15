<?php
include "config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && isset($_POST["id_demande"])) {
        $action = $_POST["action"];
        $id_demande = $_POST["id_demande"];

        // Vérifiez quelle action a été sélectionnée
        switch ($action) {
            case "en_attente":
                // Mettez à jour l'état de la demande à "En Attente" dans la base de données
                $sql = "UPDATE demande_reservation_hotel SET etat = 'en_attente' WHERE id_demande = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_demande);
                break;

            case "traite":
                // Mettez à jour l'état de la demande à "Traité" dans la base de données
                $sql = "UPDATE demande_reservation_hotel SET etat = 'traite' WHERE id_demande = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_demande);
                break;

            case "annule":
                // Mettez à jour l'état de la demande à "Annulé" dans la base de données
                $sql = "UPDATE demande_reservation_hotel SET etat = 'annule' WHERE id_demande = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_demande);
                break;

            default:
                // Action non reconnue
                echo "Action non reconnue.";
                exit();
        }

        // Exécutez la mise à jour dans la base de données
        if ($stmt->execute()) {
            $_SESSION['message'] = "L'état de la demande a été mis à jour avec succès.";
        } else {
            $_SESSION['message'] = "Erreur lors de la mise à jour de l'état de la demande.";
        }

        // Redirigez l'utilisateur vers la page précédente
        header("location: reservations.php");
        exit();
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "Méthode de requête incorrecte.";
}
?>