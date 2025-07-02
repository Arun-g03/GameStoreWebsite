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
    <title>Site Map - Evolution Digital Game Store</title>
    <link rel="stylesheet" href="CSS_Styles.css"> <!-- Main CSS file --> 
   
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
                    <li><a href="Shopping_Cart.html"><img src="Images/shopping-cart_icon.png" alt="Shopping Cart" class="shopping-cart-icon"></a></li>
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
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <!-- Display sign-out button if user is logged in -->
                    <form action="index.php" method="post">
                        <button type="submit" name="logout">Sign Out</button>
                    </form>
                <?php else : ?>
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
                    <div id="loginForm">
                        <!-- Login form -->
                        <h2>Login</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["php_SELF"]); ?>">
                            <input type="text" name="username" placeholder="Username" required><br>
                            <input type="password" name="password" placeholder="Password" required><br>
                            <input type="submit" name="login" value="Login">
                        </form>
                        <p>Don't have an account? <a href="#" id="toggleSignUp">Sign Up</a></p>
                    </div>
                    <div id="signupForm" style="display: none;">
                        <!-- Sign-up form -->
                        <h2>Sign Up</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["php_SELF"]); ?>">
                            <input type="text" name="username" placeholder="Username" required><br>
                            <input type="email" name="email" placeholder="Email" required><br>
                            <input type="password" name="password" placeholder="Password" required><br>
                            <input type="submit" name="signup" value="Sign Up">
                        </form>
                        <p>Already have an account? <a href="#" id="toggleLogin">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        
    </header>

    <section class="sitemap">
        <div class="container">
            <h2>Site Map</h2>
            <ul>
                <li><a href="Index.php">Home</a></li>
                    <li><a href="Sales.php">Sales</a></li>
                    <li><a href="PC_Games.php">PC Games</a></li>
                    <li><a href="PlayStation_Games.php">PlayStation Games</a></li>
                    <li><a href="Xbox_Games.php">Xbox Games</a></li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="Genres.php">Genres</a></li>
            </ul>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved.  <a href="Sitemap.php">Sitemap</a></p> <!-- Link to the sitemap page -->
        
        </div>
    </footer>
    <script src="JScripts.js" defer></script> <!-- Main JavaScript file -->  
</body>
</html>
