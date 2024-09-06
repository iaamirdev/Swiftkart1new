<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script>
        setTimeout(function() {
            window.location.href = 'home.php';
        }, 5000); 
    </script>
</head>
    <style>

body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #000;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

.thank-you-message {
    background-color: #1F1F26;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.thank-you-message h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.thank-you-message p {
    font-size: 1.2rem;
}

.emoji {
    font-size: 1.5rem;
}

    </style>
<body>
    <div class="thank-you-message">
        <h2>Thanks for purchasing!</h2>
        <p>Have a great day! <span class="emoji">&#x1F60A;</span></p>
    </div>
</body>
</html>
