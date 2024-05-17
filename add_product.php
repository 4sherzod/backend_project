<?php
include('config.php');

// Database connection parameters
$dsn = "mysql:host=localhost;dbname=ProductsDB;charset=utf8mb4";
$username = "root";
$password = "";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode

    // Check if form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare SQL statement with placeholders
        $query = "INSERT INTO products (title, stock, normal_price, discounted_price, expiration_date, image_url, category, seller_name, seller_email, seller_city, seller_district, seller_address)
                  VALUES (:title, :stock, :normal_price, :discounted_price, :expiration_date, :image_url, :category, :seller_name, :seller_email, :seller_city, :seller_district, :seller_address)";

        // Prepare the statement
        $statement = $pdo->prepare($query);

        // Bind parameters
        $statement->bindParam(':title', $_POST['title']);
        $statement->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);
        $statement->bindParam(':normal_price', $_POST['normal_price']);
        $statement->bindParam(':discounted_price', $_POST['discounted_price']);
        $statement->bindParam(':expiration_date', $_POST['expiration_date']);
        $statement->bindParam(':image_url', $_POST['image_url']);
        $statement->bindParam(':category', $_POST['category']);
        $statement->bindValue(':seller_name', 'Seller One'); // Example seller name
        $statement->bindValue(':seller_email', 'seller1@example.com'); // Example seller email
        $statement->bindParam(':seller_city', $_POST['seller_city']);
        $statement->bindParam(':seller_district', $_POST['seller_district']);
        $statement->bindParam(':seller_address', $_POST['seller_address']);

        // Execute the statement
        $statement->execute();

        // Redirect to seller.php after successful insertion
        header('Location: seller.php');
        exit;
    }
} catch (PDOException $e) {
    // Handle database connection or query errors
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST" action="">
        <label for="title">Product Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>
        <label for="normal_price">Normal Price:</label>
        <input type="number" step="0.01" id="normal_price" name="normal_price" required>
        <label for="discounted_price">Discounted Price:</label>
        <input type="number" step="0.01" id="discounted_price" name="discounted_price" required>
        <label for="expiration_date">Expiration Date:</label>
        <input type="date" id="expiration_date" name="expiration_date" required>
        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>
        <label for="seller_city">City:</label>
        <input type="text" id="seller_city" name="seller_city">
        <label for="seller_district">District:</label>
        <input type="text" id="seller_district" name="seller_district">
        <label for="seller_address">Address:</label>
        <input type="text" id="seller_address" name="seller_address">
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
