<?php
// Include the session manager file
require_once('session_manager.php');

include 'php_scripts.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evolution Digital Game Store</title>
    <link rel="stylesheet" href="CSS_Styles.css"> <!-- Main CSS file -->
    <link rel="Java"href="JScripts.js"> <!-- Main Java Script file -->
    
    
</head>
<body>
<header>
        <div class="Header_container">
            <button onclick="window.location.href='Index.php'">Evolution Game Store</button>
            <nav>
               <ul>
                    <li><a href="Index.php">Home</a></li>
                    <li><a href="Sales.php">Sales</a></li>
                    <li><a href="PC_Games.php">PC Games</a></li>
                    <li><a href="PlayStation_Games.php">PlayStation Games</a></li>
                    <li><a href="Xbox_Games.php">Xbox Games</a></li>
                    <li><a href="Genres.php">Genres</a.</li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="Shopping_Cart.php"><img src="Images/shopping-cart_icon.png" alt="Shopping Cart" class="shopping-cart-icon"></a></li>
                </ul>
            </nav>
            <!-- Search Bar -->
            <div class="search-bar">
                <form action="Search_results.php" method="get">
                    <input type="text" id="searchInput" name="query" placeholder="Thinking of a game? search for it here...">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div class="Login">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Display sign-out button if user is logged in -->
                    <div id="userLoggedIn">
                        <span>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!</span>
                        <button onclick="logoutUser(); return false;">Logout</button>
                    </div>
                <?php else: ?>
                    <!-- Display login/signup link if user is not logged in -->
                    <a href="#" id="loginBtn">Sign Up / Login</a>
                <?php endif; ?>
            </div>


        </div>

        <!-- The modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal_container">
                    <span class="close">&times;</span>
                    <div id="userContainer">
                        <!-- User information will be displayed here -->
                    </div>
                    <div id="loginForm">
                        <!-- Login form -->
                        <h2>Login</h2>
                        <form>
                            <input type="text" id="loginUsername" placeholder="Username" required><br>
                            <input type="password" id="loginPassword" placeholder="Password" required><br>
                            <button type="button" onclick="loginUser()">Login</button>
                        </form>
                        <p>Don't have an account? <a href="SignUp.php">Sign Up</a></p> <!-- Link to the Sign Up page -->
                    </div>
                </div>
            </div>
        </div>


        
        
    </header>




    <section class="hero">
        <div class="container">
            <h2>Sales</h2>
            <p>Find Great Games at Amazing Prices!</p>
        </div>
    </section>









    <section class="product_listings">
    
    <h2>Sale Items</h2>
        <div class="container">
            <?php
            // Retrieve product IDs with discount
            $product_ids = getProductsWithDiscount();

            // Iterate through each product ID and fetch game details
            foreach ($product_ids as $product_id) {
                // Retrieve game details by product ID
                $game_details = getProductDetails($product_id);

                // Check if game details are found
                if ($game_details) {
                    // Display each featured game
                    echo '<div class="product">';
                    echo '<a href="Product_Page.php?id=' . $game_details['ID'] . '"><img src="' . $game_details['Image1'] . '" alt="' . htmlspecialchars($game_details['Title']) . '"></a>';
                    echo '<a href="Product_Page.php?id=' . $game_details['ID'] . '"><h3>' . htmlspecialchars($game_details['Title']) . '</h3></a>';
                    echo '<p>' . htmlspecialchars($game_details['PlatformNames']) . '</p>';

                    // Calculate new price based on discount from the table
                    $discountedPrice = $game_details['Price'] * (1 - $game_details['Discount']);
                    $discountedPrice = round($discountedPrice, 2);
                    $discount = $game_details['Discount'] * 100;

                    // Check if the price is zero
                    if ($discountedPrice == 0) {
                        echo '<span>Free to Play</span>';
                    } else {
                        echo '<span> Sale Price: £' . htmlspecialchars(number_format($discountedPrice, 2)) . ' - ' . $discount . '% off </span>';
                    }

                    echo '<button class="btn add-to-basket" data-product-id="' . $game_details['ID'] . '">Add to Basket</button>';
                    echo '</div>';
                } else {
                    // If game details are not found, display an error message
                    echo '<p>Game details not found for product ID: ' . $product_id . '</p>';
                }
            }
            ?>


                <!-- JavaScript event listener -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Attach event listener to all "Add to Basket" buttons
                        document.querySelectorAll('.add-to-basket').forEach(function(button) {
                            button.addEventListener('click', function() {
                                var productId = this.getAttribute('data-product-id');
                                console.log("Clicked button for product with ID:", productId);
                                addToCart(productId);
                            });
                        });
                    });
                </script>
        </div>
    </section>




    

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved. <a href="Sitemap.php">Sitemap</a></p>
        </div>
    </footer>
    
<script src="JScripts.js" defer></script> <!-- Main JavaScript file -->  
</body>
</html>
