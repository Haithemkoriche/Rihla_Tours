<?php
include "../admin/config.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
    exit();
}

$id_utilisateur = $_SESSION["user_id"];

// Récupérez les informations de l'utilisateur à partir de la base de données
$sql = "SELECT * FROM utilisateurs WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $id_utilisateur);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Erreur : Utilisateur introuvable.";
            exit();
        }
    } else {
        echo "Erreur lors de la récupération des informations de l'utilisateur : " . $stmt->error;
        exit();
    }
} else {
    echo "Erreur de préparation de la requête : " . $conn->error;
    exit();
}

// Vérifiez si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveau_nom = $_POST["nouveau_nom"];
    $nouveau_prenom = $_POST["nouveau_prenom"];
    $nouveau_email = $_POST["nouveau_email"];
    $nouveau_mot_de_passe = $_POST["nouveau_mot_de_passe"];
    $nouvelle_date_naissance = $_POST["nouvelle_date_naissance"];
    $nouveau_genre = $_POST["nouveau_genre"];
    $nouvelle_adresse = $_POST["nouvelle_adresse"];
    $nouveau_telephone = $_POST["nouveau_telephone"];

    // Mettez à jour les informations de l'utilisateur dans la base de données
    $update_sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, mot_de_passe = ?, date_naissance = ?, genre = ?, addres = ?, telephone = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    if ($update_stmt) {
        $update_stmt->bind_param("ssssssssi", $nouveau_nom, $nouveau_prenom, $nouveau_email, $nouveau_mot_de_passe, $nouvelle_date_naissance, $nouveau_genre, $nouvelle_adresse, $nouveau_telephone, $id_utilisateur);
        if ($update_stmt->execute()) {
           header("location: index.php");
           exit();
            // Rafraîchissez la page pour afficher les nouvelles informations
            header("Refresh:2");
        } else {
            echo "Erreur lors de la mise à jour des informations : " . $update_stmt->error;
        }
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Compte</title>
    <!-- Inclure Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
        <!-- start navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="/rihla/assets/img/logo.png" height="78" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/rihla/client/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla/#vols">Vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rihla/#hotel">Hôtel</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger me-2" href="deconnexion.php">Se Déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Votre Compte</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nouveau_nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nouveau_nom" id="nouveau_nom" value="<?php echo $row["nom"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nouveau_prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="nouveau_prenom" id="nouveau_prenom" value="<?php echo $row["prenom"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nouveau_email" class="form-label">Adresse Email</label>
                <input type="email" class="form-control" name="nouveau_email" id="nouveau_email" value="<?php echo $row["email"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nouveau_mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="nouveau_mot_de_passe" id="nouveau_mot_de_passe" required>
            </div>
            <div class="mb-3">
                <label for="nouvelle_date_naissance" class="form-label">Date de Naissance</label>
                <input type="date" class="form-control" name="nouvelle_date_naissance" id="nouvelle_date_naissance" value="<?php echo $row["date_naissance"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nouveau_genre" class="form-label">Genre</label>
                <select class="form-control" name="nouveau_genre" id="nouveau_genre" required>
                    <option value="Homme" <?php if ($row["genre"] === "Homme") echo "selected"; ?>>Homme</option>
                    <option value="Femme" <?php if ($row["genre"] === "Femme") echo "selected"; ?>>Femme</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nouvelle_adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="nouvelle_adresse" id="nouvelle_adresse" value="<?php echo $row["addres"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nouveau_telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" name="nouveau_telephone" id="nouveau_telephone" value="<?php echo $row["telephone"]; ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="modifier">Modifier les Informations</button>
            </div>
        </form>
    </div>

    <!-- Inclure Bootstrap JS (facultatif, selon vos besoins) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
