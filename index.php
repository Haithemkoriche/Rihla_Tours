<?php session_start(); ?>
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
    <title>Rihla Travel</title>
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
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hôtel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Voiture</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="login.php">Se Connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-white btn btn-primary btn-outline-primary" href="registre.php">S'Inscrire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- start slider -->
    <div class="slider" style="background-image: url('assets/img/plane.jpg'); height:calc(100vh - 79px);background-size:cover;">
        <div class="row align-items-center flex-column w-100" style="position: relative; top: 50%;">
        <?php if ($_SESSION['vol_success']){ ?>
            <div id="success-message" class="alert alert-success text-center col-10">
                L'agence va vous contacter prochainement a propos votre reservation de vol.
            </div>
            <?php } ?>
        <?php if ($_SESSION['hotel_success']){ ?>
            <div id="success-message" class="alert alert-success text-center col-10">
                L'agence va vous contacter prochainement a propos votre reservation d'hotel.
            </div>
            <?php } ?>

            <a href="#vol" class="col-6 btn btn-primary mt-2 mb-2">Reservez Un Vol</a>
            <a href="#hotel" class="col-6 btn btn-secondary">Reservez Un Hotel</a>
        </div>
    </div>
    <!-- end slider -->

    <div class="container">
        <!-- cards -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-calendar h2"></i> <!-- Replace with your icon -->
                        <h5 class="card-title ">Planifier</h5>
                        <p class="card-text">confiler nous vos reves d'evation en famille ou entre amis , nous trouverons la formule qui comblera vos atente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-list h2"></i> <!-- Replace with your icon -->
                        <h5 class="card-title ">Organiser</h5>
                        <p class="card-text">Beneficier de l'entreprise de vos specialite de chaque distination , il vous accompagnent dans la realisation de vos voyages.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-plane h2"></i> <!-- Replace with your icon -->
                        <h5 class="card-title ">Voyage</h5>
                        <p class="card-text">Nous nous chargeons d'assurer votre securite et de veiller a votre plain serenite tout au long de votre voyage...</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end cards -->


        <!-- Section Nos Destinations -->
        <!-- Section Nos Destinations -->
        <div class="container mt-5">
            <h2 class="text-center mb-4">Nos Destinations</h2>
            <div class="row">
                <?php
                // Connexion à la base de données
                include 'admin/config.php';

                $query = "SELECT * FROM destinations";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<div class='card mb-4'>";
                        echo "<img src='admin/" . $row['photos'] . "' class='card-img-top' alt='" . $row['photos'] . "' style='height: 300px;'>"; // Spécifiez la hauteur que vous souhaitez pour les images ici
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . $row['nom_destination'] . "</h5>";
                        echo "<p class='card-text'>" . $row['description'] . "</p>";
                        echo "<a href='reservation.php?id=" . $row['id'] . "' class='btn btn-primary mt-2'>Réserver</a>"; // Lien vers la page de réservation avec l'ID de la destination
                        echo "</div></div></div>";
                    }
                } else {
                    echo "<p>Aucune destination trouvée.</p>";
                }
                ?>
            </div>
        </div>



        <!-- Section Acheter un Billet de Vol -->
        <div class="container mt-5">
            <h2 class="text-center mb-4" id="vol">Acheter un Billet de Vol</h2>
            <form action="reservation_vol.php" method="GET">
                <select name="vol" class="form-select mb-3">
                    <?php
                    $query_vols = "SELECT * FROM vols";
                    $result_vols = $conn->query($query_vols);

                    if ($result_vols->num_rows > 0) {
                        echo '<option value=""> Acheter un Billet de Vol</option>';
                        while ($vol = $result_vols->fetch_assoc()) {
                            echo "<option value='" . $vol['id'] . "'>" . $vol['nom_vol'] . " - " . $vol['origine'] . "/" . $vol['destination'] . " Avec " . $vol['compagnie'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>Aucun vol disponible</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Réserver</button>
            </form>
        </div>



        <!-- Section Réserver un Hôtel -->
        <div class="container mt-5 mb-5">
            <h2 class="text-center mb-4" id="hotel">Réserver un Hôtel</h2>
            <form action="reservation_hotel.php" method="GET">
                <select name="hotel" class="form-select mb-3">
                    <?php
                    $query_hotels = "SELECT * FROM hotels";
                    $result_hotels = $conn->query($query_hotels);

                    if ($result_hotels->num_rows > 0) {
                        echo '<option value="">Réserver un Hôtel</option>';

                        while ($hotel = $result_hotels->fetch_assoc()) {
                            echo "<option value='" . $hotel['id'] . "'>" . $hotel['nom_hotel'] . "  -  " . $hotel['emplacement'] . " " . $hotel['etoiles'] . " Etoiles</option>";
                        }
                    } else {
                        echo "<option value='' disabled>Aucun hôtel disponible</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Réserver</button>
            </form>
        </div>














        <!-- start services -->


        <section class="services mt-5 mb-5">
            <div class="h2 text-center">Services</div>
            <div class="row pt-5 pb-5">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="h3 text-center">Réservation Hotel</div>
                    <p>Réserver votre hôtel avec lastminute.com, c’est l’assurance de dénicher facilement et rapidement un établissement offrant des prestations de qualité au meilleur prix en France comme à l'étranger.

                        Nous tenons nos promesses de marque de dernière minute, vous pouvez réserver le jour même votre nuit d’hôtel tout simplement depuis votre téléphone mobile</p>
                </div>
                <div class="col-md-6"> <img src="assets/img/hotel.jpg" width="500" alt="" srcset="" class="img-fluid img rounded-5"></div>
            </div>
        </section>

        <section class="services mt-5 mb-5">
            <div class="row pt-3 pb-3">
                <div class="col-md-6"> <img src="assets/img/img4.jpg" width="500" alt="" srcset="" class="img-fluid img rounded-5"></div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="h3 text-center">Réservation Vols</div>
                    <p>Réserver votre hôtel avec lastminute.com, c’est l’assurance de dénicher facilement et rapidement un établissement offrant des prestations de qualité au meilleur prix en France comme à l'étranger.

                        Nous tenons nos promesses de marque de dernière minute, vous pouvez réserver le jour même votre nuit d’hôtel tout simplement depuis votre téléphone mobile
                    </p>
                </div>
            </div>
        </section>
        <!-- end services -->
    </div>
    <!-- apropos -->
    <section class="apropos mt-5">
        <div class="h2 text-center pt-5 pb-5">À Propos de Nous</div>
        <div class="p-5 mt-5" style="background-color: #C19C25;">
            <div class="row justify-content-center mt-3 mb-3">
                <img src="assets/img/vol.jpg" width="500" class="img img-fluid rounded-5 col-6" alt="" srcset="">
            </div>
            <div class="text-white text-center mt-5 mb-5">Bienvenue sur le site officiel de Notre Entreprise, votre partenaire de confiance dans...

                Notre engagement envers l'excellence se reflète dans notre mission de...

                Nous sommes fiers de...

                Rencontrez notre équipe dévouée de professionnels chevronnés dans...

                Contactez-nous dès aujourd'hui pour discuter de la manière dont nous pouvons répondre à vos besoins.</div>
        </div>

    </section>
    <!--end apropos -->

    <!-- contact -->
    <section id="contact" class="mt-5 mb-5 pt-5 pb-5">
        <div class="container">

            <div class="row ">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <h2>Contactez-nous</h2>
                    <p>N'hésitez pas à nous contacter pour toute question ou demande d'information. Nous sommes là pour vous aider !</p>
                    <ul>
                        <li class="mt-2"><strong>Email :</strong> contact@rihla.dz</li>
                        <li class="mt-2"><strong>Téléphone :</strong> +213 456 7890</li>
                        <li class="mt-2"><strong>Adresse :</strong> Rue Rahmania, Douera, Alger</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Formulaire de Contact</h2>
                    <form action="#" method="post">
                        <div class="form-group mt-2">
                            <label class="form-label" for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label" for="message">Message</label>
                            <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Envoyer le Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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