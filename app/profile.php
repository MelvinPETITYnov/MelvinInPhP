<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'projetinformations.php'; 
include 'informations.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Profil de l'utilisateur</title>
</head>
<body>



    <!-- TITLE SECTION -->
    <div class="title">
        <h1>Your CV, <?php echo ucfirst(strtolower($_SESSION['username'])); ?>!</h1>
    </div>
    <div class="cvpage">

    <div class="flex-container">
    <!-- Formulaire pour saisir les informations de profil -->
    <div class="profile-picture">
     <img id="profileImg" src="<?php echo !empty($profile_picture) ? htmlspecialchars($profile_picture) : ''; ?>" alt="Profile Picture" style="display: <?php echo !empty($profile_picture) ? 'block' : 'none'; ?>;" />
    </div>
        <div class="name">
            <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </div>

        <p><?php echo htmlspecialchars($profession); ?></p>
        
        <p><?php echo htmlspecialchars($age); ?> Years old</p>

        <p><?php echo ($sex); ?></p>

        <p> <?php echo htmlspecialchars($address); ?></p>

        <p> <?php echo htmlspecialchars($phone); ?></p>

        <p><?php echo htmlspecialchars($bio); ?></p>
        
        <p><?php echo htmlspecialchars($skills); ?></p>
    </div>
    </div>

    <div class="addprojet">
    <a href="projet.php">
        <button> ★ ADD PROJECTS ★ </button>
    </a>
</div>

<div class="projets-container">

<?php


    $mysqli = new mysqli("db", "root", "root", "cv_db");
    
    function afficherProjets($mysqli, $user_id) {
    $sql = "SELECT titre, description FROM projets WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $mysqli->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Affichage des projets
    while ($row = $result->fetch_assoc()) {
        $title = htmlspecialchars($row['titre']);
        $description = htmlspecialchars($row['description']);
        echo '
        <div class="projet">
            <h2>' . $title . '</h2>
            <p>' . $description . '</p>
        </div>';
    }
    echo '</div>';
    // Fermer la requête
    $stmt->close();
}

// Appel de la fonction pour afficher les projets
$user_id = $_SESSION['user_id'];
afficherProjets($mysqli, $user_id);
?>

</div>
    <script>
function previewImage(event) {
    const img = document.getElementById('profileImg');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>
</body>
</html>
