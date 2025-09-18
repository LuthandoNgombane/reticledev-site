<?php
session_start();

// Simulate cart items for demonstration purposes
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Example of cart items for this demo
$cart_items = $_SESSION['cart'];

// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user'])) {
    header('Location: accountLogin.php');
    exit;
}

$total_price = 0; // Calculate total price of cart items
foreach ($cart_items as $item) {
    switch ($item) {
        case 'Basic Plan':
            $total_price += 400;
            break;
        case 'Standard Plan':
            $total_price += 600;
            break;
        case 'Premium Plan':
            $total_price += 900;
            break;
        case 'Database Management':
            $total_price += 200;
            break;
    }
}

// PayFast integration logic
$payfast_url = 'https://www.payfast.co.za/eng/process';
$merchant_id = 'your_merchant_id';
$merchant_key = 'your_merchant_key';

// Generate payment data
$payment_data = [
    'merchant_id' => $merchant_id,
    'merchant_key' => $merchant_key,
    'amount' => number_format($total_price, 2, '.', ''),
    'item_name' => 'Order from Reticle Dev Store',
    'item_description' => 'Items: ' . implode(', ', $cart_items),
    'return_url' => 'https://yourwebsite.com/payment-success.php',
    'cancel_url' => 'https://yourwebsite.com/payment-cancel.php',
    'notify_url' => 'https://yourwebsite.com/payment-notify.php',
    'email_address' => $_SESSION['user']['email'], // Assuming user email is stored in session
];

// Step 1: Generate the payment data hash
$payfast_data = http_build_query($payment_data);
$signature = md5($payfast_data . '&' . $merchant_key);
$payment_data['signature'] = $signature;

// Step 2: Send to PayFast for payment processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle order submission by redirecting to PayFast
    header('Location: ' . $payfast_url . '?' . http_build_query($payment_data));
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Reticle Dev Store</title>
    
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
        <h3>Checkout</h3>
        
        <!-- Cart Summary -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Your Cart</h4>
            <table class="w3-table">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item); ?></td>
                        <td>
                            <?php 
                            $price = 0;
                            switch ($item) {
                                case 'Basic Plan':
                                    $price = 400;
                                    break;
                                case 'Standard Plan':
                                    $price = 600;
                                    break;
                                case 'Premium Plan':
                                    $price = 900;
                                    break;
                                case 'Database Management':
                                    $price = 200;
                                    break;
                            }
                            echo "R" . number_format($price, 2);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>R<?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
            </table>
        </div>

        <!-- Billing Information Form -->
        <div class="w3-card w3-margin w3-padding">
            <h4>Billing Information</h4>
            <form method="POST">
                <label for="name">Full Name:</label>
                <input class="w3-input w3-border" type="text" name="name" required><br>
                
                <label for="address">Shipping Address:</label>
                <input class="w3-input w3-border" type="text" name="address" required><br>

                <button class="w3-button w3-blue" type="submit">Proceed to PayFast</button>
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
