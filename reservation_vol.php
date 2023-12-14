<?php
include "admin/config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}
$_SESSION["hotel_success"] = false;
$id_vol = $_GET['vol'];
$id_utilisateur = $_SESSION["user_id"];

// Vérifiez si un fichier a été téléchargé
if (isset($_FILES["proof"]) && $_FILES["proof"]["error"] == 0) {
    // Définissez le dossier de destination où le fichier sera sauvegardé
    $upload_dir = "uploads/";
    // Générez un nom de fichier unique
    $file_name = uniqid() . "_" . $_FILES["proof"]["name"];
    $target_path = $upload_dir . $file_name;

    // Déplacez le fichier téléchargé vers le dossier de destination
    if (move_uploaded_file($_FILES["proof"]["tmp_name"], $target_path)) {
        // Le fichier a été téléchargé avec succès, vous pouvez maintenant l'insérer dans la base de données
        $sql = "INSERT INTO demande_reservation_vol (id_utilisateur, id_vol, etat, preuve_reservation) VALUES (?, ?, 'en_attente', ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("iis", $id_utilisateur, $id_vol, $file_name);
            if ($stmt->execute()) {
                // La demande de réservation a été insérée avec succès
                $_SESSION["vol_success"] = true;
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
    } else {
        // Erreur lors de l'envoi du fichier
        echo "Erreur lors de l'envoi du fichier.";
    }
} else {
    // Aucun fichier n'a été téléchargé
    echo "Veuillez sélectionner un fichier de preuve de réservation.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page de Réservation</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Formulaire de Réservation</h2>
                <!-- Formulaire d'envoi de fichier -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="proof" class="form-label">Téléchargez votre preuve de réservation ou rdv Visa (PDF, JPG, PNG)</label>
                        <input type="file" class="form-control" name="proof" id="proof" accept=".pdf, .jpg, .png" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="upload">Uploader la preuve de réservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Inclure Bootstrap JS (facultatif, selon vos besoins) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
