<?php
include "config.php"; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php
// Traitement du formulaire d'ajout d'hôtel
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_hotel'])) {
    $nom_hotel = $conn->real_escape_string($_POST['nom_hotel']);
    $emplacement = $conn->real_escape_string($_POST['emplacement']);
    $etoiles = $conn->real_escape_string($_POST['etoiles']);
    $type_chambre = $conn->real_escape_string($_POST['type_chambre']);
    $nombre_chambres_dispo = $conn->real_escape_string($_POST['nombre_chambres_dispo']);
    $tarif_nuit = $conn->real_escape_string($_POST['tarif_nuit']);
    $description = $conn->real_escape_string($_POST['description']);
    $equipements = $conn->real_escape_string($_POST['equipements']);
    $politique_annulation = $conn->real_escape_string($_POST['politique_annulation']);
    $options_restauration = $conn->real_escape_string($_POST['options_restauration']);
    // Traitez les champs supplémentaires si nécessaire

    $sql = "INSERT INTO hotels (nom_hotel, emplacement, etoiles, type_chambre, nombre_chambres_dispo, tarif_nuit, description, equipements, politique_annulation, options_restauration) VALUES ('$nom_hotel', '$emplacement', '$etoiles', '$type_chambre', '$nombre_chambres_dispo', '$tarif_nuit', '$description', '$equipements', '$politique_annulation', '$options_restauration')";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Hôtel ajouté avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de l'hôtel : " . $conn->error;
    }
}

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_hotel'])) {
    $id_hotel = $conn->real_escape_string($_POST['id_hotel']);
    $nom_hotel = $conn->real_escape_string($_POST['nom_hotel']);
    $emplacement = $conn->real_escape_string($_POST['emplacement']);
    $etoiles = $conn->real_escape_string($_POST['etoiles']);
    $type_chambre = $conn->real_escape_string($_POST['type_chambre']);
    $nombre_chambres_dispo = $conn->real_escape_string($_POST['nombre_chambres_dispo']);
    $tarif_nuit = $conn->real_escape_string($_POST['tarif_nuit']);
    $description = $conn->real_escape_string($_POST['description']);
    $equipements = $conn->real_escape_string($_POST['equipements']);
    $politique_annulation = $conn->real_escape_string($_POST['politique_annulation']);
    $options_restauration = $conn->real_escape_string($_POST['options_restauration']);
    // Inclure d'autres champs si nécessaire

    $sql = "UPDATE hotels SET nom_hotel = '$nom_hotel', emplacement = '$emplacement', etoiles = '$etoiles', type_chambre = '$type_chambre', nombre_chambres_dispo = '$nombre_chambres_dispo', tarif_nuit = '$tarif_nuit', description = '$description', equipements = '$equipements', politique_annulation = '$politique_annulation', options_restauration = '$options_restauration' WHERE id = '$id_hotel'";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Hôtel mis à jour avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour : " . $conn->error;
    }
}


// Traitement de la suppression
if (isset($_GET['delete'])) {
    $id = $conn->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM hotels WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Hôtel supprimé avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression : " . $conn->error;
    }
}
?>

<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main class="content  ms-sm-auto  mt-5">
    <div class="row align-items-center justify-content-center">
        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button type="button" class="btn btn-warning text-white d-flex justify-content-center" data-toggle="modal" data-target="#ajoutHotelModal">
            <i class="fa fa-plus"></i>
        </button>
        <h1 class="ml-4">Gestion des Hotels</h1>

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
        <!-- Modal d'ajout d'un hôtel -->
        <div class="modal fade" id="ajoutHotelModal" tabindex="-1" aria-labelledby="ajoutHotelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajoutHotelModalLabel">Ajouter un Hôtel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Nom de l'Hôtel</label>
                                <input type="text" class="form-control" name="nom_hotel">
                            </div>
                            <div class="form-group">
                                <label>Emplacement</label>
                                <input type="text" class="form-control" name="emplacement">
                            </div>
                            <div class="form-group">
                                <label>Étoiles</label>
                                <input type="number" class="form-control" name="etoiles">
                            </div>
                            <div class="form-group">
                                <label>Type de Chambre</label>
                                <input type="text" class="form-control" name="type_chambre">
                            </div>
                            <div class="form-group">
                                <label>Nombre de Chambres Disponibles</label>
                                <input type="number" class="form-control" name="nombre_chambres_dispo">
                            </div>
                            <div class="form-group">
                                <label>Tarif par Nuit</label>
                                <input type="number" class="form-control" name="tarif_nuit">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Équipements</label>
                                <input type="text" class="form-control" name="equipements">
                            </div>
                            <div class="form-group">
                                <label>Politique d'Annulation</label>
                                <input type="text" class="form-control" name="politique_annulation">
                            </div>
                            <div class="form-group">
                                <label>Options de Restauration</label>
                                <input type="text" class="form-control" name="options_restauration">
                            </div>
                            <button type="submit" name="add_hotel" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal d'édition pour un hôtel -->
        <div class="modal fade" id="editHotelModal" tabindex="-1" aria-labelledby="editHotelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editHotelModalLabel">Éditer un Hôtel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_hotel" id="id_hotel_edit">

                            <div class="form-group">
                                <label>Nom de l'Hôtel</label>
                                <input type="text" class="form-control" name="nom_hotel" id="nom_hotel_edit">
                            </div>
                            <div class="form-group">
                                <label>Emplacement</label>
                                <input type="text" class="form-control" name="emplacement" id="emplacement_edit">
                            </div>
                            <div class="form-group">
                                <label>Étoiles</label>
                                <input type="number" class="form-control" name="etoiles" id="etoiles_edit">
                            </div>
                            <div class="form-group">
                                <label>Type de Chambre</label>
                                <input type="text" class="form-control" name="type_chambre" id="type_chambre_edit">
                            </div>
                            <div class="form-group">
                                <label>Nombre de Chambres Disponibles</label>
                                <input type="number" class="form-control" name="nombre_chambres_dispo" id="nombre_chambres_dispo_edit">
                            </div>
                            <div class="form-group">
                                <label>Tarif par Nuit</label>
                                <input type="number" class="form-control" name="tarif_nuit" id="tarif_nuit_edit">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description_edit"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Équipements</label>
                                <input type="text" class="form-control" name="equipements" id="equipements_edit">
                            </div>
                            <div class="form-group">
                                <label>Politique d'Annulation</label>
                                <input type="text" class="form-control" name="politique_annulation" id="politique_annulation_edit">
                            </div>
                            <div class="form-group">
                                <label>Options de Restauration</label>
                                <input type="text" class="form-control" name="options_restauration" id="options_restauration_edit">
                            </div>

                            <button type="submit" name="update_hotel" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hôtel</th>
                    <th>Emplacement</th>
                    <th>Étoiles</th>
                    <th>Chambre</th>
                    <th>Nb</th>
                    <th>TPN</th>
                    <th>Description</th>
                    <th>Équipements</th>
                    <th>Annulation</th>
                    <th>Restauration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM hotels";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nom_hotel"] . "</td>";
                        echo "<td>" . $row["emplacement"] . "</td>";
                        echo "<td>" . $row["etoiles"] . "</td>";
                        echo "<td>" . $row["type_chambre"] . "</td>";
                        echo "<td>" . $row["nombre_chambres_dispo"] . "</td>";
                        echo "<td>" . $row["tarif_nuit"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["equipements"] . "</td>";
                        echo "<td>" . $row["politique_annulation"] . "</td>";
                        echo "<td>" . $row["options_restauration"] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-primary btn-sm editBtn' data-toggle='modal' data-target='#editHotelModal' 
                        data-id='" . $row['id'] . "' 
                        data-nom_hotel='" . htmlspecialchars($row['nom_hotel'], ENT_QUOTES) . "' 
                        data-emplacement='" . htmlspecialchars($row['emplacement'], ENT_QUOTES) . "' 
                        data-etoiles='" . $row['etoiles'] . "' 
                        data-type_chambre='" . htmlspecialchars($row['type_chambre'], ENT_QUOTES) . "' 
                        data-nombre_chambres_dispo='" . $row['nombre_chambres_dispo'] . "' 
                        data-tarif_nuit='" . $row['tarif_nuit'] . "' 
                        data-description='" . htmlspecialchars($row['description'], ENT_QUOTES) . "' 
                        data-equipements='" . htmlspecialchars($row['equipements'], ENT_QUOTES) . "' 
                        data-politique_annulation='" . htmlspecialchars($row['politique_annulation'], ENT_QUOTES) . "' 
                        data-options_restauration='" . htmlspecialchars($row['options_restauration'], ENT_QUOTES) . "'><i class='fas fa-edit'></i>
                        </button>";
                        echo "<a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</main>
<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var modal = $('#editHotelModal');
            var button = $(this);

            modal.find('#id_hotel_edit').val(button.data('id'));
            modal.find('#nom_hotel_edit').val(button.data('nom_hotel'));
            modal.find('#emplacement_edit').val(button.data('emplacement'));
            modal.find('#etoiles_edit').val(button.data('etoiles'));
            modal.find('#type_chambre_edit').val(button.data('type_chambre'));
            modal.find('#nombre_chambres_dispo_edit').val(button.data('nombre_chambres_dispo'));
            modal.find('#tarif_nuit_edit').val(button.data('tarif_nuit'));
            modal.find('#description_edit').val(button.data('description'));
            modal.find('#equipements_edit').val(button.data('equipements'));
            modal.find('#politique_annulation_edit').val(button.data('politique_annulation'));
            modal.find('#options_restauration_edit').val(button.data('options_restauration'));
        });
    });
</script>

<?php include "layouts/footer.php" ?>