<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'projetinformations.php'; 
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/projet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>projet</title>
</head>
<body>
    <div class="projetpage">
    <form action="projet.php" method="POST">
        <label for="titre">Title :</label><br>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Soumettre">
    </form>
    </div>    


</body>
</html>