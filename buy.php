<?php
session_start();
if (isset($_POST['buy'])) {
    $totalPrice = 0.0;
    $items = [];
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $price = str_replace(',', '', $item['price']);
            $totalPrice += (float)$price;
            $items[] = $item['description'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Page</title>
</head>
<link rel="stylesheet" href="buy.css">
<body>
    <header>
        <nav>
            <a  style="margin-top : 5px;" href="home.php">Home</a>
            <a style="margin-top : 5px;" href="shop.php">Shop</a>
            <a style="margin-top : 5px;" href="my_orders.php">My Orders</a>
            <a style="margin-top : 5px;" href="new_arrivals.html">New Arrivals</a>
            <a style="margin-top : 5px;" href="cart.php">Cart</a>
            <input style="border-radius: 20px ; height: 30px; padding: 10px; margin-top: 10px; " type="search" class="search-bar"  placeholder="Search" /> 
          
    </header>
    <h1 style="margin -top :200px; margin-left: 450px;" >Billing Summary</h1>
    <div class="purchase-details">
        <h2>Products:</h2>
        <ul>
            <?php
            foreach ($items as $item) {
                echo "<li>$item</li>";
            }
            ?>
        </ul>
        <h2>Total Price: ₹<?php echo number_format($totalPrice, 2); ?></h2>
        <form action="order_confirmation.php" method="POST">
            <button type="submit" class="confirm-btn">Confirm Purchase</button>
        </form>
    </div>
</body>
</html>
