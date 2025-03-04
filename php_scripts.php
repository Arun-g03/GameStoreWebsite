<?php
// This is a PHP script that handles various functions for a website.
// It includes functions for handling user authentication, adding and removing items from a shopping cart, and displaying a list of items in the cart.
// It also includes functions for handling search queries and displaying a list of products with discounts.
// It uses the PDO extension to interact with a MySQL database.
// It also uses the PHP session extension to store data in the user's session.


//database connection
include_once 'dbConnection.php';

//get products from database
function getProductDetails($productID) {
    global $pdo;
    try {
        // Query to fetch product details by ID, including the platform names
        $query = "SELECT product_table.*, GROUP_CONCAT(platforms.Name) AS PlatformNames
                  FROM product_table
                  INNER JOIN products_platforms ON product_table.ID = products_platforms.Product_ID
                  INNER JOIN platforms ON products_platforms.Platform_ID = platforms.ID
                  WHERE product_table.ID = ?
                  GROUP BY product_table.ID";
        
        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $productID, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the result (should be only one row)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the result
        return $result;
    } catch(PDOException $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage() . "<br>";
        return false;
    }
}



// Function to fetch games by genre
function getRandomProductIdsByGenre($genre_id, $quantity = 4)
{
    global $pdo;
    try {
        // Query to fetch random product IDs by genre and discount
        $query = "SELECT pt.ID, pt.Discount 
                  FROM products_genres pg
                  JOIN product_table pt ON pg.Product_ID = pt.ID
                  WHERE pg.Genre_ID = ?
                  ORDER BY RAND()
                  LIMIT ?";

        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $genre_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $quantity, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the array of randomly selected products with IDs and discounts
        return $products;
    } catch (PDOException $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage() . "<br>";
        return array();
    }
}


//get products from database
// Function to fetch random product IDs by platform and their discounts
function getRandomProductIdsByPlatform($platform_id, $quantity = 4)
{
    global $pdo;
    try {
        // Query to fetch random product IDs by platform and their discounts
        $query = "SELECT p.Product_ID, pt.Discount 
                  FROM products_platforms p
                  JOIN product_table pt ON p.Product_ID = pt.ID
                  WHERE p.Platform_ID = ?
                  ORDER BY RAND()
                  LIMIT ?";

        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $platform_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $quantity, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results
        $productIdsAndDiscounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the array of randomly selected product IDs and their discounts
        return $productIdsAndDiscounts;
    } catch (PDOException $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage() . "<br>";
        return array();
    }
}
//get products from database that have a discount
function getProductsWithDiscount()
{
    global $pdo;
    try {
        // Query to fetch products with discount
        $query = "SELECT ID FROM product_table WHERE Discount>0 ORDER BY RAND()";

        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Fetch all results
        $productIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Return the array of product IDs with discount
        return $productIds;
    } catch (PDOException $e) {
        // Handle any errors that occur during the query execution
        error_log("Error: " . $e->getMessage());
        return array();
    }
}
















//get products from database
function getRandomGames($numGames)
{
    global $pdo;
    try {
        // Query to fetch random product IDs and discounts
        $query = "SELECT ID, Discount FROM Product_table ORDER BY RAND() LIMIT ?";

        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $numGames, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize an array to store the game details
        $games = array();

        // Fetch game details for each random product ID
        foreach ($results as $result) {
            $productId = $result['ID'];
            $discount = $result['Discount'];
            $gameDetails = getProductDetails($productId);
            if ($gameDetails) {
                $gameDetails['Discount'] = $discount;
                $games[] = $gameDetails;
            }
        }

        // Return the array of game details
        return $games;
    } catch (PDOException $e) {
        error_log("Failed to fetch random games: " . $e->getMessage());
        return array(); // Return an empty array to signify failure.
    }
}


// get products from database
// Function to fetch all genres
function getAllGenres() {
    global $pdo;
    try {
        // Query to fetch all genres
        $query = "SELECT * FROM genres";
        
        // Prepare and execute the query
        $stmt = $pdo->query($query);
        
        // Fetch all results
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the array of genres
        return $genres;
    } catch(PDOException $e) {
        // Handle any errors that occur during the query execution
        echo "Error: " . $e->getMessage() . "<br>";
        return array();
    }
}


 /* 
genre codes
update this as more genres are added to server


1 - Action
2 - Adventure
3 - Casual
4 - Educational
5 - Fighting
6 - FPS
7 - Horror
8 - MMORPG
9 - Music
21 - Online
10 - Platformer
11 - Puzzle
12 - Racing
13 - Rogue-like
14 - RPG
15 - Simulation
16 - Sports
17 - Stealth
18 - Strategy
19 - Survival
20 - Visual Novel

 */
 



//function to handle search queries
 function performSearch($query)
{
    global $pdo;
    try {
        // Prepare the search query
        $searchQuery = "%$query%";
        $stmt = $pdo->prepare("SELECT * FROM product_table WHERE Title LIKE ?");
        $stmt->bindValue(1, $searchQuery, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the search results
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $searchResults;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
        return array();
    }
}
