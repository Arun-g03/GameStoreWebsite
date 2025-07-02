<?php
include 'php_scripts.php';

if (isset($_GET['search'])) {
    $searchQuery = $_GET['query'];

    // Perform the search query here
    $searchResults = performSearch($searchQuery);

    // Display the search results
    foreach ($searchResults as $result) {
        echo '<div class="search-result">';
        echo '<h3>' . $result['Title'] . '</h3>';
        echo '<p>' . $result['Description'] . '</p>';
        // Add more details as needed
        echo '</div>';
    }
}
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

