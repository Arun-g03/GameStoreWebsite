<?php
// Include the session manager file
require_once('session_manager.php');

include 'php_scripts.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <!--  this is a comment-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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




    <!-- Product Details -->
<!-- The container for the product details -->
<div class="Container Product_Details_Container">
    <h1>Product Details</h1>
    <?php
    include_once 'dbConnection.php';

    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $stmt = $pdo->prepare("SELECT * FROM Product_table WHERE ID = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo "<div class='header-section'>";
        echo "<h2>" . htmlspecialchars($product['Title']) . "</h2>";
        echo "<head><title>" . htmlspecialchars($product['Title']) . " - Product Details</title></head>";
        echo '</div>';

        echo '<div class="product_details-images-scroll-container">';
        for ($i = 1; $i <= 3; $i++) {
            $image_column = "Image" . $i;
            $image_url = $product[$image_column];
            if (!empty($image_url)) {
                echo '<img src="' . htmlspecialchars($image_url) . '" alt="' . htmlspecialchars($product['Title']) . '">';
            }
        }
        echo '</div>';

        // Fetch the ratings for the product
        $stmtRatings = $pdo->prepare("SELECT SUM(thumbs_up) AS TotalThumbsUp, SUM(thumbs_down) AS TotalThumbsDown FROM Reviews WHERE product_id = ?");
        $stmtRatings->execute([$product_id]);
        $ratings = $stmtRatings->fetch(PDO::FETCH_ASSOC);

        $totalVotes = $ratings['TotalThumbsUp'] + $ratings['TotalThumbsDown'];
        $score = $totalVotes > 0 ? round(($ratings['TotalThumbsUp'] / $totalVotes) * 10, 1) : 'Not rated';

        echo "<div class='description-side-info'>";
        echo "<div class='product-description'><p>" . nl2br(htmlspecialchars($product['Description'])) . "</p></div>";

        echo "<div class='side-info'>";
        echo "<div class='product-price'><strong>Price:</strong> ";

        // Check if the product has a discount and calculate the discounted price
        $discount = $product['Discount']; // Assuming there is a 'Discount' column in your Product_table
        $originalPrice = $product['Price'];
        $discountedPrice = $originalPrice * (1 - $discount);
        $discountPercentage = $discount * 100;

        if ($originalPrice == 0) {
            echo "Free to Play";
        } else if ($discount > 0 && $discountedPrice < $originalPrice) {
            echo '<span> On Sale - ' . htmlspecialchars(number_format($discountPercentage, 0)) . '% off </span>';
            echo '<span> £' . htmlspecialchars(number_format($discountedPrice, 2)) . '</span>';
        } else {
            echo '£' . htmlspecialchars(number_format($originalPrice, 2));
        }
        echo "</div>";

        if (!empty($product['Release_date'])) {
            $releaseDate = date('d-m-Y', strtotime($product['Release_date']));
            echo "<div class='product-release-date'><strong>Release Date:</strong> " . htmlspecialchars($releaseDate) . "</div>";
        }

        $stmtPlatforms = $pdo->prepare("SELECT p.Name FROM platforms p INNER JOIN products_platforms pp ON p.ID = pp.Platform_ID WHERE pp.Product_ID = ?");
        $stmtPlatforms->execute([$product_id]);
        $platforms = $stmtPlatforms->fetchAll(PDO::FETCH_ASSOC);
        if ($platforms) {
            echo "<div class='product-platforms'><strong>Platforms:</strong> " . implode(', ', array_map(function($platform) { return htmlspecialchars($platform['Name']); }, $platforms)) . "</div>";
        }

        $stmtGenres = $pdo->prepare("SELECT g.Name FROM genres g INNER JOIN products_genres pg ON g.ID = pg.Genre_ID WHERE pg.Product_ID = ?");
        $stmtGenres->execute([$product_id]);
        $genres = $stmtGenres->fetchAll(PDO::FETCH_ASSOC);
        if ($genres) {
            echo "<div class='product-genres'><strong>Genres:</strong> " . implode(', ', array_map(function($genre) { return htmlspecialchars($genre['Name']); }, $genres)) . "</div>";
        }

        echo "<div class='product-ratings'>
            <strong>Ratings:</strong>";
        if ($totalVotes > 0) {
            echo "<span>$score / 10 based on $totalVotes votes</span>";
        } else {
            echo "<span>Not rated yet</span>";
        }
        echo "</div>";

        // Thumbs up and thumbs down buttons
        echo '<div class="rating-buttons">
            <button class="thumbs-up" onclick="vote(' . $product_id . ', \'up\')">Thumbs Up</button>
            <button class="thumbs-down" onclick="vote(' . $product_id . ', \'down\')">Thumbs Down</button>
        </div>';

        echo '<div class="add-to-basket"><button onclick="addToCart(' . $product['ID'] . ');">Add to Basket</button></div>';
        echo "</div>"; // Close side-info
        echo "</div>"; // Close description-side-info

    } else {
        echo "<p>Product not found.</p>";
    }
    ?>
</div> <!-- End container div -->

<script>
function vote(productId, type) {
    console.log('Voting', productId, type);  // Debugging line
    var xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true); // Ensure this points to the current file
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            console.log('Response received', xhr.status, xhr.responseText);  // Debugging line
            if (xhr.status === 200) {
                var response = xhr.responseText;
                if (response.trim() === 'success') {
                    alert('Thank you for your vote!');
                    location.reload(); // Reload the page to reflect the updated rating
                } else {
                    alert('Error: ' + response);
                }
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };
    xhr.send('product_id=' + productId + '&type=' + type);
}
</script>













    <script src="JScripts.js" defer></script> <!-- Main JavaScript file -->  
        
    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved. <a href="Sitemap.php">Sitemap</a></p>
        </div>
    </footer>
</body>
</html>
