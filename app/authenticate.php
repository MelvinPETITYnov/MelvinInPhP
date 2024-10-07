<?php
if (isset($_POST['register'])) {
    // Connexion à la base de données
    $mysqli = new mysqli("db", "user", "password", "phplogin");

    // Vérification des erreurs de connexion
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Préparer et lier l'instruction SQL
    $stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Nettoyer l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }
    $password = $_POST['password'];

    // Hacher le mot de passe
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Exécuter l'instruction SQL
    if ($stmt->execute()) {
        echo "New account created successfully!";
    } else {
        if ($stmt->errno == 1062) { // Code d'erreur pour une entrée en double
            echo "Username or email already exists!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $mysqli->close();
}
?>
