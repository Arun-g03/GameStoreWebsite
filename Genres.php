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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <!------------- Hero Section ----------------------->
    <section class="hero">
        <div id="Welcome_Message" class="container">
            <h2>Genre Search</h2>
            <p>Here, you can filter games by genre..</p>
        </div>
    </section>

    <section class="genre-games">
        <div class="genre_container">
            <div class="genre-buttons">
                <?php
                // Fetch all genres
                $genres = getAllGenres();

                // Display each genre as a button
                foreach ($genres as $genre) {
                    echo '<button class="genre-btn" data-id="' . $genre['ID'] . '" onclick="loadGamesByGenre(' . $genre['ID'] . ')">' . htmlspecialchars($genre['Name']) . '</button>';
                }
                ?>
            </div>
            <br><br>
            <div id="games-container">
                <?php
                // Check if the genre ID is provided
                if (isset($_GET['genre_id'])) {
                    // Get the genre ID from the request
                    $genreId = $_GET['genre_id'];

                    

                    // Output the current genre
                    echo '<h2 class="genre-title">' . htmlspecialchars($genreName) . '</h2>';

                    // Fetch and display products based on genre
                    $products = getRandomProductIdsByGenre($genreId);
                    foreach ($products as $product) {
                        $productId = $product['ID'];
                        $game_details = getProductDetails($productId);

                        if ($game_details) {
                            echo '<div class="product">';
                            echo '<a href="Product_Page.php?id=' . $game_details['ID'] . '"><img src="' . $game_details['Image1'] . '" alt="' . htmlspecialchars($game_details['Title']) . '"></a>';
                            echo '<a href="Product_Page.php?id=' . $game_details['ID'] . '"><h3>' . htmlspecialchars($game_details['Title']) . '</h3></a>';
                            echo '<p>' . htmlspecialchars($game_details['PlatformNames']) . '</p>';

                            $discountedPrice = $game_details['Price'] * (1 - $product['Discount']);
                            $discountedPrice = round($discountedPrice, 2);
                            $discountPercentage = $product['Discount'] * 100;

                            if ($game_details['Price'] == 0) {
                                echo '<span>Free to Play</span>';
                            } else if ($discountedPrice < $game_details['Price']) {
                                echo '<span> Sale Price: £' . htmlspecialchars(number_format($discountedPrice, 2)) . ' - ' . htmlspecialchars($discountPercentage) . '% off </span>';
                            } else {
                                echo '<span>£' . htmlspecialchars(number_format($game_details['Price'], 2)) . '</span>';
                            }

                            echo '<button class="btn add-to-basket" data-product-id="' . $game_details['ID'] . '">Add to Basket</button>';
                            echo '</div>';
                        } else {
                            echo '<p>Game details not found for product ID: ' . $productId . '</p>';
                        }
                    }
                } else {
                    echo '<h2>No genre selected</h2>';
                }
                ?>
            </div>
        </div>
    </section>




    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved. <a href="Sitemap.php">Sitemap</a></p>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            // Event listener for genre buttons
            $('.genre-btn').click(function() {
                var genreId = $(this).data('id');
                loadGamesByGenre(genreId);
            });

            // Function to load games by genre
            function loadGamesByGenre(genreId) {
                $.ajax({
                    url: 'script_fetch_games_by_genre.php',
                    type: 'GET',
                    data: { genre_id: genreId },
                    dataType: 'html',
                    success: function(data) {
                        $('#games-container').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading games:', error);
                    }
                });
            }
        });
    </script>

</body>
</html>
