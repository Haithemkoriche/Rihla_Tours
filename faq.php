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
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="text-white btn btn-success btn-outline-success me-3" href="/rihla/client">Mon Compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white btn btn-danger btn-outline-danger" href="/rihla/client/deconnexion.php">deconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- start slider -->
    <div class="slider" style="background-image: url('assets/img/plane.jpg'); height:calc(100vh - 79px);background-size:cover;">
        <div class="row align-items-center flex-column w-100" style="position: relative; top: 50%;">
            <?php if (@$_SESSION['reservation_success']) { ?>
                <div id="success-message" class="alert alert-success text-center col-10">
                    L'agence va vous contacter prochainement a propos votre reservation.
                </div>
            <?php } ?>

            <h1 class="text-center">Foire aux questions (FAQ)</h1>
        </div>
    </div>
    <!-- end slider -->

    <!-- Contenu de la page FAQ -->
    <div class="container mt-4 mb-5">

        <!-- Question 1 -->
        <div class="accordion mt-5 mb-5" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                        Question 1 : Qu'est-ce que Rihla Travel ?
                    </button>
                </h2>
                <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Rihla Travel est une agence de voyage spécialisée dans la réservation de vols et d'hôtels. Nous vous aidons à planifier vos voyages en vous proposant les meilleures options de vol et d'hébergement.
                    </div>
                </div>
            </div>
            <!-- </div> -->

            <!-- Question 2 -->
            <!-- <div class="accordion" id="faqAccordion"> -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading2">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                        Question 2 : Comment puis-je réserver un vol sur Rihla Travel ?
                    </button>
                </h2>
                <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour réserver un vol sur Rihla Travel, suivez ces étapes :
                        <ol>
                            <li>Accédez à notre site web.</li>
                            <li>Cliquez sur l'onglet "Vols".</li>
                            <li>Sélectionnez votre lieu de départ et votre destination.</li>
                            <li>Choisissez les dates de votre voyage.</li>
                            <li>Parcourez les options de vol disponibles et sélectionnez celle qui vous convient le mieux.</li>
                            <li>Remplissez les informations nécessaires et procédez au paiement.</li>
                            <li>Une fois le paiement effectué, vous recevrez la confirmation de votre réservation par e-mail.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Question 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading3">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                        Question 3 : Quels types de vols proposez-vous ?
                    </button>
                </h2>
                <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Nous proposons une variété de types de vols, notamment des vols domestiques, des vols internationaux, des vols aller simple et des vols aller-retour. Vous pouvez choisir le type de vol qui correspond le mieux à vos besoins de voyage.
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading4">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                        Question 4 : Comment puis-je annuler ou modifier ma réservation de vol ?
                    </button>
                </h2>
                <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour annuler ou modifier votre réservation de vol, veuillez nous contacter via notre service client. Nos agents vous guideront à travers le processus d'annulation ou de modification en fonction de nos politiques de réservation en vigueur.
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading5">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                        Question 5 : Quelles sont les options de paiement acceptées ?
                    </button>
                </h2>
                <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Nous acceptons plusieurs modes de paiement, notamment les cartes de crédit (Visa, MasterCard, American Express), les cartes de débit et les virements bancaires. Assurez-vous de choisir l'option qui vous convient le mieux lors du paiement de votre réservation.
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading6">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                        Question 6 : Puis-je ajouter des bagages supplémentaires à ma réservation ?
                    </button>
                </h2>
                <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Oui, vous pouvez ajouter des bagages supplémentaires à votre réservation en fonction de la politique de bagages de la compagnie aérienne que vous avez choisie. Lors de la réservation, vous aurez l'option de sélectionner le nombre de bagages et leur poids. Des frais supplémentaires peuvent s'appliquer.
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading7">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
                        Question 7 : Comment puis-je obtenir des informations sur les offres spéciales et les réductions ?
                    </button>
                </h2>
                <div id="faqCollapse7" class="accordion-collapse collapse" aria-labelledby="faqHeading7" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pour obtenir des informations sur nos offres spéciales et nos réductions, nous vous recommandons de consulter notre site web régulièrement. Vous pouvez également vous abonner à notre newsletter pour recevoir des mises à jour directement dans votre boîte de réception.
                    </div>
                </div>
            </div>

            <!-- Question 8 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading8">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse8" aria-expanded="false" aria-controls="faqCollapse8">
                        Question 8 : Comment puis-je contacter le service client en cas d'urgence ?
                    </button>
                </h2>
                <div id="faqCollapse8" class="accordion-collapse collapse" aria-labelledby="faqHeading8" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        En cas d'urgence, vous pouvez nous contacter 24h/24 et 7j/7 au numéro d'urgence indiqué sur notre site web. Nos agents sont disponibles pour vous assister en cas de besoin.
                    </div>
                </div>
            </div>

            <!-- Question 9 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading9">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse9" aria-expanded="false" aria-controls="faqCollapse9">
                        Question 9 : Quels sont les avantages de créer un compte sur Rihla Travel ?
                    </button>
                </h2>
                <div id="faqCollapse9" class="accordion-collapse collapse" aria-labelledby="faqHeading9" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        En créant un compte sur Rihla Travel, vous bénéficierez des avantages suivants :
                        <ul>
                            <li>Accès à des offres exclusives pour les membres.</li>
                            <li>Enregistrement plus rapide lors de la réservation.</li>
                            <li>Suivi facile de vos réservations et historique de voyage.</li>
                            <li>Recevoir des notifications sur les offres spéciales.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Question 10 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading10">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse10" aria-expanded="false" aria-controls="faqCollapse10">
                        Question 10 : Comment puis-je réinitialiser mon mot de passe si je l'ai oublié ?
                    </button>
                </h2>
                <div id="faqCollapse10" class="accordion-collapse collapse" aria-labelledby="faqHeading10" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Si vous avez oublié votre mot de passe, vous pouvez réinitialiser votre mot de passe en suivant les étapes suivantes :
                        <ol>
                            <li>Accédez à la page de connexion.</li>
                            <li>Cliquez sur "Mot de passe oublié".</li>
                            <li>Saisissez votre adresse e-mail enregistrée.</li>
                            <li>Vous recevrez un e-mail avec des instructions pour réinitialiser votre mot de passe.</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>


        <!-- Ajoutez d'autres questions et réponses ici... -->

    </div>

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