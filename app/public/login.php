<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <h1>Login</h1>
        <form action="../src/authenticate.php" method="post">
            <div class="input-group">
                <label for="email">
                    <i class="fas fa-user"></i>
                </label>
                <input type="email" name="email" placeholder="Email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" required>
            </div>
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
            <input type="hidden" name="login" value="1">
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</div>
</body>
</html>
