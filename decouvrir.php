<?php
session_start();
include 'admin/config.php'; // Assurez-vous d'inclure le fichier de configuration de la base de données

$destinationId = $_GET['id']; // Récupérez l'identifiant de la destination depuis la requête GET

// Requête SQL pour récupérer les informations de la destination en fonction de $destinationId
$query = "SELECT * FROM destinations WHERE id = $destinationId";
$result = $conn->query($query);

// Traitez les données de la destination
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomDestination = $row['nom_destination'];
    $description = $row['description'];
    $paysRegion = $row['pays_region'];
    $typeDestination = $row['type_destination'];
    $attractionsPrincipales = $row['attractions_principales'];
    $meilleureSaison = $row['meilleure_saison'];
    $coutMoyen = $row['cout_moyen'];
    $equipements = $row['equipements'];
    $recommandationsSecurite = $row['recommandations_securite'];
    $photos = $row['photos'];
    $avisVoyageurs = $row['avis_voyageurs'];
    $offresSpeciales = $row['offres_speciales'];
    $accessibilite = $row['accessibilite'];
    $restrictionsConditions = $row['restrictions_conditions'];
} else {
    // Gérez le cas où aucune destination n'est trouvée avec cet identifiant
    $nomDestination = "Destination non trouvée";
    $description = "La destination que vous recherchez n'a pas été trouvée.";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_comment"])) {
    $user_name = $_POST["user_name"];
    $comment_text = $_POST["comment_text"];

    // Insert the comment into the database (sanitize and validate user input as needed)
    $insert_query = "INSERT INTO comments (destination_id, user_name, comment_text, comment_date) VALUES ($destinationId, '$user_name', '$comment_text', NOW())";
    if ($conn->query($insert_query) === TRUE) {
        header("location: decouvrir.php?id=$destinationId");
        exit();
    } else {
        // Handle errors
    }
}

// Retrieve and display comments for the destination
$comments_query = "SELECT * FROM comments WHERE destination_id = $destinationId ORDER BY comment_date DESC";
$comments_result = $conn->query($comments_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Rihla Travel - <?php echo $nomDestination; ?></title>
    <style>
        /* Style des commentaires */
        .comment {
            border: 1px solid #ccc;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        /* Style de l'icône de profil */
        .comment .profile-icon {
            font-size: 24px;
            margin-right: 10px;
            color: #007BFF;
            /* Couleur de l'icône */
        }

        /* Style du nom de l'utilisateur */
        .comment .user-name {
            font-weight: bold;
        }

        /* Style du texte du commentaire */
        .comment .comment-text {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/img/logo.png" height="78" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/rihla">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla#vol">Vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla#hotel">Hôtel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla/faq.php">FAQ</a>
                    </li>
                    <?php if (!isset($_SESSION["user_id"])) { ?>
                        <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="client/">Se Connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white btn btn-primary btn-outline-primary" href="registre.php">S'Inscrire</a>
                    </li>
                    <?php }else { ?>
                        <li class="nav-item">
                            <a class="text-white btn btn-success btn-outline-success me-3" href="/rihla/client">Mon Compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white btn btn-danger btn-outline-danger" href="/rihla/client/deconnexion.php">deconnexion</a>
                        </li>
                        <?php }?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- start slider -->
    <div class="slider" style="background-image: url('admin/<?php echo $photos; ?>'); height:calc(100vh - 79px);background-size:cover;">
        <div class="row align-items-center text-center text-white flex-column w-100" style="position: relative; top: 50%;">
            <h2 style="color: #c19c25;font-weight:bolder;"><?php echo $nomDestination; ?></h2>
            <p style="font-weight: bold;"><?php echo $description; ?></p>
            <a href="traitement_reservation.php?id=<?php echo $destinationId; ?>" class="col-6 btn btn-primary mt-2 mb-2">Réservez</a>
        </div>
    </div>
    <!-- end slider -->
    <!-- Contenu principal -->
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-8">
                <!-- Affichage des détails de la destination -->
                <h2><?php echo $nomDestination; ?></h2>
                <p><?php echo $description; ?></p>
                <!-- Affichez d'autres détails ici -->
                <p>Pays/Région : <?php echo $paysRegion; ?></p>
                <p>Type de Destination : <?php echo $typeDestination; ?></p>
                <p>Attractions Principales : <?php echo $attractionsPrincipales; ?></p>
                <p>Meilleure Saison : <?php echo $meilleureSaison; ?></p>
                <p>Coût Moyen : <?php echo $coutMoyen; ?> DZD</p>
                <p>Équipements : <?php echo $equipements; ?></p>
                <p>Recommandations de Sécurité : <?php echo $recommandationsSecurite; ?></p>
                <p>Accessibilité : <?php echo $accessibilite; ?></p>
                <p>Restrictions/Conditions : <?php echo $restrictionsConditions; ?></p>
                <p>Avis des Voyageurs : <?php echo $avisVoyageurs; ?></p>
                <p>Offres Spéciales : <?php echo $offresSpeciales; ?></p>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <!-- Affichage de la photo de la destination -->
                <img src="admin/<?php echo $photos; ?>" class="img-fluid" alt="<?php echo $nomDestination; ?>">
            </div>
            <a href="traitement_reservation.php?id=<? echo $destinationId; ?>" class="col-6 btn btn-primary mt-2 mb-2 ms-3">Réservez</a>
        </div>
        <hr>
        <form method="POST" action="">
            <div class="form-group mt-2">
                <label class="form-label" for="user_name">Votre nom:</label>
                <input type="text" class="form-control" name="user_name" required>
            </div>
            <div class="form-group mt-2">
                <label class="form-label" for="comment_text">Votre Commentaire:</label>
                <textarea class="form-control" name="comment_text" rows="4" required></textarea>
            </div>
            <button type="submit" name="submit_comment" class="btn btn-primary mt-2">Ajouter Commentaire</button>
        </form>
        <!-- Display existing comments -->
        <?php
        if ($comments_result->num_rows > 0) {
            while ($comment_row = $comments_result->fetch_assoc()) {
                echo "<div class='comment mt-4'>";
                echo "<i class='fas fa-user-circle profile-icon'></i>"; // Icône de profil
                echo "<span class='user-name'>{$comment_row['user_name']}</span> - {$comment_row['comment_date']}"; // Nom de l'utilisateur
                echo "<p class='comment-text'>{$comment_row['comment_text']}</p>"; // Texte du commentaire
                echo "</div>";
            }
            
        }
        ?>
    </div>


    <!-- end contact  -->
    <footer class="bg-light pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Contactez-nous</h3>
                    <p>123, rue Principale</p>
                    <p>Ville, Pays</p>
                    <p>Email : exemple@example.com</p>
                    <p>Téléphone : +123 456 7890</p>
                </div>
                <div class="col-md-6">
                    <h3>Suivez-nous</h3>
                    <a href="#" class="ms-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="ms-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="ms-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <!-- Google Maps iframe -->
            <div class="row">
                <div class="col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1636780.1281857577!2d0.9400081000000005!3d36.750502900000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128fb3929af442c1%3A0x4aae2bf5c950da5f!2srihal%20tours!5e0!3m2!1sfr!2sdz!4v1702337450221!5m2!1sfr!2sdz" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <!-- Mention "Tous droits réservés" -->
            <div class="row">
                <div class="col-md-12 text-center mt-4">
                    <p>Tous droits réservés &copy; 2023 Rihla Tours</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Inclure les fichiers JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
</body>

</html>