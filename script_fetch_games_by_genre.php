<?php
// Include the necessary files
require_once('session_manager.php');
include 'php_scripts.php';

// Check if the genre ID is provided
if (isset($_GET['genre_id'])) {
    // Get the genre ID from the request
    $genreId = $_GET['genre_id'];

    // Fetch the product IDs for the given genre
    $products = getRandomProductIdsByGenre($genreId, 20); // Assuming 20 products per genre

    // Initialize the games HTML
    $gamesHTML = '';

    // Check if there are any products
    if (!empty($products)) {
        // Loop through each product and fetch the game details
        foreach ($products as $product) {
            // Fetch game details by product ID
            $gameDetails = getProductDetails($product['ID']);

            if ($gameDetails) {
                // Ensure image and title are properly set and sanitized
                $imageSrc = htmlspecialchars($gameDetails['Image1'] ?? 'path/to/default-image.jpg');
                $title = htmlspecialchars($gameDetails['Title'] ?? 'No title available');
                $platformNames = isset($gameDetails['PlatformNames']) && is_array($gameDetails['PlatformNames']) ? implode(', ', $gameDetails['PlatformNames']) : 'Various platforms';
                $price = $gameDetails['Price'] ?? 0;
            
                // Calculate new price based on discount
                $discountedPrice = $price * (1 - $product['Discount']);
                $discountedPrice = round($discountedPrice, 2);
                $discountPercentage = $product['Discount'] * 100;
            
                // Generate HTML for the game
                $gamesHTML .= '<div class="game">';
                $gamesHTML .= '<a href="Product_Page.php?id=' . htmlspecialchars($product['ID']) . '"><img src="' . $imageSrc . '" alt="Game cover for ' . $title . '"></a>';
                $gamesHTML .= '<a href="Product_Page.php?id=' . htmlspecialchars($product['ID']) . '"><h3>' . $title . '</h3></a>';
                $gamesHTML .= '<p>' . $platformNames . '</p>';
            
                if ($price == 0) {
                    $gamesHTML .= '<span>Free to Play</span>';
                } else if ($discountedPrice < $price) {
                    $gamesHTML .= '<span> Sale Price: £' . htmlspecialchars(number_format($discountedPrice, 2)) . ' - ' . htmlspecialchars($discountPercentage) . '% off </span>';
                } else {
                    $gamesHTML .= '<span>£' . htmlspecialchars(number_format($price, 2)) . '</span>';
                }
            
                $gamesHTML .= '</div>';
            } else {
                $gamesHTML .= '<p>Game details not found for product ID: ' . htmlspecialchars($product['ID']) . '</p>';
            }
            
        }
    } else {
        // If there are no items available, print a message
        $gamesHTML .= "<p>Sorry, we don't have any items available for this genre right now.</p>";
        $gamesHTML .= "<p>Please check back later as we continue to add new games almost everyday.</p>";
    }

    // Output the games HTML
    echo $gamesHTML;
} else {
    // If genre ID is not provided, return an error message
    echo 'Error: Genre ID is missing.';
}
?>
