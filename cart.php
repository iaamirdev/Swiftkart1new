<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <?php include 'user1.php'; ?>
    <header>
        <nav>
            <a  style="margin-top : 5px;" href="home.php">Home</a>
            <a style="margin-top : 5px;" href="shop.php">Shop</a>
            <a style="margin-top : 5px;" href="my_orders.php">Categories</a>
            <a style="margin-top : 5px;" href="new_arrivals.html">New Arrivals</a>
            <a style="margin-top : 5px;" href="cart.php">Cart</a>
            <a style="margin-top : 5px;" href="news.php">News</a>
            <input style="border-radius: 20px ; height: 30px; padding: 10px; margin-top: 10px; " type="search" class="search-bar"  placeholder="Search" /> 
            <div class="dropdown">
                <button style="margin-top: 0px;"><img src="image/user.png" height="30px" width="30px"></button>
                <div class="dropdown-content">
                    <?php include 'user2.php'; ?>
                    <a href="#">Learn More</a>
                </div>
            </div>
            <?php include 'user3.php'; ?>
        </nav>
    </header>
    <div class="totalcart">
        <?php
        $priceuh = 0.0;
        function calculateTotalPrice(){
            $total = 0.0;
            foreach($_SESSION['cart'] as $item){
                $price = str_replace(',', '', $item['price']);
                $total += (float)$price;
            }
            return number_format($total, 2);
        }
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $priceuh = calculateTotalPrice();
            echo '<h2>Total price to be paid: ₹'.$priceuh.'</h2>';
        }
        ?>
        <form action="buy.php" method="POST">
            <button type="submit" name="buy" style="background-color : #0D66EF;" class="buy-btn">Buy Now</button>
        </form>
    </div>
    <div class="sp1" id="cartuh">
        <div class="sp2" id="cart-items"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: 'get_cart_items.php',
                method: 'POST',
                success: function(response){
                    $('#cart-items').html(response);
                }
            });
        });
    </script>
</body>
</html>
