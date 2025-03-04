<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    if ($product_id > 0 && ($type === 'up' || $type === 'down')) {
        try {
            if ($type === 'up') {
                $stmt = $pdo->prepare("UPDATE Reviews SET thumbs_up = thumbs_up + 1 WHERE product_id = ?");
            } else {
                $stmt = $pdo->prepare("UPDATE Reviews SET thumbs_down = thumbs_down + 1 WHERE product_id = ?");
            }
            $stmt->execute([$product_id]);

            // If no rows were affected, it means there was no existing review for this product
            if ($stmt->rowCount() == 0) {
                // Insert a new review record for the product
                if ($type === 'up') {
                    $stmt = $pdo->prepare("INSERT INTO Reviews (product_id, thumbs_up, thumbs_down) VALUES (?, 1, 0)");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO Reviews (product_id, thumbs_up, thumbs_down) VALUES (?, 0, 1)");
                }
                $stmt->execute([$product_id]);
            }

            // Return success response
            echo 'success';
        } catch (PDOException $e) {
            // Handle the error
            echo 'error: ' . $e->getMessage();
        }
    } else {
        // Invalid request
        echo 'error: Invalid product ID or vote type';
    }
} else {
    echo 'error: Invalid request method';
}
?>
