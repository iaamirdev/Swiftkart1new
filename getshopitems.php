<?php

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

class PhoneShop extends Database {

    public function __construct() {
        parent::__construct('localhost', 'root', '', 'login');
    }

    public function getPhones($searchTerm) {
        $phones = array();

        // Get phones matching the search term
        $stmt = $this->conn->prepare("SELECT phoneid, description, deal, delivery, installation, image FROM phones WHERE phonename=?");
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($phoneid, $description, $deal, $delivery, $installation, $image);
            while ($stmt->fetch()) {
                $phones[] = array(
                    'phoneid' => $phoneid,
                    'description' => $description,
                    'deal' => $deal,
                    'delivery' => $delivery,
                    'installation' => $installation,
                    'image' => $image
                );
            }
        }

        // Get phones not matching the search term
        $stmt = $this->conn->prepare("SELECT phoneid, description, deal, delivery, installation, image FROM phones WHERE phonename!=?");
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($phoneid, $description, $deal, $delivery, $installation, $image);
            while ($stmt->fetch()) {
                $phones[] = array(
                    'phoneid' => $phoneid,
                    'description' => $description,
                    'deal' => $deal,
                    'delivery' => $delivery,
                    'installation' => $installation,
                    'image' => $image
                );
            }
        }

        return $phones;
    }

    public function displayPhones($searchTerm) {
        $phones = $this->getPhones($searchTerm);
        $shopHtml = '';

        foreach ($phones as $phone) {
            $shopHtml .= '<div class="shop3">';
            $shopHtml .= '<div class="shop31"><img src="' . $phone['image'] . '"></div>';
            $shopHtml .= '<div class="shop32">';
            $shopHtml .= '<h2>' . $phone['description'] . '</h2>';
            $shopHtml .= '<h2>' . $phone['deal'] . '</h2>';
            $shopHtml .= '<h3>' . $phone['delivery'] . '</h3>';
            $shopHtml .= '<h3>' . $phone['installation'] . '</h3>';
            $shopHtml .= '<div class="shopb">';
            $shopHtml .= '<button class="add-to-cart" data-id="' . $phone['phoneid'] . '">Add to Cart</button>';
            $shopHtml .= '<button class="ibutton">Tech Specs</button>';
            $shopHtml .= '</div>';
            $shopHtml .= '</div>';
            $shopHtml .= '</div>';
        }

        echo $shopHtml;
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dynamicphone'])) {
    $shop = new PhoneShop();
    $searchTerm = $_POST['dynamicphone'];
    $shop->displayPhones($searchTerm);
}

?>
