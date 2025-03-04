<!DOCTYPE html>
<html lang="en">
<head>
    <!--  this is a comment-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evolution Digital Game Store</title>
    <link rel="stylesheet" href="CSS_Styles.css"> <!-- Main CSS file -->
    <script src="JScripts.js" defer></script> <!-- Main JAVA Script-->
</head>
<body>
    <?php
    // Include the session manager file
    require_once 'session_manager.php';
    require_once 'php_scripts.php'; // Include the file containing the getProductDetails function

    // Get the cart items
    $cartItems = getCartItems();
    ?>

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

    <!-- Shopping cart basket -->
    <section class="shopping-cart">
        <div class="container">
            <h2>Shopping Basket</h2>
            <div class="cart-items">
            <?php
                $total = 0;
                // Check if the cart is not empty
                if (!empty($cartItems)) {
                    // Loop through the cart items and display each item
                    foreach ($cartItems as $productId => $quantity) {
                        // Fetch product details from the database using $productId
                        $product = getProductDetails($productId);

                        // Check if product details were fetched successfully
                        if ($product) {
                            // Calculate the subtotal for this item with discount applied
                            $discountPercentage = $product['Discount'] * 100;  // Convert discount to percentage
                            $discountedPrice = $product['Price'] * (1 - $product['Discount']); // Apply discount
                            $subtotal = $discountedPrice * $quantity;

                            // Add the subtotal to the running total
                            $total += $subtotal;

                            // Display the product information and quantity
                            echo '<div class="cart-item">';
                            echo '<img src="' . $product['Image1'] . '" alt="' . htmlspecialchars($product['Title']) . '">';
                            echo '<div class="item-details">';
                            echo '<h3>' . htmlspecialchars($product['Title']) . '</h3>';
                            echo '<p>Price: £' . htmlspecialchars(number_format($product['Price'], 2)) . '</p>';
                            echo '<p>Discount: ' . htmlspecialchars(number_format($discountPercentage, 0)) . '%</p>'; // Display discount as a percentage
                            echo '<p>Subtotal: £' . number_format($subtotal, 2) . '</p>'; // Display the subtotal for this item with discount applied
                            echo '<button class="remove-from-cart" data-product-id="' . $productId . '">Remove</button>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<p>Error fetching product details for product ID: ' . $productId . '</p>';
                        }
                    }
                } else {
                    // Display a message if the cart is empty
                    echo '<p>Your shopping basket is empty</p>';
                }
                ?>



                <script>
                    // Attach event listener to all "Remove from Cart" buttons
                    document.querySelectorAll('.remove-from-cart').forEach(function(button) {
                        button.addEventListener('click', function() {
                            var productId = this.getAttribute('data-product-id');
                            console.log("Clicked button to remove product with ID:", productId);
                            removeFromCart(productId);
                        });
                    });
                </script>
            </div>
            <div class="cart-total">
                <h3>Total: £<?php echo number_format($total, 2); ?></h3>
                <a href="#" class="btn" onclick="if (<?php echo $total; ?> > 0) { alert('Now proceeding to payment.. '); }">Checkout</a>
            </div>

            </div>
        </div>
    </section>

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.add-to-basket').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var productId = this.getAttribute('data-product-id');
                        console.log("Clicked button for product with ID:", productId);
                        addToCart(productId);
                    });
                });
            });
        </script>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved. <a href="Sitemap.php">Sitemap</a></p>
        </div>
    </footer>

    <script src="JScripts.js" defer></script> <!-- Main JavaScript file -->
</body>
</html>
