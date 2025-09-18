<?php
session_start();

// Simulating user data and order progress for demonstration purposes
if (!isset($_SESSION['user'])) {
    header('Location: accountLogin.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_details'])) {
        // Simulate saving updated user data
        $_SESSION['user']['name'] = $_POST['name'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['address'] = $_POST['address'];
        $_SESSION['user']['card_number'] = $_POST['card_number'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Account - Reticle Dev Store</title>
    
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

        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            height: 20px;
            background-color: #4caf50;
            text-align: center;
            color: white;
            line-height: 20px;
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
        <h3>Your Account</h3>
        
        <!-- User Info Form -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Personal Details</h4>
            <form method="POST">
                <label>Name:</label>
                <input class="w3-input w3-border" type="text" name="name" value="<?php echo $_SESSION['user']['name']; ?>" required><br>
                <label>Email:</label>
                <input class="w3-input w3-border" type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required><br>
                <label>Address:</label>
                <input class="w3-input w3-border" type="text" name="address" value="<?php echo $_SESSION['user']['address']; ?>" required><br>
                <label>Card Number:</label>
                <input class="w3-input w3-border" type="text" name="card_number" value="<?php echo $_SESSION['user']['card_number']; ?>" required><br>
                <button class="w3-button w3-blue" type="submit" name="update_details" onclick="redirectToEditAccount();" >Update Details</button>
            </form>
        </div>
        
        <!-- Purchase History -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Purchase History</h4>
            <?php if (!empty($_SESSION['user']['purchase_history'])): ?>
                <ul class="w3-ul">
                    <?php foreach ($_SESSION['user']['purchase_history'] as $order): ?>
                        <li class="w3-bar">
                            <span class="w3-bar-item">Order ID: <?php echo $order['order_id']; ?> - Status: <?php echo $order['status']; ?></span>
                            <div class="progress-container">
                                <div class="progress-bar" style="width: <?php echo $order['progress']; ?>%;">
                                    <?php echo $order['progress']; ?>%
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>You have no purchase history.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="w3-container w3-center w3-padding">
        <a href="store.php" class="w3-button w3-green">Continue Shopping</a>
    </div>

    <script>
        // Redirect to home page    
        function redirectToHome() {
            window.location.href = "../index.php";
        }
        
        function redirectToEditAccount() {
            window.location.href = "accountEdit.php";
        }
    </script>
</body>
</html>
