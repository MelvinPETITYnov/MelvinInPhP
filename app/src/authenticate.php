<?php
// Configure error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start();

// Connect to the database
$mysqli = new mysqli("db", "root", "root", "cv_db");

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's a registration or login
    if (isset($_POST['register'])) {
        // Get the registration form data
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Check if the email already exists
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already used
            header("Location: register.php?alert=mail_exists");
            exit();
        }

        // Check that the fields are not empty
        if (empty($username) || empty($email) || empty($password)) {
            die("Please fill in all fields.");
        }

        // Prepare a query to insert the user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);

        // Check if the preparation was successful
        if (!$stmt) {
            die("Error preparing statement: " . $mysqli->error);
        }

        // Hash the password before inserting it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind the parameters and execute the query
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            // Redirect to index.php after successful registration
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Get the login form data
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Check that the fields are not empty
        if (empty($email) || empty($password)) {
            die("Please fill in all fields.");
        }

        // Prepare a query to check the user's credentials
        $sql = "SELECT id, username, password FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        // Check if the preparation was successful
        if (!$stmt) {
            die("Error preparing statement: " . $mysqli->error);
        }

        // Bind the parameters and execute the query
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Save the user's information in the session
                $_SESSION['user_id'] = $id; // User ID
                $_SESSION['email'] = $email; // User email
                $_SESSION['username'] = $username; 
                // Redirect to index.php after successful login
                header("Location: /public/index.php");
                exit();
            } else {
                header("Location: login.php?error=wrong_password");
                exit();
            }
        } else {
            header("Location: login.php?error=user_not_found");
            exit();
        }

        $stmt->close();
    }
}

// Close the connection
$mysqli->close();
?>
