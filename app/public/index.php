<?php
session_start();

include '../src/informations.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>
    <div class="profile">
        <a href="profile.php">
            <img id="profileImg" src="<?= !empty($profile_picture) ? htmlspecialchars($profile_picture) : ''; ?>" alt="Profile Picture" style="display: <?= !empty($profile_picture) ? 'block' : 'none'; ?>;" />
        </a>
    </div>

    <!-- TITLE SECTION -->
    <div class="title">
        <h1>WELCOME <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'HERE'; ?></h1>
        <p>Curriculum vitæ</p>
    </div>


    <!-- BUTTON SECTION -->
    <div class="cv">
        <a href="cv.php">
            <button>★ LET'S CREATE ★</button>
        </a>
    </div>
</body>
</html>
