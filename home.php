<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php
     include 'user1.php';
    ?>
    <header>
        <nav>
            <a  style="margin-top : 5px;" href="home.php">Home</a>
            <a style="margin-top : 5px;" href="shop.php">Shop</a>
            <a style="margin-top : 5px;" href="my_orders.php">My Orders</a>
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

    <section class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="image/samsungfest1.png" alt="Slide 1">
            </div>
            <div class="carousel-slide">
                <img src="image/iphonefest1.webp" alt="Slide 2">
            </div>
            <div class="carousel-slide">
                <img src="image/pixelfest1.webp" alt="Slide 3">
            </div>
            <div class="carousel-slide">
                <img src="image/oneplusfest1.webp" alt="Slide 4">
            </div>
        </div>
        <button class="carousel-btn prev" id="prevBtn">&#10094;</button>
        <button class="carousel-btn next" id="nextBtn">&#10095;</button>
    </section>

    
    <section class="product-cards">
        <a href="index.html">
            <div class="card">
                <div class="card-image">
                    <img src="image/apple15promax.jpg" alt="iPhone 15 Pro Max">
                </div>
                <div class="card-content">
                    <h3>iPhone 15 Pro Max</h3>
                    <p>Latest technology and design</p>
                </div>
            </div>
        </a>
        
        <a href="S24U.html">
            <div class="card">
                <div class="card-image">
                    <img src="image/samsungs24.jpg" alt="Galaxy S24 Ultra">
                </div>
                <div class="card-content">
                    <h3>Samsung Galaxy S24 Ultra</h3>
                    <p>High performance and sleek design</p>
                </div>
            </div>
        </a>
       <a href="Gp8P.html">
        <div class="card">
            <div class="card-image">
                <img src="image/pixel8.jpg" alt="Google Pixel 8 Pro">
            </div>
            <div class="card-content">
                <h3>Google Pixel 8 Pro </h3>
                <p>Smart and powerful</p>
            </div>
        </div>
       </a>
        <a href="Op12P.html">
            <div class="card">
                <div class="card-image">
                    <img src="image/oneplus12.png" alt="OnePlus 12 Pro">
                </div>
                <div class="card-content">
                    <h3>OnePlus 12 Pro</h3>
                    <p>Fast and smooth experience</p>
                </div>
            </div>
        </a>
       
    </section>

    <script src="home.js"></script>
</body>

</html>
