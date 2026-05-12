<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario C - Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Reset Password</h1>
    <p>Enter your email address to receive a secure password reset link.</p>
    
    <form action="php/process_reset.php" method="POST">
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Send Real Reset Link</button>
    </form>
    <p><a href="login.php">Back to Login</a></p>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi_DC227352_2026
    </footer>
</body>
</html>