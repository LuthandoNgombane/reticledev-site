<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['item'])) {
    $_SESSION['cart'][] = $_POST['item'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reticle Dev Store</title>
    
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="icon" type="image/x-icon" href="../reticle-dev.jpg" />
    <style>
    
        html,body,h1,h2,h3,h4 {font-weight: "bold"; font-family:"blanka", sans-serif}

        img {
          mix-blend-mode: multiply;
        }
        
        
        .w3-tag, .fa {cursor:pointer}
        
        .w3-tag {height:15px;width:12px;padding:0;margin-top:2px}
            
    
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
            
            
        /*LN : Remove scroll bar from all browsers - w3schools/howto/howto_css_hide_scrollbars*/
        /* For WebKit browsers (Chrome, Safari, Edge) */
        ::-webkit-scrollbar {
            display: none;
        }
        
        /* For Firefox */
        html {
            scrollbar-width: none;
        }
        
        /* For Internet Explorer & Edge */
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
      background-position-y: 35px;"
    >
    
   <div class="w3-top" style="margin-top: 2px; background-color: transparent;">
        <div class="w3-row w3-medium">
            <div class="w3-col s12 m3 l3 w3-left" style="padding: 10px;">
                <img src="../max_logo.jpg" alt="Logo" onclick="redirectToHome()">
            </div>
        </div>
    </div>
    
    <div class="w3-content w3-padding" style="margin-top: 110px;">
        <div class="w3-card w3-margin w3-padding">
            <h3>Basic Plan</h3>
            <p>Hosting, SMS notifications (50/month), email forwarding</p>
            <form method="POST">
                <input type="hidden" name="item" value="Basic Plan">
                <button class="w3-button w3-green" type="submit">Add to Cart</button>
            </form>
        </div>
        
        <div class="w3-card w3-margin w3-padding">
            <h3>Standard Plan</h3>
            <p>All Basic features + PHP WhatsApp chatbot + daily lead email dashboard</p>
            <form method="POST">
                <input type="hidden" name="item" value="Standard Plan">
                <button class="w3-button w3-green" type="submit">Add to Cart</button>
            </form>
        </div>
        
        <div class="w3-card w3-margin w3-padding">
            <h3>Premium Plan</h3>
            <p>All Standard features + AI chatbot + advanced SEO & traffic analysis</p>
            <form method="POST">
                <input type="hidden" name="item" value="Premium Plan">
                <button class="w3-button w3-green" type="submit">Add to Cart</button>
            </form>
        </div>
        
        <div class="w3-card w3-margin w3-padding">
            <h3>Database Management</h3>
            <p>Database services across all plans</p>
            <form method="POST">
                <input type="hidden" name="item" value="Database Management">
                <button class="w3-button w3-green" type="submit">Add to Cart</button>
            </form>
        </div>
    </div>
    
    <div class="w3-container w3-center w3-padding">
        <a href="cart.php" class="w3-button w3-blue">View Cart</a>
    </div>
    
    
    <script>
    
        //LN - Redirect to home page    
        function redirectToHome() 
        {
            window.location.href = "../index.php";
        }
        
    </script>
</body>
</html>
