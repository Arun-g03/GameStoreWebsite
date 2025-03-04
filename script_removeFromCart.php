<?php
//function to remove a product from the cart
// Start the session
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product ID sent via POST
    $productId = $_POST['productId'];

    // Check if the session cart array exists
    if (isset($_SESSION['cart'])) {
        // Check if the specified product exists in the cart
        if (isset($_SESSION['cart'][$productId])) {
            // Remove the specified product from the cart
            unset($_SESSION['cart'][$productId]);
            // Send a success response
            http_response_code(200);
            echo "Product removed from cart successfully.";
        } else {
            // Product does not exist in cart
            http_response_code(404);
            echo "Product not found in cart.";
        }
    } else {
        // Cart does not exist in session
        http_response_code(404);
        echo "Cart not found in session.";
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
