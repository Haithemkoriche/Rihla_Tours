<?php
include "../admin/config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$id_utilisateur = $_SESSION["user_id"];

// Requête pour récupérer les réservations avec les détails de l'utilisateur
$sql = "SELECT d.nom_destination AS nom_destination , r.id,r.reservation_date, u.nom AS nom_client, u.email AS email_client, u.telephone AS telephone_client, r.destination_id, r.etat
                    FROM reservations r
                    INNER JOIN utilisateurs u ON r.user_id = u.id
                    INNER JOIN destinations d ON r.destination_id = d.id";
$result = $conn->query($sql);
if (!$result) {
    echo "Erreur d'exécution de la requête : " . $conn->error;
    exit();
}

// Vérifiez si l'ID de réservation a été transmis via la requête AJAX
if (isset($_GET["annuler"])) {
    $annuler = $_GET["annuler"];
    $updateSql = "UPDATE reservations SET etat = 'annule' WHERE id = ?";

    $stmt = $conn->prepare($updateSql);
    if ($stmt) {
        $stmt->bind_param("i", $annuler);
        if ($stmt->execute()) {
            // La mise à jour de l'état a réussi
            header("location: mes_destination.php");
            exit();
        } else {
            // Erreur lors de la mise à jour de l'état
            echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour de l'état"]);
        }
    } else {
        // Erreur de préparation de la requête
        echo json_encode(["success" => false, "message" => "Erreur de préparation de la requête"]);
    }
    exit(); // Assurez-vous de sortir du script après la réponse AJAX
}

if (isset($_GET["reserver"])) {
    $reserver = $_GET["reserver"];
    $updateSql = "UPDATE reservations SET etat = 'en_attente' WHERE id = ?";

    $stmt = $conn->prepare($updateSql);
    if ($stmt) {
        $stmt->bind_param("i", $reserver);
        if ($stmt->execute()) {
            // La mise à jour de l'état a réussi
            header("location: mes_destination.php");
            exit();
        } else {
            // Erreur lors de la mise à jour de l'état
            echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour de l'état"]);
        }
    } else {
        // Erreur de préparation de la requête
        echo json_encode(["success" => false, "message" => "Erreur de préparation de la requête"]);
    }
    exit(); // Assurez-vous de sortir du script après la réponse AJAX
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations de Vols</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <style>
        /* Style pour les lignes réservables */
        .reservable {
            background-color: #ccc;
        }
    </style>
</head>

<body>
      <!-- start navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="/rihla/assets/img/logo.png" height="78" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/rihla/client/">Accueil</a>
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
    <div class="container mt-5">
        <h2 class="text-center">Mes Réservations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom du Destination</th>
                    <th scope="col">Date de Réservation</th>
                    <th scope="col">État</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr";
                    // Calcul de la différence de temps en heures (86400 secondes dans une journée)
                    $dateReservation = strtotime($row["reservation_date"]);
                    $maintenant = time();
                    $differenceHeures = ($dateReservation - $maintenant) / 3600;
                    if ($differenceHeures >= 48) {
                        // Si la réservation peut être annulée, ajoutez la classe CSS "reservable"
                        echo " class='reservable'";
                        echo ">";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["nom_destination"] . "</td>";
                        echo "<td>" . $row["reservation_date"] . "</td>";
                        echo "<td>" . $row["etat"] . "</td>";
                        echo "<td><a class='btn btn-danger' href='?annuler=" . $row["id"] . "''>Annuler </a>";
                        // Ajoutez un bouton "Réserver à nouveau"
                        echo "<a class='btn btn-primary ms-3' href='?reserver=" . $row["id"] . "''> Réserver à nouveau</a></td>";
                    } else {
                        // Si la réservation ne peut pas être annulée
                        echo ">";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["nom_destination"] . "</td>";
                        echo "<td>" . $row["reservation_date"] . "</td>";
                        echo "<td>" . $row["etat"] . "</td>";
                        // Affichez un message indiquant que la réservation ne peut pas être annulée
                        echo "<td>Réservation non annulable</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclure Bootstrap JS (facultatif, selon vos besoins) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
