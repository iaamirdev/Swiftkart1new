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

    public function getConnection() {
        return $this->conn;
    }
}

function validateEmail($email) {
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address";
        header("location:signup.php");
        exit();
    }
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function insertUser($conn, $username, $email, $password) {
    $stmt = $conn->prepare("INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['username'] = $username;

        $user_id = $stmt->insert_id; 
        $_SESSION['user_id'] = $user_id; 


        header("location:home.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to register user";
        header("location:signup.php");
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['ur'];
    $email = $_POST['email'];

    validateEmail($email);

    $password1 = $_POST['password'];
    $password = hashPassword($password1);

    $db = new Database('localhost', 'root', '', 'login');
    $conn = $db->getConnection();

    insertUser($conn, $username, $email, $password);
}
?>
