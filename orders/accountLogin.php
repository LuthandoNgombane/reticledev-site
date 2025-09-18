

<!DOCTYPE html>
<html>
<head>
    <title>Login - Reticle Dev Store Login</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="icon" type="image/x-icon" href="../reticle-dev.jpg" />
    <style>
        html, body, h1, h2, h3, h4 {
            font-weight: bold; 
            font-family: "blanka", sans-serif;
        }

        img {
            mix-blend-mode: multiply;
        }

        .w3-tag, .fa { cursor:pointer; }
        .w3-tag { height:15px; width:12px; padding:0; margin-top:2px; }
            
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

        /* Hide scrollbar */
        ::-webkit-scrollbar {
            display: none;
        }

        html {
            scrollbar-width: none;
        }

        body {
            -ms-overflow-style: none;
        }
    </style>
</head>
<body 
style="background-image: url('../Watermark.jpg'); 
      background-size: auto; 
      background-repeat: no-repeat; 
      background-attachment: fixed; 
      background-position: center; 
      background-position-y: 35px;">

   <div class="w3-top" style="margin-top: 2px; background-color: transparent;">
        <div class="w3-row w3-medium">
            <div class="w3-col s12 m3 l3 w3-left" style="padding: 10px;">
                <img src="../max_logo.jpg" alt="Logo" onclick="redirectToHome();">
            </div>
        </div>
    </div>

    <div class="w3-content w3-padding" style="margin-top: 110px;">
        <h3>Login to Your Account</h3>
        
        <!-- Login Form -->

        <div class="w3-card w3-margin w3-padding">
            <form method="POST">
                <label>Email:</label>
                <input class="w3-input w3-border" type="email" name="email" ><br>
                <label>Password:</label>
                <input class="w3-input w3-border" type="password" name="password" ><br>
                <button class="w3-button w3-blue" type="submit" onclick="redirectToAccount();">Login</button>
            </form>
        </div>
    </div>

    <div class="w3-container w3-center w3-padding">
        <p>No account? <a href="accountRegister.php" class="w3-button w3-green">Register</a></p>
    </div>

    <script>
        // Redirect to home page    
        function redirectToAccount() {
            window.location.href = "account.php";
        }
        
        function redirectToHome() {
            window.location.href = "../index.php";
        }
        
        
    </script>
</body>
</html>
