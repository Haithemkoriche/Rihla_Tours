<?php
session_start();
// Function to generate a hashed password
function generateHashedPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données (modifier les informations de connexion)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "rihla_tours";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour vérifier les informations de connexion
    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);

    // Vérifier si des résultats ont été renvoyés
    if ($result->num_rows == 1) {
        // L'utilisateur existe, vérifiez le mot de passe
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // L'utilisateur est authentifié, vous pouvez rediriger vers la page d'administration
            $_SESSION['admin']=true;
            header("Location: index.php");
            exit();
        } else {
            // Les informations de connexion sont incorrectes
            $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Aucun utilisateur avec ce nom d'utilisateur, vérifiez si la table est vide
        $emptyTable = true;
        $sql = "SELECT COUNT(*) as count FROM admin";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row["count"] == 0) {
            // La table est vide, générer des identifiants pour le premier administrateur
            $hashedPassword = generateHashedPassword($password);
            $insertQuery = "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
                // Identifiants créés avec succès
                $_SESSION['admin']=true;
                header("Location: index.php");
                exit();

            } else {
                $error_message = "Erreur lors de la création des identifiants.";
            }
        } else {
            $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <!-- Inclure les fichiers CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Connexion Administrateur</div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <?php if (isset($error_message)) { ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-block text-white" style="background-color: #c19c25;">Se Connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure les fichiers JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
