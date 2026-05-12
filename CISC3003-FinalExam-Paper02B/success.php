<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Success!</h1>
    <p>
        <?php 
            // 显示通过 Session 传过来的成功信息
            if(isset($_SESSION['status'])){
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            } else {
                echo "Action completed.";
            }
        ?>
    </p>
    <a href="index.php">Go Back</a>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi_DC227352_2026
    </footer>
</body>
</html>