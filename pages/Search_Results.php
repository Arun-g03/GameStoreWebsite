<?php
include 'php_scripts.php';

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Perform the search query
    $searchResults = performSearch($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="CSS_Styles.css">
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

    <main>
        <section class="product_listings">
            <h2>Search Results</h2>
            <div class="container">
                <?php if (isset($searchResults) && count($searchResults) > 0) : ?>
                    <?php foreach ($searchResults as $result) : ?>
                        <div class="product">
                            <a href="Product_Page.php?id=<?php echo $result['ID']; ?>"><img src="<?php echo $result['Image1']; ?>" alt="<?php echo htmlspecialchars($result['Title']); ?>"></a>
                            <a href="Product_Page.php?id=<?php echo $result['ID']; ?>">
                                <h3><?php echo htmlspecialchars($result['Title']); ?></h3>
                            </a>
                            <p><?php echo isset($result['PlatformNames']) ? htmlspecialchars($result['PlatformNames']) : ''; ?></p>
                            <?php
                            $discountedPrice = $result['Price'] * (1 - $result['Discount']);
                            $discountedPrice = round($discountedPrice, 2);
                            $discount = $result['Discount'] * 100;

                            if ($result['Price'] == 0) {
                                echo '<span>Free to Play</span>';
                            } else if (isset($discountedPrice) && $discountedPrice < $result['Price']) {
                                echo '<span> Sale Price: £' . htmlspecialchars(number_format($discountedPrice, 2)) . ' - ' . $discount . '% off </span>';
                            } else {
                                echo '<span>£' . htmlspecialchars(number_format($result['Price'], 2)) . '</span>';
                            }
                            ?>
                            <button class="btn add-to-basket" data-product-id="<?php echo $result['ID']; ?>">Add to Basket</button>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No results found.</p>
                <?php endif; ?>
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

    </main>

    <footer>
        <!-- Include your footer code here -->
    </footer>
</body>
</html>
