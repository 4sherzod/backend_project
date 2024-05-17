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

    // Get product ID from URL parameter
    $product_id = $_GET['id'];

    // Prepare and execute SELECT query using PDO
    $query = "SELECT * FROM products WHERE product_id = :product_id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $statement->execute();

    // Fetch product details
    $product = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle database connection or query errors
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($product['title']); ?></h1>
    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" />
    <p>Stock: <?php echo htmlspecialchars($product['stock']); ?></p>
    <p>Normal Price: $<?php echo htmlspecialchars($product['normal_price']); ?></p>
    <p>Discounted Price: $<?php echo htmlspecialchars($product['discounted_price']); ?></p>
    <p>Expiration Date: <?php echo htmlspecialchars($product['expiration_date']); ?></p>
    <p>Category: <?php echo htmlspecialchars($product['category']); ?></p>
    <p>Seller: <?php echo htmlspecialchars($product['seller_name']); ?></p>
    <p>Email: <?php echo htmlspecialchars($product['seller_email']); ?></p>
    <p>City: <?php echo htmlspecialchars($product['seller_city']); ?></p>
    <p>District: <?php echo htmlspecialchars($product['seller_district']); ?></p>
    <p>Address: <?php echo htmlspecialchars($product['seller_address']); ?></p>
    <a href="seller.php">Save</a>
</body>
</html>
