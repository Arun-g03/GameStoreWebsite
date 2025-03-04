<?php
// Include the session manager file
require_once('session_manager.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Evolution Digital Game Store</title>
    <link rel="stylesheet" href="CSS_Styles.css"> <!-- Main CSS file -->
    
    
</head>
<body>

<!-- Navigation bar-->
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
    <br>
    <br>
    <!-- About us Statement -->  
    <section class="about">
        <div class="container" id="text">
            <h2>About Evolution Digital Game Store</h2>
            <br>
            <p>Welcome to Evolution Digital Game Store, your one-stop shop for the latest and best games and deals across PC, PlayStation, and Xbox platforms. We are passionate about gaming and strive to provide a seamless and enjoyable experience for gamers of all ages.</p>
            <br>
            <p>At Evolution, we believe in offering a diverse selection of games to cater to every gaming preference. Whether you're into action-packed adventures, immersive RPGs, or challenging puzzles, we've got something for you.</p>
            <br>
            <p>Our mission is to connect gamers with their favorite titles and foster a vibrant gaming community. With user-friendly navigation, secure payment options, and timely updates, we aim to make your gaming journey as smooth as possible.</p>
            <br>
            <p>Thank you for choosing Evolution Digital Game Store. Let's embark on an epic gaming adventure together!</p>
            <br>
    </section>



    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved.  <a href="../Sitemap/Sitemap.php">Sitemap</a></p> <!-- Link to the sitemap page -->
        
        </div>
    </footer>
    <script src="JScripts.js" defer></script> <!-- Main JavaScript file -->  
</body>
</html>
