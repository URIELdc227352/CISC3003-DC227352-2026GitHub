<?php
// B.05 准备：开启 Session 用于 PRG 模式传递消息
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// 引入你刚才放进来的 PHPMailer 核心文件
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// B.05: PRG 模式的 "Post" 阶段
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));
    
    $mail = new PHPMailer(true);
    
    try {
        // B.04: Debug problems - 开启详细调试输出 (截取这个输出画面作为 B.04)
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        
        // B.03: Send email using PHPMailer
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'uriel34825@gmail.com';
        $mail->Password   = 'pzwf ewyo mtim osof';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        $mail->setFrom($email, $name);
        $mail->addAddress('test@gmail.com');
        
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Message';
        $mail->Body    = "From: $name\nEmail: $email\n\n$message";
        
        $mail->send();
        
        // 如果奇迹般地发送成功（实际用假密码会失败），走 PRG 模式的 Redirect
        $_SESSION['status'] = "Message sent successfully!";
        header("Location: ../success.php");
        exit();
        
    } catch (Exception $e) {
        // 页面会因为 SMTPDebug 打印海量调试信息，截图后，注释掉上面那行 `$mail->SMTPDebug = SMTP::DEBUG_SERVER;` 即可关闭调试。
        echo "<br><br><strong>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</strong>";
    }
} else {
    // B.05: PRG 模式的 Get/Redirect 拦截 - 防止直接访问 process.php
    header("Location: ../index.php");
    exit();
}
?>