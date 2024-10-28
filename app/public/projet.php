<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../src/projetinformations.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/projet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Projet</title>
</head>
<body>
    <div class="projetpage">
        <form action="projet.php" method="POST">
            <div class="form-group">
                <label for="titre">Title :</label><br>
                <input type="text" id="titre" name="titre" required><br><br>
            </div>
            <div class="form-group">
                <label for="description">Description :</label><br>
                <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>
            </div>
            <div class="form-group">
                <input type="submit" value="Soumettre">
            </div>
        </form>
    </div>    
</body>
</html>
