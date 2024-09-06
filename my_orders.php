<?php
session_start();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    
    header("Location: login.php");
    exit();
}


$conn = new mysqli('localhost', 'root', '', 'login');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$stmt = $conn->prepare("SELECT username FROM signup WHERE secondid = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();

if (!empty($username)) {
    $orders = [];
    $query = "SELECT product_name, total_price FROM booking WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    margin: 0;
    background-color: #000;
    color: #eee;
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
}

a {
    text-decoration: none;
    color: inherit;
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

header a {
    color: #eee;
    padding: 10px 20px;
    transition: background-color 0.3s, color 0.3s;
}

header a:hover {
    background-color: #555;
    color: #fff;
}


        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            margin-top: 0.5%;
        }

        .search-bar {
            height: 30px;
            border-radius: 20px;
            padding: 0 10px 0 35px;
            border: 1px solid #444;
            background-color: #ffffff;
            color: #333; 
            transition: border-color 0.3s;
            margin-right: 10px; 
        }

        .search-bar:focus {
            outline: none;
            border-color: #0071E3;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            font-size: 16px;
            color: #ccc;
            pointer-events: none;
        }

        .dropdown {
            position: relative;
        }

        .dropdown button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #111;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #eee;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #0071E3;
            color: #fff;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover button {
            background-color: #0071E3;
        }

        .add-review-btn {
            background-color: #0D66EF;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s;
        }

        .add-review-btn:hover {
            background-color: #004489;
        }

       
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            color: #333; 
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: 600;
            color: #333;
        }

        table td {
            background-color: #fff;
            color: #666;
        }


        .search-bar {
    margin-top: 0.5%;
    height: 30px;
    border-radius: 20px;
    padding-left: 10px;
}

    </style>
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
    
    <h2 style="font-family: 'Poppins', sans-serif; margin-left: 130px; " >My Orders</h2>

    <?php if (!empty($orders)): ?>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Total Price</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['product_name']; ?></td>
                    <td>₹<?php echo number_format($order['total_price'], 2); ?></td>
                    <td>
                        <form action="review.php" method="post">
                            <input type="hidden" name="product_name" value="<?php echo $order['product_name']; ?>">
                            <button  class="add-review-btn" type="submit">Add Review</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>

</body>
</html>
