<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<header>
        <nav>

            <a href="home.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="my_orders.php">My Orders</a>
            <a href="new_arrivals.html">New Arrivals</a>
            <a href="cart.php">Cart</a>
            <input type="search" class="search-bar"  placeholder="Search" />
        </nav> 
    </header>
  
    <div class="out">
          <form action="signupup.php" method="post">
            <div class="inside">

                <div class="one"><h2>Mobile ECOMMERCE</h2></div>  
                  <div class="two"><h2>Manage your account</h2></div>
                  <input type="text" placeholder="Username" name="ur" id="in3">
                  <input type="text" placeholder="Email or Phone Number" name="email" id="in1">
                  <input type="password" placeholder="Your Password" name="password" id="in2">
                  <div class="buttons">
                    <button class="butt2">Sign up</button>
                  </div>
                  <div class="last">
                    <a href="summa.html">Forgot Password?</a>
                  </div>
            
        </div>
        </form>
    </div>
    <?php
    session_start();
    if(isset($_SESSION['error'])){
     echo'<script>alert("'.$_SESSION['error'].'");</script>';
     unset($_SESSION['error']);
}
  ?>
</body>
</html>

