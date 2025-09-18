<?php
session_start();

// Handle form submission
// if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
//     \$name = trim(\$_POST['name']);
//     \$email = trim(\$_POST['email']);
//     \$password = password_hash(\$_POST['password'], PASSWORD_DEFAULT);

//     // Store user details in a session (Replace with database storage in production)
//     \$_SESSION['user'] = [
//         'name' => \$name,
//         'email' => \$email
//     ];

//     // Redirect to account page
//     header('Location: account.php');
//     exit;
// }
// ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Reticle Dev Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../reticle-dev.jpg" />
    <style>
        html, body, h1, h2, h3, h4 {
            font-weight: bold; 
            font-family: "Lato", sans-serif;
        }
        .w3-top img {
            max-width: 25%; 
            height: auto;
            vertical-align: middle; 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }
        .w3-top img:hover { 
            transform: translateY(-5px); 
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3); 
        }
    </style>
</head>
<body>
    <div class="w3-top" style="margin-top: 2px; background-color: transparent;">
        <div class="w3-row w3-medium">
            <div class="w3-col s12 m3 l3 w3-left" style="padding: 10px;">
                <img src="../max_logo.jpg" alt="Logo" onclick="redirectToHome()">
            </div>
        </div>
    </div>

    <div class="w3-container w3-padding" style="margin-top: 100px;">
        <h2>Register</h2>
        <form method="POST" class="w3-container w3-card w3-padding">
            <label>Name:</label>
            <input class="w3-input w3-border" type="text" name="name" required>
            
            <label>Email:</label>
            <input class="w3-input w3-border" type="email" name="email" required>
            
            <label>Password:</label>
            <input class="w3-input w3-border" type="password" name="password" required>
            
            <button class="w3-button w3-blue w3-margin-top" type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="accountLogin.php">Login</a></p>
    </div>

    <script>
        function redirectToHome() {
            window.location.href = "../index.php";
        }
    </script>
</body>
</html>
