<?php
include "config.php"; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.php");
    exit();
}
?>
<?php
// Traitement du formulaire d'ajout de destination
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_destination'])) {
    $nom_destination = $conn->real_escape_string($_POST['nom_destination']);
    $description = $conn->real_escape_string($_POST['description']);
    $pays_region = $conn->real_escape_string($_POST['pays_region']);
    $type_destination = $conn->real_escape_string($_POST['type_destination']);
    $attractions_principales = $conn->real_escape_string($_POST['attractions_principales']);
    $meilleure_saison = $conn->real_escape_string($_POST['meilleure_saison']);
    $cout_moyen = $conn->real_escape_string($_POST['cout_moyen']);
    $equipements = $conn->real_escape_string($_POST['equipements']);
    $recommandations_securite = $conn->real_escape_string($_POST['recommandations_securite']);
    // $photos = $conn->real_escape_string($_POST['photos']);
    $avis_voyageurs = $conn->real_escape_string($_POST['avis_voyageurs']);
    $offres_speciales = $conn->real_escape_string($_POST['offres_speciales']);
    $accessibilite = $conn->real_escape_string($_POST['accessibilite']);
    $restrictions_conditions = $conn->real_escape_string($_POST['restrictions_conditions']);

    if (isset($_FILES['photos'])) {
        $photoName = $_FILES['photos']['name'];
        $photoTmpName = $_FILES['photos']['tmp_name'];
        $photoSize = $_FILES['photos']['size'];
        $photoError = $_FILES['photos']['error'];

        // Extraction de l'extension du fichier
        $photoExt = explode('.', $photoName);
        $photoActualExt = strtolower(end($photoExt));

        // Extensions autorisées
        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($photoActualExt, $allowed)) {
            if ($photoError === 0) {
                if ($photoSize < 1000000) { // Limite de taille du fichier
                    $photoNameNew = uniqid('', true) . "." . $photoActualExt;
                    $photoDestination = 'uploads/' . $photoNameNew;
                    move_uploaded_file($photoTmpName, $photoDestination);
                } else {
                    echo "Votre fichier est trop volumineux.";
                }
            } else {
                echo "Erreur lors du téléchargement de votre fichier.";
            }
        } else {
            echo "Vous ne pouvez pas télécharger des fichiers de ce type.";
        }
    }

    $sql = "INSERT INTO destinations (nom_destination, description, pays_region, type_destination, attractions_principales, meilleure_saison, cout_moyen, equipements, recommandations_securite, photos, avis_voyageurs, offres_speciales, accessibilite, restrictions_conditions) VALUES ('$nom_destination', '$description', '$pays_region', '$type_destination', '$attractions_principales', '$meilleure_saison', '$cout_moyen', '$equipements', '$recommandations_securite', '$photoDestination', '$avis_voyageurs', '$offres_speciales', '$accessibilite', '$restrictions_conditions')";

    if ($conn->query($sql) === true) {
        header("Location: destinations.php");
        exit();

        $_SESSION['message'] = "Destination ajoutée avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout de la destination : " . $conn->error;
    }
}

// Traitement du formulaire de mise à jour de destination
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_destination'])) {
    $id_destination = $conn->real_escape_string($_POST['id_destination']);
    $nom_destination = $conn->real_escape_string($_POST['nom_destination']);
    $description = $conn->real_escape_string($_POST['description']);
    $pays_region = $conn->real_escape_string($_POST['pays_region']);
    $type_destination = $conn->real_escape_string($_POST['type_destination']);
    $attractions_principales = $conn->real_escape_string($_POST['attractions_principales']);
    $meilleure_saison = $conn->real_escape_string($_POST['meilleure_saison']);
    $cout_moyen = $conn->real_escape_string($_POST['cout_moyen']);
    $equipements = $conn->real_escape_string($_POST['equipements']);
    $recommandations_securite = $conn->real_escape_string($_POST['recommandations_securite']);
    $avis_voyageurs = $conn->real_escape_string($_POST['avis_voyageurs']);
    $offres_speciales = $conn->real_escape_string($_POST['offres_speciales']);
    $accessibilite = $conn->real_escape_string($_POST['accessibilite']);
    $restrictions_conditions = $conn->real_escape_string($_POST['restrictions_conditions']);
    $restrictions_conditions = $conn->real_escape_string($_POST['restrictions_conditions']);
    // Initialisation de la variable pour stocker le nom du fichier
    // Vérification et traitement de l'upload de la photo
    if (isset($_FILES['photos']) && $_FILES['photos']['error'] == 0) {
        $photo = $_FILES['photos'];

        // Extensions autorisées
        $allowedExt = array('jpg', 'jpeg', 'png', 'gif');

        // Extraction de l'extension du fichier
        $fileExt = pathinfo($photo['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($fileExt), $allowedExt)) {
            // Vérification de la taille du fichier (ex: 5MB maximum)
            if ($photo['size'] < 5000000) {
                $photoFileName = uniqid('photo_', true) . '.' . $fileExt;
                $photoDestination = 'uploads/' . $photoFileName;

                // Déplacer le fichier uploadé vers le dossier 'uploads'
                if (!move_uploaded_file($photo['tmp_name'], $photoDestination)) {
                    die("Erreur lors de l'upload de la photo.");
                }
            } else {
                die("Fichier trop volumineux.");
            }
        } else {
            die("Type de fichier non autorisé.");
        }
    }

    // Création de la requête SQL pour la mise à jour
    $sql = "UPDATE destinations SET 
   nom_destination = '$nom_destination', 
   description = '$description', 
   pays_region = '$pays_region', 
   type_destination = '$type_destination', 
   attractions_principales = '$attractions_principales', 
   meilleure_saison = '$meilleure_saison', 
   cout_moyen = '$cout_moyen', 
   equipements = '$equipements', 
   recommandations_securite = '$recommandations_securite', 
   avis_voyageurs = '$avis_voyageurs', 
   offres_speciales = '$offres_speciales', 
   accessibilite = '$accessibilite', 
   restrictions_conditions = '$restrictions_conditions'";

    // Inclure la photo dans la mise à jour si elle a été uploadée
    if (!empty($photoFileName)) {
        $sql .= ", photos = '$photoFileName'";
    }

    $sql .= " WHERE id = '$id_destination'";

    // Exécuter la requête
    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Destination mise à jour avec succès.";
        header("Location: destinations.php");
        exit();
    } else {
        $_SESSION['message'] = "Erreur lors de la mise à jour de la destination : " . $conn->error;
    }
}

// Traitement de la suppression de destination
if (isset($_GET['delete_destination'])) {
    $id = $conn->real_escape_string($_GET['delete_destination']);
    $sql = "DELETE FROM destinations WHERE id = '$id'";

    if ($conn->query($sql) === true) {
        $_SESSION['message'] = "Destination supprimée avec succès.";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression de la destination : " . $conn->error;
    }
}
?>
<?php include "layouts/sidebar.php"; ?>
<!-- Content -->
<main class="content  ms-sm-auto  mt-5">
    <div class="row align-items-center justify-content-center">
        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button type="button" class="btn btn-warning text-white d-flex justify-content-center" data-toggle="modal" data-target="#ajoutDestinationModal">
            <i class="fa fa-plus"></i>
        </button>
        <h1 class="ml-4">Gestion des Destinations</h1>

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




        <!-- Modal pour ajouter une nouvelle destination -->
        <div class="modal fade" id="ajoutDestinationModal" tabindex="-1" aria-labelledby="ajoutDestinationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajoutDestinationModalLabel">Ajouter une Nouvelle Destination</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="destinations.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nom_destination">Nom de la Destination</label>
                                <input type="text" class="form-control" id="nom_destination" name="nom_destination" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pays_region">Pays/Région</label>
                                <input type="text" class="form-control" id="pays_region" name="pays_region">
                            </div>
                            <div class="form-group">
                                <label for="type_destination_edit">Type de Destination</label>
                                <select class="form-control" name="type_destination" id="type_destination_edit">
                                    <option value="plage">Plage</option>
                                    <option value="montagne">Montagne</option>
                                    <option value="urbain">Urbain</option>
                                    <option value="rural">Rural</option>
                                    <option value="aventure">Aventure</option>
                                    <!-- Ajoutez d'autres options ici si nécessaire -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="attractions_principales">Attractions Principales</label>
                                <input type="text" class="form-control" id="attractions_principales" name="attractions_principales">
                            </div>
                            <div class="form-group">
                                <label for="meilleure_saison">Meilleure Saison pour Visiter</label>
                                <input type="text" class="form-control" id="meilleure_saison" name="meilleure_saison">
                            </div>
                            <div class="form-group">
                                <label for="cout_moyen">Coût Moyen du Séjour</label>
                                <input type="number" class="form-control" id="cout_moyen" name="cout_moyen">
                            </div>
                            <div class="form-group">
                                <label for="equipements">Équipements Disponibles</label>
                                <input type="text" class="form-control" id="equipements" name="equipements">
                            </div>
                            <div class="form-group">
                                <label for="recommandations_securite">Recommandations de Sécurité</label>
                                <input type="text" class="form-control" id="recommandations_securite" name="recommandations_securite">
                            </div>
                            <div class="form-group">
                                <label for="photos">Photos de la Destination</label>
                                <input type="file" class="form-control" name="photos" id="photos">
                            </div>
                            <div class="form-group">
                                <label for="avis_voyageurs">Avis des Voyageurs</label>
                                <textarea class="form-control" name="avis_voyageurs" id="avis_voyageurs"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="offres_speciales">Offres Spéciales/Packs</label>
                                <input type="text" class="form-control" name="offres_speciales" id="offres_speciales">
                            </div>
                            <div class="form-group">
                                <label for="accessibilite">Accessibilité</label>
                                <input type="text" class="form-control" name="accessibilite" id="accessibilite">
                            </div>
                            <div class="form-group">
                                <label for="restrictions_conditions">Restrictions ou Conditions Spéciales</label>
                                <input type="text" class="form-control" name="restrictions_conditions" id="restrictions_conditions">
                            </div>
                            <button type="submit" name="add_destination" class="btn btn-primary">Ajouter la Destination</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de mise à jour d'une destination -->
        <div class="modal fade" id="editDestinationModal" tabindex="-1" aria-labelledby="editDestinationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDestinationModalLabel">Éditer une Destination</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_destination" id="id_destination_edit">

                            <div class="form-group">
                                <label for="nom_destination_edit">Nom de la Destination</label>
                                <input type="text" class="form-control" name="nom_destination" id="nom_destination_edit">
                            </div>
                            <div class="form-group">
                                <label for="description_edit">Description</label>
                                <textarea class="form-control" name="description" id="description_edit"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pays_region_edit">Pays/Région</label>
                                <input type="text" class="form-control" name="pays_region" id="pays_region_edit">
                            </div>
                            <div class="form-group">
                                <label for="type_destination_edit">Type de Destination</label>
                                <select class="form-control" name="type_destination" id="type_destination_edit">
                                    <option value="plage">Plage</option>
                                    <option value="montagne">Montagne</option>
                                    <option value="urbain">Urbain</option>
                                    <option value="rural">Rural</option>
                                    <option value="aventure">Aventure</option>
                                    <!-- Ajoutez d'autres options ici si nécessaire -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="attractions_principales_edit">Attractions Principales</label>
                                <input type="text" class="form-control" name="attractions_principales" id="attractions_principales_edit">
                            </div>
                            <div class="form-group">
                                <label for="meilleure_saison_edit">Meilleure Saison pour Visiter</label>
                                <input type="text" class="form-control" name="meilleure_saison" id="meilleure_saison_edit">
                            </div>
                            <div class="form-group">
                                <label for="cout_moyen_edit">Coût Moyen du Séjour</label>
                                <input type="number" class="form-control" name="cout_moyen" id="cout_moyen_edit">
                            </div>
                            <div class="form-group">
                                <label for="equipements_edit">Équipements Disponibles</label>
                                <input type="text" class="form-control" name="equipements" id="equipements_edit">
                            </div>
                            <div class="form-group">
                                <label for="recommandations_securite_edit">Recommandations de Sécurité</label>
                                <input type="text" class="form-control" name="recommandations_securite" id="recommandations_securite_edit">
                            </div>
                            <div class="form-group">
                                <label for="photos">Photos de la Destination</label>
                                <input type="file" class="form-control" name="photos" id="photos">
                            </div>
                            <div class="form-group">
                                <label for="avis_voyageurs_edit">Avis des Voyageurs</label>
                                <textarea class="form-control" name="avis_voyageurs" id="avis_voyageurs_edit"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="offres_speciales_edit">Offres Spéciales/Packs</label>
                                <input type="text" class="form-control" name="offres_speciales" id="offres_speciales_edit">
                            </div>
                            <div class="form-group">
                                <label for="accessibilite_edit">Accessibilité</label>
                                <input type="text" class="form-control" name="accessibilite" id="accessibilite_edit">
                            </div>
                            <div class="form-group">
                                <label for="restrictions_conditions_edit">Restrictions ou Conditions Spéciales</label>
                                <input type="text" class="form-control" name="restrictions_conditions" id="restrictions_conditions_edit">
                            </div>

                            <button type="submit" name="update_destination" class="btn btn-primary">Mettre à jour</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <table class="table mt-4 table-bordered ml-2">
            <thead>
                <tr>
                    <th>Nom de la Destination</th>
                    <th>Description</th>
                    <th>Pays/Région</th>
                    <th>Type de Destination</th>
                    <th>Attractions Principales</th>
                    <th>Meilleure Saison</th>
                    <th>Coût Moyen</th>
                    <th>Équipements</th>
                    <th>Recommandations de Sécurité</th>
                    <th>Photos</th>
                    <th>Avis des Voyageurs</th>
                    <th>Offres Spéciales</th>
                    <th>Accessibilité</th>
                    <th>Restrictions/Conditions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM destinations";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nom_destination"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["pays_region"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["type_destination"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["attractions_principales"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["meilleure_saison"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["cout_moyen"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["equipements"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["recommandations_securite"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["photos"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["avis_voyageurs"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["offres_speciales"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["accessibilite"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["restrictions_conditions"]) . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-primary btn-sm editBtn' data-toggle='modal' data-target='#editDestinationModal' 
                        data-id='" . htmlspecialchars($row['id']) . "' 
                        data-nom_destination='" . htmlspecialchars($row['nom_destination']) . "'
                        data-description='" . htmlspecialchars($row['description']) . "' 
                        data-pays_region='" . htmlspecialchars($row['pays_region']) . "' 
                        data-type_destination='" . htmlspecialchars($row['type_destination']) . "' 
                        data-attractions_principales='" . htmlspecialchars($row['attractions_principales']) . "' 
                        data-meilleure_saison='" . htmlspecialchars($row['meilleure_saison']) . "' 
                        data-cout_moyen='" . htmlspecialchars($row['cout_moyen']) . "' 
                        data-equipements='" . htmlspecialchars($row['equipements']) . "' 
                        data-recommandations_securite='" . htmlspecialchars($row['recommandations_securite']) . "' 
                        data-photos='" . htmlspecialchars($row['photos']) . "' 
                        data-avis_voyageurs='" . htmlspecialchars($row['avis_voyageurs']) . "' 
                        data-offres_speciales='" . htmlspecialchars($row['offres_speciales']) . "' 
                        data-accessibilite='" . htmlspecialchars($row['accessibilite']) . "' 
                        data-restrictions_conditions='" . htmlspecialchars($row['restrictions_conditions']) . "'><i class='fas fa-edit'></i></button>";
                        echo "<a href='?delete_destination=" . $row['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='15'>Aucune destination trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</main>

<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {
            var modal = $('#editDestinationModal');
            var button = $(this);

            modal.find('#id_destination_edit').val(button.data('id'));
            modal.find('#nom_destination_edit').val(button.data('nom_destination'));
            modal.find('#description_edit').val(button.data('description'));
            modal.find('#pays_region_edit').val(button.data('pays_region'));
            modal.find('#type_destination_edit').val(button.data('type_destination'));
            modal.find('#attractions_principales_edit').val(button.data('attractions_principales'));
            modal.find('#meilleure_saison_edit').val(button.data('meilleure_saison'));
            modal.find('#cout_moyen_edit').val(button.data('cout_moyen'));
            modal.find('#equipements_edit').val(button.data('equipements'));
            modal.find('#recommandations_securite_edit').val(button.data('recommandations_securite'));
            modal.find('#photos_edit').val(button.data('photos'));
            modal.find('#avis_voyageurs_edit').val(button.data('avis_voyageurs'));
            modal.find('#offres_speciales_edit').val(button.data('offres_speciales'));
            modal.find('#accessibilite_edit').val(button.data('accessibilite'));
            modal.find('#restrictions_conditions_edit').val(button.data('restrictions_conditions'));
        });
    });
</script>

<?php include "layouts/footer.php" ?>