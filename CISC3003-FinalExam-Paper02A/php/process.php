<?php

require 'connect.php';

// A.05
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // A.06
    $fullname = filter_var(trim($_POST['fullname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }
    $bio = htmlspecialchars(trim($_POST['bio']));
    $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;
    
    // A.07 & A.08
    // A.10: 
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, bio, country, gender, subscribe) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssi", $fullname, $email, $bio, $country, $gender, $subscribe);

    if ($stmt->execute()) {
        echo "<h2>New record created successfully!</h2>";
        echo "<p>Thank you, " . htmlspecialchars($fullname) . ".</p>";
        echo "<a href='../index.php'>Go Back</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>