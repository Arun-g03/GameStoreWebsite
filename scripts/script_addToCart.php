<?php
//This code is to handle the shopping basket and add items to the cart.
//
session_start();
require_once 'session_manager.php';

// Print the received POST data for debugging
echo "Received POST data: <br>";
print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1; // Assuming quantity is 1 if not provided

    // Print the productId and quantity for debugging
    echo "Adding product to cart. Product ID: $productId <br>";

    addToCart($productId, $quantity);
}
?>
