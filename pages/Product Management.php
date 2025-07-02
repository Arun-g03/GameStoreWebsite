<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Add_Products.css"> <!-- Main CSS file -->
    <title>Product Management</title>
</head>
<body>
    <h1> DO NOT REFRESH PAGE, CLOSE AND REOPEN INSTEAD</h1>
    <h2>Add New Product</h2>
    <?php

    
    include_once 'dbConnection.php';
    

    
    // Check if the form is submitted for adding or deleting
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // If adding a new product
            if (isset($_POST['add_product'])) {
                // Prepare and execute the query to insert the new product
                $stmt = $pdo->prepare("INSERT INTO Product_table (Title, Release_date, Description, Price, Image1, Image2, Image3) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([htmlspecialchars($_POST['title']), $_POST['release_date'], htmlspecialchars($_POST['description']), $_POST['price'], $_POST['image1'], $_POST['image2'], $_POST['image3']]);
                $product_id = $pdo->lastInsertId(); // Get the ID of the inserted product

                // Insert into the junction table (Products_Platforms)
                if (isset($_POST['platform'])) {
                    foreach ($_POST['platform'] as $platform_id) {
                        $stmt = $pdo->prepare("INSERT INTO Products_Platforms (Product_ID, Platform_ID) VALUES (?, ?)");
                        $stmt->execute([$product_id, $platform_id]);
                    }
                }

                // Insert into the junction table (Product_Genres)
                if (isset($_POST['genre'])) {
                    foreach ($_POST['genre'] as $genre_id) {
                        $stmt = $pdo->prepare("INSERT INTO Products_Genres (Product_ID, Genre_ID) VALUES (?, ?)");
                        $stmt->execute([$product_id, $genre_id]);
                    }
                }

                $message = "Product added successfully!";
            }

            // If deleting a product
            if (isset($_POST['delete_product'])) {
                // Prepare and execute the query to delete the product
                $stmt = $pdo->prepare("DELETE FROM Product_table WHERE ID = ?");
                $stmt->execute([$_POST['delete_product']]);
                $message = "Product deleted successfully!";
            }
        } catch(PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
    ?>

    <!-- Add New Product Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <!-- Platform checkboxes -->
        <label>Platform:</label><br>
        <?php
        $platforms = $pdo->query("SELECT * FROM Platforms")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($platforms as $platform) {
            echo '<input type="checkbox" id="platform' . $platform['ID'] . '" name="platform[]" value="' . $platform['ID'] . '">';
            echo '<label for="platform' . $platform['ID'] . '">' . $platform['Name'] . '</label><br>';
        }
        ?><br>

        <label for="release_date">Release Date:</label><br>
        <input type="date" id="release_date" name="release_date" required><br><br>

        <!-- Genre checkboxes -->
        <label>Genre:</label><br>
        <?php
        $genres = $pdo->query("SELECT * FROM Genres")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($genres as $genre) {
            echo '<input type="checkbox" id="genre' . $genre['ID'] . '" name="genre[]" value="' . $genre['ID'] . '">';
            echo '<label for="genre' . $genre['ID'] . '">' . $genre['Name'] . '</label><br>';
        }
        ?><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Price (£):</label><br>
        <input type="number" id="price" name="price" min="0.00" step="0.01" required><br><br>

        <label for="image1">Image 1 (COVER IMAGE) (local relative path or URL):</label><br>
        <input type="text" id="image1" name="image1" required><br><br>

        <label for="image2">Image 2 (local relative path or URL):</label><br>
        <input type="text" id="image2" name="image2"><br><br>

        <label for="image3">Image 3 (local relative path or URL):</label><br>
        <input type="text" id="image3" name="image3"><br><br>

        <input type="submit" name="add_product" value="Add Product">
    </form>

    <h2>Delete Product</h2>
    <?php
    // Fetch all products for deletion
    try {
        // Fetch all products
        $stmt = $pdo->query("SELECT * FROM Product_table");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display dropdown for deleting products
        echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="POST">';
        echo '<select name="delete_product_id">';
        foreach ($products as $product) {
            echo '<option value="' . $product['ID'] . '">' . $product['Title'] . '</option>';
        }
        echo '</select>';
        echo '<input type="submit" value="Delete Product">';
        echo '</form>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <h1> DO NOT REFRESH PAGE, CLOSE AND REOPEN INSTEAD</h1>
</body>
</html>
