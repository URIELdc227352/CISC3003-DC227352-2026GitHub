<?php
require 'connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // 1. 检查邮箱是否存在
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // 2. 生成极其安全的重置 Token
        $reset_token = bin2hex(random_bytes(16));
        
        // 🚨【核心修复】3. 将生成的 Token 更新到数据库中，以便后续比对
        $update_token_stmt = $conn->prepare("UPDATE users SET verify_token = ? WHERE email = ?");
        $update_token_stmt->bind_param("ss", $reset_token, $email);
        $update_token_stmt->execute();
        $update_token_stmt->close();
        
        // 4. 发送真实邮件
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            
            // 🚨 务必填写你真实的 Gmail 和 16位应用专用密码
            $mail->Username   = 'uriel1031@gmail.com';
            $mail->Password   = 'tdqh covi ejdt elzf';
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            
            $mail->setFrom('no-reply@yourdomain.com', 'System Admin');
            $mail->addAddress($email);
            
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            
            // 拼接包含 Token 的重置链接
            $reset_link = "http://localhost/Paper02C/reset_action.php?token=" . $reset_token;
            
            $mail->Body = "Hello,<br><br>You requested a password reset. Click the link below to set a new password:<br><br>
                           <a href='{$reset_link}'>{$reset_link}</a><br><br>
                           If you did not request this, please ignore this email.";
            
            $mail->send();
            echo "<h2>Success!</h2><p>A secure reset link has been sent to $email.</p>";
            echo "<a href='../login.php'>Back to Login</a>";
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No account found with that email.";
    }
    $stmt->close();
    $conn->close();
}
?>