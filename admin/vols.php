<?php
include "config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_vol'])) {
    // Récupérer les valeurs du formulaire
    $nom_vol = $conn->real_escape_string($_POST['nom_vol']);
    $compagnie = $conn->real_escape_string($_POST['compagnie']);
    $numero_vol = $conn->real_escape_string($_POST['numero_vol']);
    $origine = $conn->real_escape_string($_POST['origine']);
    $destination = $conn->real_escape_string($_POST['destination']);
    $depart = $conn->real_escape_string($_POST['depart']);
    $arrivee = $conn->real_escape_string($_POST['arrivee']);
    $duree = $conn->real_escape_string($_POST['duree']);
    $classe = $conn->real_escape_string($_POST['classe']);
    $tarif = $conn->real_escape_string($_POST['tarif']);
    $places_disponibles = $conn->real_escape_string($_POST['places_disponibles']);
    $statut = $conn->real_escape_string($_POST['statut']);

    // Créer la requête SQL
    $sql = "INSERT INTO vols (nom_vol, compagnie, numero_vol, origine, destination, depart, arrivee, duree, classe, tarif, places_disponibles, statut) VALUES ('$nom_vol', '$compagnie', '$numero_vol', '$origine', '$destination', '$depart', '$arrivee', '$duree', '$classe', '$tarif', '$places_disponibles', '$statut')";

    // Exécuter la requête
    // Après exécution de la requête d'ajout
    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Vol ajouté avec succès.";
    } else {
        $_SESSION['message'] = "Erreur : " . $conn->error;
    }
}
// Vérifiez si le formulaire de mise à jour a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" &&  isset($_POST['update_vol'])) {
    $id_vol = $conn->real_escape_string($_POST['id_vol']);
    $nom_vol = $conn->real_escape_string($_POST['nom_vol']);
    $compagnie = $conn->real_escape_string($_POST['compagnie']);
    $numero_vol = $conn->real_escape_string($_POST['numero_vol']);
    $origine = $conn->real_escape_string($_POST['origine']);
    $destination = $conn->real_escape_string($_POST['destination']);
    $depart = $conn->real_escape_string($_POST['depart']);
    $arrivee = $conn->real_escape_string($_POST['arrivee']);
    $duree = $conn->real_escape_string($_POST['duree']);
    $classe = $conn->real_escape_string($_POST['classe']);
    $tarif = $conn->real_escape_string($_POST['tarif']);
    $places_disponibles = $conn->real_escape_string($_POST['places_disponibles']);
    $statut = $conn->real_escape_string($_POST['statut']);

    // Mettez à jour la base de données
    $sql = "UPDATE vols SET nom_vol = '$nom_vol', compagnie = '$compagnie', numero_vol = '$numero_vol', origine = '$origine', destination = '$destination', depart = '$depart', arrivee = '$arrivee', duree = '$duree', classe = '$classe', tarif = '$tarif', places_disponibles = '$places_disponibles', statut = '$statut' WHERE id = '$id_vol'";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Vol mis à jour avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour : " . $conn->error;
    }
}
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM vols WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Vol supprimé avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression : " . $conn->error;
    }

    // header("location: votre_page.php"); // Rediriger vers la page après suppression
    // exit();
}
?>

<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main id="content" class="content active  ms-sm-auto  mt-5">
    <div class="row align-items-center justify-content-center">
        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button type="button" class="btn btn-warning text-white d-flex justify-content-center" data-toggle="modal" data-target="#ajoutModal">
            <i class="fa fa-plus"></i>
        </button>
        <h1 class="ml-4">Gestion des Vols</h1>

    </div>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <!-- Modal d'ajout -->
        <div class="modal fade" id="ajoutModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Ajouter un Vol</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire dans le modal -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Nom du Vol</label>
                                <input type="text" class="form-control" name="nom_vol">
                            </div>
                            <div class="form-group">
                                <label>Compagnie Aérienne</label>
                                <input type="text" class="form-control" name="compagnie">
                            </div>
                            <div class="form-group">
                                <label>Numéro de Vol</label>
                                <input type="text" class="form-control" name="numero_vol">
                            </div>
                            <div class="form-group">
                                <label>Origine</label>
                                <input type="text" class="form-control" name="origine">
                            </div>
                            <div class="form-group">
                                <label>Destination</label>
                                <input type="text" class="form-control" name="destination">
                            </div>
                            <div class="form-group">
                                <label>Date et Heure de Départ</label>
                                <input type="datetime-local" class="form-control" name="depart">
                            </div>
                            <div class="form-group">
                                <label>Date et Heure d'Arrivée</label>
                                <input type="datetime-local" class="form-control" name="arrivee">
                            </div>
                            <div class="form-group">
                                <label>Durée du Vol</label>
                                <input type="text" class="form-control" name="duree">
                            </div>
                            <div class="form-group">
                                <label>Classe</label>
                                <select class="form-control" name="classe">
                                    <option>Économique</option>
                                    <option>Affaires</option>
                                    <option>Première classe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tarif</label>
                                <input type="number" class="form-control" name="tarif">
                            </div>
                            <div class="form-group">
                                <label>Nombre de Places Disponibles</label>
                                <input type="number" class="form-control" name="places_disponibles">
                            </div>
                            <div class="form-group">
                                <label>Statut</label>
                                <select class="form-control" name="statut">
                                    <option>Planifié</option>
                                    <option>Retardé</option>
                                    <option>Annulé</option>
                                </select>
                            </div>
                            <button type="submit" name="add_vol" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal d'édition -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Éditer le Vol</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_vol" id="id_vol_edit">

                            <div class="form-group">
                                <label>Nom du Vol</label>
                                <input type="text" class="form-control" name="nom_vol" id="nom_vol_edit">
                            </div>

                            <div class="form-group">
                                <label>Compagnie Aérienne</label>
                                <input type="text" class="form-control" name="compagnie" id="compagnie_edit">
                            </div>

                            <div class="form-group">
                                <label>Numéro de Vol</label>
                                <input type="text" class="form-control" name="numero_vol" id="numero_vol_edit">
                            </div>

                            <div class="form-group">
                                <label>Origine</label>
                                <input type="text" class="form-control" name="origine" id="origine_edit">
                            </div>

                            <div class="form-group">
                                <label>Destination</label>
                                <input type="text" class="form-control" name="destination" id="destination_edit">
                            </div>

                            <div class="form-group">
                                <label>Date et Heure de Départ</label>
                                <input type="datetime-local" class="form-control" name="depart" id="depart_edit">
                            </div>

                            <div class="form-group">
                                <label>Date et Heure d'Arrivée</label>
                                <input type="datetime-local" class="form-control" name="arrivee" id="arrivee_edit">
                            </div>

                            <div class="form-group">
                                <label>Durée du Vol</label>
                                <input type="text" class="form-control" name="duree" id="duree_edit">
                            </div>

                            <div class="form-group">
                                <label>Classe</label>
                                <select class="form-control" name="classe" id="classe_edit">
                                    <option>Économique</option>
                                    <option>Affaires</option>
                                    <option>Première classe</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tarif</label>
                                <input type="number" class="form-control" name="tarif" id="tarif_edit">
                            </div>

                            <div class="form-group">
                                <label>Nombre de Places Disponibles</label>
                                <input type="number" class="form-control" name="places_disponibles" id="places_disponibles_edit">
                            </div>

                            <div class="form-group">
                                <label>Statut</label>
                                <select class="form-control" name="statut" id="statut_edit">
                                    <option>Planifié</option>
                                    <option>Retardé</option>
                                    <option>Annulé</option>
                                </select>
                            </div>

                            <button type="submit" name="update_vol" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau pour afficher la liste des vols -->
        <table class="table mt-4 table-bordered ml-2">
            <thead>
                <tr>
                    <th>Vol</th>
                    <th>Compagnie</th>
                    <th>Trajet</th>
                    <th>Horaires</th>
                    <th>Classe</th>
                    <th>Tarif</th>
                    <th>Places</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM vols";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["numero_vol"] . "<br><small>" . $row["nom_vol"] . "</small></td>";
                        echo "<td>" . $row["compagnie"] . "</td>";
                        echo "<td>" . $row["origine"] . " - " . $row["destination"] . "</td>";
                        echo "<td>Dep: " . date('d/m H:i', strtotime($row["depart"])) . "<br>Arr: " . date('d/m H:i', strtotime($row["arrivee"])) . "</td>";
                        echo "<td>" . $row["classe"] . "</td>";
                        echo "<td>" . $row["tarif"] . " DZD</td>";
                        echo "<td>" . $row["places_disponibles"] . "</td>";
                        echo "<td>" . $row["statut"] . "</td>";
                        echo "<td>"; ?>
                        <button class='btn btn-primary btn-sm editBtn' data-toggle='modal' data-target='#editModal' data-id="<?php echo $row['id']; ?>" data-nom_vol="<?php echo $row['nom_vol']; ?>" data-compagnie="<?php echo $row['compagnie']; ?>" data-numero_vol="<?php echo $row['numero_vol']; ?>" data-origine="<?php echo $row['origine']; ?>" data-destination="<?php echo $row['destination']; ?>" data-depart="<?php echo $row['depart']; ?>" data-arrivee="<?php echo $row['arrivee']; ?>" data-duree="<?php echo $row['duree']; ?>" data-classe="<?php echo $row['classe']; ?>" data-tarif="<?php echo $row['tarif']; ?>" data-places_disponibles="<?php echo $row['places_disponibles']; ?>" data-statut="<?php echo $row['statut']; ?>">
                            <i class='fas fa-edit'></i>
                        </button>
                        <a href='?delete=<?php echo $row['id'] ?>' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>
                <?php
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Aucun vol trouvé</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>


    </div>
</main>
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var modal = $('#editModal');
            var button = $(this); // Bouton qui a déclenché le modal

            modal.find('#id_vol_edit').val(button.data('id'));
            modal.find('#nom_vol_edit').val(button.data('nom_vol'));
            modal.find('#compagnie_edit').val(button.data('compagnie'));
            modal.find('#numero_vol_edit').val(button.data('numero_vol'));
            modal.find('#origine_edit').val(button.data('origine'));
            modal.find('#destination_edit').val(button.data('destination'));
            modal.find('#depart_edit').val(button.data('depart'));
            modal.find('#arrivee_edit').val(button.data('arrivee'));
            modal.find('#duree_edit').val(button.data('duree'));
            modal.find('#classe_edit').val(button.data('classe'));
            modal.find('#tarif_edit').val(button.data('tarif'));
            modal.find('#places_disponibles_edit').val(button.data('places_disponibles'));
            modal.find('#statut_edit').val(button.data('statut'));
        });
    });
</script>
<?php include "layouts/footer.php" ?>