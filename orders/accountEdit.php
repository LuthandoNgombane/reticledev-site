<?php
session_start();

// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user'])) {
    header('Location: accountLogin.php');
    exit;
}

// Assume user details are stored in session for now, otherwise fetch from database
$user = $_SESSION['user'];

// Handle form submission to update user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update user details (e.g., from a database, here it's simulated)
    $user['name'] = $_POST['name'];
    $user['address'] = $_POST['address'];
    $user['email'] = $_POST['email'];

    // Update the session with new user details
    $_SESSION['user'] = $user;

    // Provide feedback to the user
    $update_message = "Your details have been updated successfully!";
    header('Location: account.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account - Reticle Dev Store</title>
    
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
                <img src="../max_logo.jpg" alt="Logo" onclick="redirectToHome()">
            </div>
        </div>
    </div>

    <div class="w3-content w3-padding" style="margin-top: 110px;">
        <h3>Edit Account</h3>
        
        <!-- Display success message if account is updated -->
        <?php if (isset($update_message)): ?>
            <div class="w3-card w3-margin w3-padding w3-green">
                <p><?php echo $update_message; ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Edit Account Form -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Your Details</h4>
            <form method="POST">
                <label for="name">Full Name:</label>
                <input class="w3-input w3-border" type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
                
                <label for="email">Email:</label>
                <input class="w3-input w3-border" type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
                
                <label for="address">Shipping Address:</label>
                <input class="w3-input w3-border" type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required><br>

                <button class="w3-button w3-blue" type="submit" >Save Changes</button>
            </form>
        </div>
        
        <!-- Order Progress Bar -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Order Progress</h4>
            <div class="w3-progress-container">
                <div class="w3-progressbar w3-green" style="width:50%"></div>
            </div>
            <p>50% of the order is complete</p>
        </div>
    </div>

    <script>
        // Redirect to home page    
        function redirectToHome() {
            window.location.href = "../index.php";
        }
    </script>
</body>
</html>
