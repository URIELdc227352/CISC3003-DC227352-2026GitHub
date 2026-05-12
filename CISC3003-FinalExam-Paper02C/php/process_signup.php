<?php
require 'connect.php';

// C.02: Validate the signup data on the server in PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // 简单验证
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        die("Invalid input data.");
    }
    
    // 密码加密 (安全最佳实践)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // C.08: 生成邮箱确认 Token (模拟功能)
    $verify_token = bin2hex(random_bytes(16));
    
    // C.03: Save the signup data to a MySQL database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, verify_token) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $verify_token);
    
    if ($stmt->execute()) {
        echo "<h2>Registration successful!</h2>";
        echo "<p>Please <a href='../login.php'>Login here</a>.</p>";
        echo "<p><small>Debug Note: Your verification token is: $verify_token (C.08 logic initialized)</small></p>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>