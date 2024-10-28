<?php

// Database connection
$mysqli = new mysqli("db", "root", "root", "cv_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Initialize variables
$profession = $age = $sex = $address = $phone = $bio = $skills = $profile_picture = '';

// Fetch user profile if user is logged in
if (isset($_SESSION['user_id'])) {
    $stmt = $mysqli->prepare("SELECT profession, age, sex, address, phone, bio, skills, profile_picture FROM user_profiles WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($profession, $age, $sex, $address, $phone, $bio, $skills, $profile_picture);
    $stmt->fetch();
    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profession = trim($_POST['profession']);
    $age = (int)$_POST['age'];
    $sex = $_POST['sex'];
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $bio = trim($_POST['bio']);
    $skills = trim($_POST['skills']);

    // Handle profile picture upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $profile_picture = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($_FILES['profileImage']['tmp_name']));
    }

    // Check if user profile exists
    $stmt = $mysqli->prepare("SELECT COUNT(*) FROM user_profiles WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Update user profile
        $stmt = $mysqli->prepare("UPDATE user_profiles SET profession = ?, age = ?, sex = ?, address = ?, phone = ?, bio = ?, skills = ?, profile_picture = ? WHERE user_id = ?");
        $stmt->bind_param("ssssssssi", $profession, $age, $sex, $address, $phone, $bio, $skills, $profile_picture, $_SESSION['user_id']);
    } else {
        // Insert new user profile
        $stmt = $mysqli->prepare("INSERT INTO user_profiles (user_id, profession, age, sex, address, phone, bio, skills, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssss", $_SESSION['user_id'], $profession, $age, $sex, $address, $phone, $bio, $skills, $profile_picture);
    }

    // Execute query and check for errors
    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Close database connection
$mysqli->close();
?>
