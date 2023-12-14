<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rihla_tours";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer l'utilisateur en fonction de l'adresse e-mail
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
            // Connexion réussie, rediriger vers la page d'espace utilisateur
            $_SESSION["user_id"]=$user["id"];
            header("Location: espace_utilisateur.php");
            exit();
        } else {
            $erreur_message = "Adresse e-mail ou mot de passe incorrect.";
        }

    } catch(PDOException $e) {
        $erreur_message = "Erreur : " . $e->getMessage();
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

            <!-- Colonne du formulaire de connexion -->
            <div class="col-md-6 mb-5 d-flex align-items-center">
                <div class="container mt-5">
                    <h2 class="text-center">Connexion</h2>
                    <form action="" method="POST">
                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="email">Adresse E-mail :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group mt-2 ms-3">
                            <label class="form-label" for="mot_de_passe">Mot de passe :</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                        </div>

                        <?php if (isset($erreur_message)) : ?>
                            <div class="alert alert-danger mt-3 ms-3">
                                <?php echo $erreur_message; ?>
                            </div>
                        <?php endif; ?>

                        <div class="row ms-3 me-1">
                            <button type="submit" class="btn text-white mt-2" style="background-color: #c19c25;">Se Connecter</button>
                        </div>
                    </form>
                    <span class="text-center ms-5">Vous avez pas un compte ? <a href="registre.php">S'inscrire</a></span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
