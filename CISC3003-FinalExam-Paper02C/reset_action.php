<?php
require 'php/connect.php';

$message = "";
$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid request: No token provided.");
}

// 检查 Token 是否存在
$stmt = $conn->prepare("SELECT id FROM users WHERE verify_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Invalid or expired token.");
}

// 处理新密码提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // 更新密码并清空 Token 防止二次使用
        $update_stmt = $conn->prepare("UPDATE users SET password = ?, verify_token = NULL WHERE id = ?");
        $update_stmt->bind_param("si", $hashed_password, $user['id']);
        
        if ($update_stmt->execute()) {
            $message = "<p style='color: green;'>Password updated successfully! <a href='login.php'>Login now</a></p>";
        } else {
            $message = "<p style='color: red;'>Update failed.</p>";
        }
    } else {
        $message = "<p style='color: red;'>Passwords do not match.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set New Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Set New Password</h1>
    <?php echo $message; ?>
    
    <form method="POST">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required minlength="6">

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required minlength="6">

        <button type="submit">Update Password</button>
    </form>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi + [你的学号] + 2026
    </footer>
</body>
</html>