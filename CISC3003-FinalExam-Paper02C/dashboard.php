<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
    <p>You are now logged in to your private dashboard.</p>
    
    <div style="background: #f4f4f4; padding: 20px; border-radius: 8px; color: #333;">
        <strong>Membership Status:</strong> Active<br>
        <strong>Member Since:</strong> <?php echo date("F j, Y", strtotime($_SESSION['joined_at'])); ?>
    </div>

    <p><a href="logout.php">Log Out</a></p>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi_DC227352_2026
    </footer>
</body>
</html>