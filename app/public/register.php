<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <div class="register-container">
        <div class="register">
            <h1>Create an Account</h1>
            <form action="../src/authenticate.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" name="username" type="text" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="form-group">
                    <input name="register" type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
