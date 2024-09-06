<?php
session_start();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'login');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT secondid, username, password FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username, $hashedpassword);
        $stmt->fetch();
        
        if (password_verify($password, $hashedpassword)) {
            $_SESSION['user_id'] = $user_id; 
            $_SESSION['username'] = $username; 
            header("location: home.php");
            exit();
        } else {
            echo "Invalid credentials";
            header("location: sign.php");
            exit();
        }
    } else {
        echo "User not found";
        header("location: sign.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
