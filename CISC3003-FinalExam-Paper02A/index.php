<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenario A - Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>User Registration</h1>

    <form action="php/process.php" method="POST">
        

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="bio">Short Bio:</label>
        <textarea id="bio" name="bio" rows="4" required></textarea>

        <label for="country">Country:</label>
        <select id="country" name="country">
            <option value="Macau">Macau</option>
            <option value="China">Mainland China</option>
            <option value="Other">Other</option>
        </select>

        <fieldset>
            <legend>Gender:</legend>
            <label><input type="radio" name="gender" value="Male" required> Male</label>
            <label><input type="radio" name="gender" value="Female" required> Female</label>
        </fieldset>


        <label>
            <input type="checkbox" name="subscribe" value="1">
            Subscribe to newsletter
        </label>

        <button type="submit">Submit Registration</button>
    </form>

  
    <footer>
        <hr>
        CISC3003 Web Programming: Uriel-WuLi-DC227352-2026
    </footer>
</body>
</html>