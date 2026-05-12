<?php
session_start();
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT id, name, password, is_verified, created_at FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        // 验证密码
        if (password_verify($password, $user['password'])) {
            
            // C.08: 检查用户是否已确认邮箱
            if ($user['is_verified'] == 0) {
                // 为了演示 C.08，我们先阻止登录并提示需要验证
                die("Account not verified. Please confirm your email address first. <br><a href='../login.php'>Back</a>");
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['joined_at'] = $user['created_at'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>