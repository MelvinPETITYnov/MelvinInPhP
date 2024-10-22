<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'informations.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cv.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Profil de l'utilisateur</title>
</head>
<body>

    <!-- Formulaire pour saisir les informations de cv et envoyé vers profile.php -->
    <form action="profile.php" method="post" enctype="multipart/form-data">
    <div class="profile-picture">
     <input type="file" id="fileInput" name="profileImage" accept="image/*" onchange="previewImage(event)">
     <img id="profileImg" src="<?php echo !empty($profile_picture) ? htmlspecialchars($profile_picture) : ''; ?>" alt="Profile Picture" style="display: <?php echo !empty($profile_picture) ? 'block' : 'none'; ?>;" />
    </div>


        <label for="profession">Profession:</label>
        <input type="text" id="profession" name="profession" value="<?php echo htmlspecialchars($profession); ?>" required>

        <label for="age">Âge:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

        <label for="sex">Sexe:</label>
        <select id="sex" name="sex" required>
            <option value="Masculin" <?php echo (isset($sex) && $sex == 'Masculin') ? 'selected' : ''; ?>>Homme</option>
            <option value="Feminin" <?php echo (isset($sex) && $sex == 'Feminin') ? 'selected' : ''; ?>>Femme</option>
            <option value="Poubelle Deluxe Phantom Sensor Eko 45L inox mat" <?php echo (isset($sex) && $sex == 'Poubelle Deluxe Phantom Sensor Eko 45L inox mat') ? 'selected' : ''; ?>>Poubelle Deluxe Phantom Sensor Eko 45L inox mat</option>
        </select>

        <label for="address">Adresse:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

        <label for="phone">Téléphone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

        <label for="bio">Biographie:</label>
        <textarea id="bio" name="bio" required><?php echo htmlspecialchars($bio); ?></textarea>

        <label for="skills">Compétences:</label>
        <textarea id="skills" name="skills" required><?php echo htmlspecialchars($skills); ?></textarea>
        <input type="submit" value="Générer ...">
    </form>

<script>
function previewImage(event) {
    const img = document.getElementById('profileImg');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>
</body>
</html>
