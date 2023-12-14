<?php
// include "admin/config.php";
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $genre = $_POST["genre"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT); // Hashage du mot de passe
    $date_naissance = $_POST["date_naissance"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rihla_tours";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO utilisateurs (genre, nom, prenom, email, mot_de_passe, date_naissance, addres, telephone)
                VALUES (:genre, :nom, :prenom, :email, :mot_de_passe, :date_naissance, :adresse, :telephone)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);

        $stmt->execute();

        // Redirection vers la page d'espace utilisateur en cas de succès
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        // Affichage de l'erreur
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
}
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
    <title>Rihla Travel</title>
    <style>
        .background-image {
            background-image: url('assets/img/plane.jpg');
            /* Ajoutez le chemin vers votre image de fond */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
            min-height: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
    <a href="/rihla" class="text-white" style="position: absolute; top:20px; left:30px;"><i class="fa fa-arrow-left"></i> Retour au Page d'acceuill</a>

        <div class="row">
            <!-- Colonne de l'image de fond -->
            <div class="col-md-6 p-0">
                <div class="background-image d-flex flex-column justify-content-center align-items-center">
                    <!-- <div class="row justify-content-center"> -->
                    <img src="assets/img/logo.png" width="120px" height="78px" alt="" srcset="" class="img img-fluid w-50">
                    <!-- </div> -->
                    <h1 class="text-white">Bienvenue chez Rihla Travel</h1>
                </div>
            </div>

            <!-- Colonne du formulaire d'inscription -->
            <div class="col-md-6 mb-5">

                <div class="container mt-5">
                    <h2 class="text-center" style="color: #c19c25; text-transform:uppercase;">Inscription</h2>
                    <form action="" method="POST">
                        <div class="form-group mt-2 row ms-1">
                            <label class="col-lg-2 col-md-2">Genre :</label>
                            <div class="form-check col-md-6 col-lg-2">
                                <input type="radio" class="form-check-input" id="homme" name="genre" value="Homme" required>
                                <label class="form-check-label" for="homme">Homme</label>
                            </div>
                            <div class="form-check col-md-6 col-lg-2">
                                <input type="radio" class="form-check-input" id="femme" name="genre" value="Femme" required>
                                <label class="form-check-label" for="femme">Femme</label>
                            </div>
                        </div>
                        <div class="row justify-content-between ms-1">
                            <div class="form-group mt-2 col-md-6 col-lg-6">

                                <label class="form-label" for="nom">Nom :</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="form-group mt-2 col-md-6 col-lg-6">

                                <label class="form-label" for="prenom">Prénom :</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="email">Adresse E-mail :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="mot_de_passe">Mot de passe :</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                        </div>

                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="date_naissance">Date de Naissance :</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                        </div>

                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="adresse">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>

                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="telephone">Numéro de Téléphone :</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" required>
                        </div>
                        <div class="row ms-3 me-1">
                            <button type="submit" class="btn text-white mt-2 " style="background-color: #c19c25;">S'Inscrire</button>
                        </div>
                    </form>
                    <span class="text-center ms-5">Déja vous avez un compte ? <a href="login.php">connexion</a></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- ... (votre pied de page ici) ... -->

    <!-- Inclure les fichiers JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
</body>

</html>