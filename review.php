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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_name']) && isset($_POST['review_text'])) {
        $productName = $_POST['product_name'];
        $reviewText = $_POST['review_text'];
        
       
        $targetDir = "uploads/";
        

        $fileName = uniqid() . "_" . basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        
        
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        
        if (in_array($fileType, $allowTypes)) {
           
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
      
                $insertReviewStmt = $conn->prepare("INSERT INTO review (username, product_name, review, review_image) VALUES (?, ?, ?, ?)");
                $insertReviewStmt->bind_param("ssss", $username, $productName, $reviewText, $fileName);
                
                if ($insertReviewStmt->execute()) {
                  
                    echo "<script>alert('Review added successfully!');</script>";
                } else {
                    echo "<script>alert('Error adding review.');</script>";
                }
                
                $insertReviewStmt->close();
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        } else {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed to upload.');</script>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
        body {
            margin: 0;
            background-color: #000;
            color: #eee;
            font-family: 'Poppins', sans-serif;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: black;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            height: 30px;
            padding: 0px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="file"] {
            padding-top: 12px;
        }
        .form-group button {
            background-color: #0D66EF;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 225px;
        }
        .form-group button:hover {
            background-color: #004489;
        }
    </style>
</head>
<body>
    <h2 style="margin-left:300px;" >Product Review</h2>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="file">Upload Image (Optional):</label>
            <input type="file" id="file" name="file">
        </div>
        <div class="form-group">
            <button type="submit">Submit Review</button>
        </div>
    </form>

</body>
</html>
