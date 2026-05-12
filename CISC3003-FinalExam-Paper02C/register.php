<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scenario C - Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="js/script.js"></script>
</head>
<body>
    <h1>Create an Account</h1>
    
    <form id="signupForm" action="php/process_signup.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <div id="email-status" style="margin-bottom: 10px;"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="6">

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required minlength="6">

        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Log In</a></p>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi_DC227352_2026
    </footer>
</body>
</html>