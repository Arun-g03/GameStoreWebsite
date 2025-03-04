<?php

//check if sesssion is started, else start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    
     

// Check if the basket array exists in session, else make one
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}}
include_once 'dbConnection.php';






// Handling AJAX requests
// POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Check if it's a login request
    if (isset($_POST['Username'], $_POST['Password']) && isset($_POST['action']) && $_POST['action'] == 'login') {
        echo validate_credentials($_POST['Username'], $_POST['Password'], $pdo);
        
        exit();
    }
    
    //Check if it's a logout request
    if (isset($_POST['action']) && $_POST['action'] == 'logout') {
        session_unset();
        session_destroy();
        
        exit();
    }
    //check if it's a register request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if it's a register request
        if (isset($_POST['action']) && $_POST['action'] == 'register') {
            // Attempt to register the user
            $result = register_new_user($_POST['FullName'], $_POST['Username'], $_POST['Email'], $_POST['Password'], $pdo);
    
            if ($result === "success") {
                // Fetch the newly created user data to populate the session
                $stmt = $pdo->prepare("SELECT * FROM members WHERE Username = ?");
                $stmt->execute([$_POST['Username']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($user) {
                    // Assuming the password check was successful during registration, populate the session
                    $_SESSION['user_id'] = $user['ID'];
                    $_SESSION['username'] = $user['Username'];
                    $_SESSION['name'] = $user['Name']; // Store the full name in session
    
                    // Redirect to the index page with a success message
                    header("Location: Index.php?message=Registered successfully");
                    exit();
                } else {
                    // Error retrieving user data post-registration
                    header("Location: signUp.php?error=Error retrieving user data post-registration.");
                    exit();
                }
            } elseif ($result === "exists") {
                // Username or email already exists
                header("Location: signUp.php?error=Username or email already exists. Please log in.");
                exit();
            } else {
                // General registration error
                header("Location: signUp.php?error=Error registering user.");
                exit();
            }
        }
    }
    }

//check given credentials and return true if they are valid, assign the user to a session and return false otherwise
function validate_credentials($Username, $Password, $pdo) {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Check if the user exists and the password is correct
    $stmt = $pdo->prepare("SELECT * FROM members WHERE Username = ?");
    $stmt->execute([$Username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // If the user exists and the password is correct, populate the session and return true
    if ($user && $user['Password'] === $Password) {
        session_reset();
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['Username']; 
        $_SESSION['name'] = $user['Name']; // Add this line to store the name in session
        echo "Signed In";  // Make sure this is the output when credentials are correct
    } else {
        echo "Invalid credentials";  // This should be the output otherwise
    }
}



//register new user and return success if the user was registered, return exists if the username or email already exists and return error if there was an error
function register_new_user($FullName, $Username, $Email, $Password, $pdo) {
    // Check if the username or email already exists
    $stmt = $pdo->prepare("SELECT ID FROM members WHERE Username = ? OR Email = ?");
    $stmt->execute([$Username, $Email]);
    if ($stmt->fetch()) {
        return "exists"; // Return a specific message if the username or email already exists
    }
    // Insert new user with plain text password
    $stmt = $pdo->prepare("INSERT INTO members (Name, Username, Email, Password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$FullName, $Username, $Email, $Password]);
    if ($stmt->rowCount() > 0) {
        return "success"; // Return success if the user is registered
    } else {
        return "error"; // Return an error message if registration fails
    }
}

//
// Function to handle logout
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
}





/*  ///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
 */



//add a product to the cart
 function addToCart($productId, $quantity) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the cart array exists in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    if (!isset($_SESSION['cart'][$productId])) {
        // Product does not exist, add it to the cart
        $_SESSION['cart'][$productId] = $quantity;
        echo "Added product ID: $productId, quantity: $quantity to cart";
    } else {
        echo "Product ID: $productId already exists in cart";
    }
}



// Remove item from cart
function removeFromCart($productId) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['cart'][$productId]);
}

// Clear cart
function clearCart() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['cart']);
}

// Get cart items
function getCartItems() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['cart'] ?? [];
}
