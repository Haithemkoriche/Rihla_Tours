<?php
include "config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php
// Fonction pour supprimer un client
function supprimerClient($conn, $id_client)
{
    $sql = "DELETE FROM utilisateurs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id_client);
        if ($stmt->execute()) {
            // La suppression du client a réussi
            return true;
        } else {
            // Erreur lors de la suppression du client
            return false;
        }
    } else {
        // Erreur de préparation de la requête
        return false;
    }
}

// Vérifiez si une demande de suppression de client a été soumise
if (isset($_GET["supprimer"])) {
    $id_client_a_supprimer = $_GET["supprimer"];
    if (supprimerClient($conn, $id_client_a_supprimer)) {
        // La suppression du client a réussi
        header("location: clients.php");
        exit();
    } else {
        // Erreur lors de la suppression du client
        echo "Erreur lors de la suppression du client.";
    }
}

// Récupérez la liste de tous les clients depuis la base de données
$sql = "SELECT * FROM utilisateurs";
$result = $conn->query($sql);
if (!$result) {
    echo "Erreur d'exécution de la requête : " . $conn->error;
    exit();
}
?>
<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main class="content  ms-sm-auto  mt-5 " style="margin-left: 350px;">
    
    <h1 class="ml-4">Gestion des clients</h1>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <table class="table mt-4 table-bordered ml-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Adresse Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . $row["id"] . "</th>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["prenom"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a class='btn btn-danger' href='clients.php?supprimer=" . $row["id"] . "'>Supprimer</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</main>
<?php include "layouts/footer.php" ?>