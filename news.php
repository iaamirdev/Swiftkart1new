<?php
$apiKey = '26d6433caa714b04abc5cd454688362d'; 
$category = 'technology';
$country = 'us';

$url = "https://newsapi.org/v2/top-headlines?country=" . urlencode($country) . "&category=" . urlencode($category) . "&apiKey=" . urlencode($apiKey);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'User-Agent: MyNewsApp/1.0'
));
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpcode == 200) {
    $newsData = json_decode($response, true);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Latest Tech News</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        
    <header>
        <nav>
            <a  style="margin-top : 5px;" href="home.php">Home</a>
            <a style="margin-top : 5px;" href="shop.php">Shop</a>
            <a style="margin-top : 5px;" href="my_orders.php">My Orders</a>
            <a style="margin-top : 5px;" href="new_arrivals.html">New Arrivals</a>
            <a style="margin-top : 5px;" href="cart.php">Cart</a>
            <a  style="margin-top : 5px;" href="news.php" > News </a>
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
        <style>

            
.dropdown {
    position: relative;
    display: inline-block;
}


.dropdown button {
    background-color:black;
    color: white;
    padding: 10px;
    font-size: 16px;
    height: 30px;
    width: 30px;
    border: none;
    cursor: pointer;
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #1F1F26;
    min-width: 160px;
    z-index: 1;
    border-radius: 10px;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}


.dropdown-content a:hover {
    background-color: #ddd;
}


.dropdown:hover .dropdown-content {
    display: block;
}

a {
text-decoration: none;
}

header {
width: 1140px;
max-width: 80%;
margin: auto;
height: 50px;
display: flex;
align-items: center;
position: relative;
z-index: 100;
}

header nav {
display: flex;
gap: 20px;
}
header nav h3{
    color: white;
}

header a {
color: #eee;
padding: 10px 20px;
transition: background-color 0.3s, color 0.3s;
border-radius: 5px;
}

header a:hover {
background-color: #eee;
color: #000;
}
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                background-color: black;
                color: #e0e0e0;
            }
            .container {
                width: 80%;
                margin: 0 auto;
                padding: 20px;
            }
            h1 {
                text-align: center;
                color: #e0e0e0;
            }
            .cards {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            .card {
                background: #1e1e1e;
                width: 30%;
                margin-bottom: 20px;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                transition: transform 0.2s;
            }
            .card:hover {
                transform: scale(1.05);
            }
            .card img {
                width: 100%;
                border-radius: 10px;
            }
            h2 {
                margin: 10px 0;
                font-size: 20px;
                color: #1a73e8;
            }
            p {
                margin: 10px 0;
                color: #b0b0b0;
            }
            small {
                display: block;
                margin-top: 10px;
                color: #999;
            }
            a {
                text-decoration: none;
                color: white;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>


    <body>


    <div class="container">
        
        <h1>Latest Tech News</h1>
        
        <?php
        // Check if the response contains articles
        if ($newsData['status'] == 'ok' && count($newsData['articles']) > 0) {
            echo "<div class='cards'>";
            foreach ($newsData['articles'] as $article) {
                echo "<div class='card'>";
                if (!empty($article['urlToImage'])) {
                    echo "<img src='" . $article['urlToImage'] . "' alt='Article Image'>";
                }
                echo "<h2><a href='" . $article['url'] . "' target='_blank'>" . $article['title'] . "</a></h2>";
                echo "<p>" . $article['description'] . "</p>";
                echo "<p><small>Source: " . $article['source']['name'] . "</small></p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No news found.</p>";
        }
        ?>
    </div>

    </body>
    </html>
    <?php
} else {
    echo "HTTP request failed. Error code: " . $httpcode;
    echo "<br>";
    echo "Response: " . $response;
}
?>
