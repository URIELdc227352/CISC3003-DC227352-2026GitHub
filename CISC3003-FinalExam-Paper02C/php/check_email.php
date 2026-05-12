<?php
require 'connect.php';

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<span style='color: red;'>Email already exists!</span>";
    } else {
        echo "<span style='color: green;'>Email is available!</span>";
    }
    $stmt->close();
}
?>