<?php
session_start();

function isCartNotEmpty() {
    return isset($_SESSION['cart']) && !empty($_SESSION['cart']);
}

function generateCartItemHtml($item) {
    $html  = '<div class="sp3">';
    $html .= '<div class="sp31"><img src="' . htmlspecialchars($item['image']) . '"></div>';
    $html .= '<div class="sp32">';
    $html .= '<h2>Description: ' . htmlspecialchars($item['description']) . '</h2>';
    $html .= '<h2>Colour: ' . htmlspecialchars($item['colour']) . '</h2>';
    $html .= '<h2>Size: ' . htmlspecialchars($item['size']) . '</h2>';
    $html .= '<h3>Price: ' . htmlspecialchars($item['price']) . '</h3>';
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

function displayCart() {
    if (isCartNotEmpty()) {
        $cartHtml = '';
        foreach ($_SESSION['cart'] as $item) {
            $cartHtml .= generateCartItemHtml($item);
        }
        echo $cartHtml;
    } else {
        echo "<p>No items in cart</p>";
    }
}

// Main Execution
displayCart();
?>
