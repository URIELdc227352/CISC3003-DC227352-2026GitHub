<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenario B - Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Contact Us</h1>
    
    <form action="php/process.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required minlength="2">

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>

    <footer>
        <hr>
        CISC3003 Web Programming: Uriel WuLi-DC227352-2026
    </footer>
</body>
</html>