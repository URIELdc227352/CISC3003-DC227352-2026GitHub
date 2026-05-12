<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario C - Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Login</h1>
    
    <form action="php/process_login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <p>Forgot password? <a href="reset_password.php">Reset here</a></p>
    <p>Don't have an account? <a href="register.php">Sign up here</a></p>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi_DC227352_2026
    </footer>
</body>
</html>