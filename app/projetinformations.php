<?php

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$mysqli = new mysqli("db", "root", "root", "cv_db");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
}

// Vérifier si le formulaire a été soumis pour ajouter un projet
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titre']) && isset($_POST['description'])) {
        // Récupérer les données du formulaire
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $date_creation = date('Y-m-d');

        // Insérer un nouveau projet
        $sql = "INSERT INTO projets (user_id, titre, description, date_creation) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("isss", $_SESSION['user_id'], $titre, $description, $date_creation);

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Erreur: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fermer la connexion à la base de données une fois que tout est terminé
$mysqli->close();
?>
