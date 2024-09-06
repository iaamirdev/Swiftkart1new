<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'D:\xam\htdocs\zwt\Wtpro\vendor\autoload.php'; 

session_start();


$conn = new mysqli('localhost', 'root', '', 'login');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM signup WHERE secondid = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();



$totalPrice = 0.0;
$items = [];
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $price = str_replace(',', '', $item['price']);
        $totalPrice += (float)$price;
        $items[] = $item['description'];
    }
}


$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.mailgun.org';  
    $mail->SMTPAuth   = true;
    $mail->Username   = 'postmaster@sandboxfd716571126445a9aa89222e3876c8b9.mailgun.org'; 
    $mail->Password   = '26f5209bb18efae0690a3804b020bab3-623e10c8-3cd62b07'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; 

   
    $mail->setFrom('your_email@example.com', 'Your Name'); 
    $mail->addAddress($email, $username); 

    $mail->isHTML(true); 
    $mail->Subject = 'Order Confirmation';
    
    
    $emailContent = "<p>Thank you for your purchase, $username!</p>";
    $emailContent .= "<p>Your order details:</p>";
    $emailContent .= "<ul>";
    foreach ($items as $item) {
        $emailContent .= "<li>$item</li>";
    }
    $emailContent .= "</ul>";
    $emailContent .= "<p>Total Price: ₹" . number_format($totalPrice, 2) . "</p>";
    $emailContent .= "<p>Your order will be delivered in 3-4 Business Days</p>";

    $mail->Body    = $emailContent;


    $mail->send();

    $productNames = implode(', ', $items); 
    $insertStmt = $conn->prepare("INSERT INTO booking (username, product_name, total_price) VALUES (?, ?, ?)");
    $insertStmt->bind_param("ssd", $username, $productNames, $totalPrice);
    
    
    if ($insertStmt->execute()) {
       
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $insertStmt->close();
} catch (Exception $e) {
    echo "Message could not be sent. {$mail->ErrorInfo}";
}

$conn->close();
?>
