<?php
include "../admin/config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$id_utilisateur = $_SESSION["user_id"];

// Récupérez toutes les réservations d'hôtel de l'utilisateur
$sql = "SELECT
demande_reservation_hotel.id_demande AS ID,
utilisateurs.nom AS Nom_Utilisateur,
hotels.nom_hotel AS Nom_Hôtel,
demande_reservation_hotel.billet_vol AS Billet_Vol,
demande_reservation_hotel.date_reservation AS Date_Réservation,
demande_reservation_hotel.etat AS État
FROM
demande_reservation_hotel
INNER JOIN
utilisateurs ON demande_reservation_hotel.id_utilisateur = utilisateurs.id
INNER JOIN
hotels ON demande_reservation_hotel.id_hotel = hotels.id;
";
$result = $conn->query($sql);
if (!$result) {
    echo "Erreur d'exécution de la requête : " . $conn->error;
    exit();
}
// Vérifiez si l'ID de réservation a été transmis via la requête AJAX
if (isset($_GET["annuler"])) {
    $annuler = $_GET["annuler"];
    $updateSql = "UPDATE demande_reservation_hotel SET etat = 'annule' WHERE id_demande = ?";

    $stmt = $conn->prepare($updateSql);
    if ($stmt) {
        $stmt->bind_param("i", $annuler);
        if ($stmt->execute()) {
            // La mise à jour de l'état a réussi
            header("location: mes_hotel.php");
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
    $updateSql = "UPDATE demande_reservation_hotel SET etat = 'en_attente' WHERE id_demande = ?";

    $stmt = $conn->prepare($updateSql);
    if ($stmt) {
        $stmt->bind_param("i", $reserver);
        if ($stmt->execute()) {
            // La mise à jour de l'état a réussi
            header("location: mes_hotel.php");
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
    <title>Mes Réservations d'Hôtel</title>
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
        <h2 class="text-center">Mes Réservations d'Hôtel</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom de l'Hôtel</th>
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
                    $dateReservation = strtotime($row["Date_Réservation"]);
                    $maintenant = time();
                    $differenceHeures = ($dateReservation - $maintenant) / 3600;
                    if ($differenceHeures >= 48) {
                        // Si la réservation peut être annulée, ajoutez la classe CSS "reservable"
                        echo " class='reservable'";
                        echo ">";
                        echo "<th scope='row'>" . $row["ID"] . "</th>";
                        echo "<td>" . $row["Nom_Hôtel"] . "</td>";
                        echo "<td>" . $row["Date_Réservation"] . "</td>";
                        echo "<td>" . $row["État"] . "</td>";
                        echo "<td><a class='btn btn-danger' href='?annuler=" . $row["ID"] . "''>Annuler </a>";
                        // Ajoutez un bouton "Réserver à nouveau"
                        echo "<a class='btn btn-primary ms-3' href='?reserver=" . $row["ID"] . "''> Réserver à nouveau</a></td>";
                    } else {
                        // Si la réservation ne peut pas être annulée
                        echo ">";
                        echo "<th scope='row'>" . $row["ID"] . "</th>";
                        echo "<td>" . $row["Nom_Hôtel"] . "</td>";
                        echo "<td>" . $row["Date_Réservation"] . "</td>";
                        echo "<td>" . $row["État"] . "</td>";
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