<?php
session_start();

class Database {
    protected $conn;

    public function __construct($host, $user, $password, $database) {
        $this->conn = new mysqli($host, $user, $password, $database);
        if ($this->conn->connect_error) {
            die('Connection Failed: ' . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

class Cart extends Database {

    public function __construct() {
        parent::__construct('localhost', 'root', '', 'login');
    }

    public function addItemToCart($itemId) {
        $stmt = $this->conn->prepare("SELECT description, colour, size, price, stock, image FROM phones WHERE phoneid=?");
        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($description, $colour, $size, $price, $stock, $image);
            $stmt->fetch();

            $_SESSION['cart'][] = array(
                'description' => $description,
                'colour' => $colour,
                'size' => $size,
                'price' => $price,
                'stock' => $stock,
                'image' => $image
            );

            echo "Item added to cart successfully";
        } else {
            echo "Unable to add item to cart";
        }

        $stmt->close();
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $cart = new Cart();
    $itemId = $_POST['id'];
    $cart->addItemToCart($itemId);
}
?>



