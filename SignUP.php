<?php
// Include the session manager file
require_once('session_manager.php');

include 'php_scripts.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();


}

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <!--  this is a comment-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Evolution Digital Game Store</title>
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
        <!-- Login -->
            <div class="Login">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Display sign-out button if user is logged in -->
                    <div id="userLoggedIn">
                        <span>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!</span>
                        <button onclick="logoutUser(); return false;">Logout</button>
                    </div>
                <?php else: ?>
                    <!-- Display login/signup link if user is not logged in -->
                    <a href="SignUP.php" id="loginBtn">Sign Up / Login</a>
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
            <h2>Sign up</h2>
            <p>Having an account allows you to save your details for later.</details></p>
        </div>
    </section>
    
    <!------------- Sign Up Form ----------------------->
    <section class="Sign_Up_Form">
        <div id="Sign_Up_Form_Container" class="container"> 
            <h2>Sign Up</h2>
            <form id="signUpForm" action="session_manager.php" method="POST">
                <div class="form-field">
                    <label for="signupFullName">Full Name</label>
                    <input type="text" id="signupFullName" name="FullName" placeholder="e.g., John Doe" required pattern="[a-zA-Z\s]+" title="Full name must contain only letters and spaces.">
                </div>
                <div class="form-field">
                    <label for="signupUsername">Username</label>
                    <input type="text" id="signupUsername" name="Username" placeholder="Username" required pattern="\w+" title="Username must contain only letters, numbers, and underscores.">
                </div>
                <div class="form-field">
                    <label for="signupEmail">Email</label>
                    <input type="email" id="signupEmail" name="Email" placeholder="Email" required>
                </div>
                <div class="form-field">
                    <label for="signupPassword">Password</label>
                    <input type="password" id="signupPassword" name="Password" placeholder="Password" required minlength="8" title="Password must be at least 8 characters long.">
                </div>
                <input type="hidden" name="action" value="register">
                <button type="submit" class="signup-button">Sign Up</button>
            </form>

        </div>
    </section>



    <footer>
        <div class="container">
            <p>&copy; 2024 Evolution Digital Game Store. All rights reserved. <a href="Sitemap.php">Sitemap</a></p>
        </div>
    </footer>
    
<script src="JScripts.js" defer></script> <!-- Main JavaScript file --> 

<!-- Checkout button JavaScript event listener -->
            <!-- Ensure Checkout buttons are functioning by using an event listener in the file,
            during develpment, I was using a listener placed in JScripts but it wasnt calling, 
            resulting in this "fix"-->



</body>
</html>


