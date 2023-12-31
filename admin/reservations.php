<?php
include "config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}

// Requête pour récupérer les demandes de réservation d'hôtels avec les détails du client
$sqlHotel = "SELECT drh.id_demande, u.nom AS nom_client, u.email AS email_client, u.telephone AS telephone_client, h.nom_hotel, drh.billet_vol, drh.date_reservation, drh.etat
             FROM demande_reservation_hotel drh
             INNER JOIN utilisateurs u ON drh.id_utilisateur = u.id
             INNER JOIN hotels h ON drh.id_hotel = h.id";
$resultHotel = $conn->query($sqlHotel);

// Requête pour récupérer les demandes de réservation de vols avec les détails du client
$sqlVol = "SELECT drv.id_demande, u.nom AS nom_client, u.email AS email_client, u.telephone AS telephone_client, v.nom_vol, drv.preuve_reservation, drv.date_reservation, drv.etat
           FROM demande_reservation_vol drv
           INNER JOIN utilisateurs u ON drv.id_utilisateur = u.id
           INNER JOIN vols v ON drv.id_vol = v.id";
$resultVol = $conn->query($sqlVol);

// Requête pour récupérer les réservations avec les détails de l'utilisateur
$sqlReservations = "SELECT d.nom_destination AS nom_destination , r.id,r.reservation_date, u.nom AS nom_client, u.email AS email_client, u.telephone AS telephone_client, r.destination_id, r.etat
                    FROM reservations r
                    INNER JOIN utilisateurs u ON r.user_id = u.id
                    INNER JOIN destinations d ON r.destination_id = d.id";
$resultReservations = $conn->query($sqlReservations);
?>

<?php include "layouts/sidebar.php"; ?>

<!-- Content -->
<main id="content" class="content active ms-sm-auto mt-5">
    <div class="row align-items-center justify-content-center">
        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button type="button" class="btn btn-warning text-white d-flex justify-content-center" data-toggle="modal" data-target="#ajoutModal">
            <i class="fa fa-plus"></i>
        </button>
        <h1 class="ml-4">Gestion des Réservations</h1>
    </div>
    
    <div class="container-fluid">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <table class="table mt-4 table-bordered ml-2">
            <tr>
                <th>ID Demande</th>
                <th>Nom Client</th>
                <th>Email Client</th>
                <th>Téléphone Client</th>
                <th>Nom de l'Hôtel ou du Vol</th>
                <th>Billet/Preuve</th>
                <th>Date de Réservation</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
            <?php
            // Affichage des demandes de réservation d'hôtels
            while ($rowHotel = $resultHotel->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowHotel["id_demande"] . "</td>";
                echo "<td>" . $rowHotel["nom_client"] . "</td>";
                echo "<td>" . $rowHotel["email_client"] . "</td>";
                echo "<td>" . $rowHotel["telephone_client"] . "</td>";
                echo "<td>" . $rowHotel["nom_hotel"] . "</td>";
                echo "<td>";
                if (!empty($rowHotel["billet_vol"])) {
                    echo '<a href="' . $rowHotel["billet_vol"] . '" download>Télécharger</a>';
                } else {
                    echo "Aucun billet/preuve disponible";
                }
                echo "</td>";
                echo "<td>" . $rowHotel["date_reservation"] . "</td>";
                echo "<td>" . $rowHotel["etat"] . "</td>";
                echo "<td>";
                echo "<form action='traitement_hotel.php' method='POST'>";
                echo "<input type='hidden' name='id_demande' value='" . $rowHotel["id_demande"] . "'>";
                echo "<button type='submit' name='action' class='btn btn-secondary' value='en_attente'><i class='fas fa-clock'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-success' value='traite'><i class='fas fa-check'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-danger' value='annule'><i class='fas fa-times'></i></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            // Affichage des demandes de réservation de vols
            while ($rowVol = $resultVol->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowVol["id_demande"] . "</td>";
                echo "<td>" . $rowVol["nom_client"] . "</td>";
                echo "<td>" . $rowVol["email_client"] . "</td>";
                echo "<td>" . $rowVol["telephone_client"] . "</td>";
                echo "<td>" . $rowVol["nom_vol"] . "</td>";
                echo "<td>";
                if (!empty($rowVol["preuve_reservation"])) {
                    echo '<a href="/rihla/uploads/' . $rowVol["preuve_reservation"] . '" download>Télécharger</a>';
                } else {
                    echo "Aucun billet/preuve disponible";
                }
                echo "</td>";
                echo "<td>" . $rowVol["date_reservation"] . "</td>";
                echo "<td>" . $rowVol["etat"] . "</td>";
                echo "<td>";
                echo "<form action='traitement_vol.php' method='POST'>";
                echo "<input type='hidden' name='id_demande' value='" . $rowVol["id_demande"] . "'>";
                echo "<button type='submit' name='action' class='btn btn-secondary' value='en_attente'><i class='fas fa-clock'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-success' value='traite'><i class='fas fa-check'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-danger' value='annule'><i class='fas fa-times'></i></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }

            // Affichage des réservations
            while ($rowReservation = $resultReservations->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowReservation["id"] . "</td>";
                echo "<td>" . $rowReservation["nom_client"] . "</td>";
                echo "<td>" . $rowReservation["email_client"] . "</td>";
                echo "<td>" . $rowReservation["telephone_client"] . "</td>";
                echo "<td>" . $rowReservation["nom_destination"] . "</td>";
                echo "<td></td>"; // Vous pouvez personnaliser cette colonne si nécessaire
                echo "<td>" . $rowReservation["reservation_date"] . "</td>"; // Vous pouvez personnaliser cette colonne si nécessaire
                echo "<td>" . $rowReservation["etat"] . "</td>";
                echo "<td>"; // Actions pour les réservations
                echo "<form action='traitement_reservation.php' method='POST'>";
                echo "<input type='hidden' name='id_demande' value='" .$rowReservation["id"]. "'>";
                echo "<button type='submit' name='action' class='btn btn-secondary' value='en_attente'><i class='fas fa-clock'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-success' value='traite'><i class='fas fa-check'></i></button>";
                echo "<button type='submit' name='action' class='btn btn-danger' value='annule'><i class='fas fa-times'></i></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</main>
<?php include "layouts/footer.php" ?>
