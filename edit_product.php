<?php
include('config.php');
include('db.php');
$dsn = "mysql:host=localhost;dbname=ProductsDB;charset=utf8mb4";
$username = "root";
$password = "";
// Initialize PDO connection
try {
    $pdo = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve product ID from URL parameter
$product_id = $_GET['id'];

// Fetch product details using prepared statement
$query = "SELECT * FROM products WHERE product_id = :product_id";
$statement = $pdo->prepare($query);
$statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $stock = $_POST['stock'];
    $normal_price = $_POST['normal_price'];
    $discounted_price = $_POST['discounted_price'];
    $expiration_date = $_POST['expiration_date'];
    $image_url = $_POST['image_url'];
    $category = $_POST['category'];
    $seller_city = $_POST['seller_city'];
    $seller_district = $_POST['seller_district'];
    $seller_address = $_POST['seller_address'];

    // Update product in the database
    $updateQuery = "UPDATE products SET title=:title, stock=:stock, normal_price=:normal_price, discounted_price=:discounted_price, expiration_date=:expiration_date, image_url=:image_url, category=:category, seller_city=:seller_city, seller_district=:seller_district, seller_address=:seller_address WHERE product_id=:product_id";
    $updateStatement = $pdo->prepare($updateQuery);
    $updateStatement->bindParam(':title', $title);
    $updateStatement->bindParam(':stock', $stock, PDO::PARAM_INT);
    $updateStatement->bindParam(':normal_price', $normal_price);
    $updateStatement->bindParam(':discounted_price', $discounted_price);
    $updateStatement->bindParam(':expiration_date', $expiration_date);
    $updateStatement->bindParam(':image_url', $image_url);
    $updateStatement->bindParam(':category', $category);
    $updateStatement->bindParam(':seller_city', $seller_city);
    $updateStatement->bindParam(':seller_district', $seller_district);
    $updateStatement->bindParam(':seller_address', $seller_address);
    $updateStatement->bindParam(':product_id', $product_id, PDO::PARAM_INT);

    try {
        $updateStatement->execute();
        // Redirect to seller.php after successful update
        header('Location: seller.php');
        exit;
    } catch (PDOException $e) {
        die("Error updating product: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="">
        <label for="title">Product Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
        <label for="normal_price">Normal Price:</label>
        <input type="number" step="0.01" id="normal_price" name="normal_price" value="<?php echo htmlspecialchars($product['normal_price']); ?>" required>
        <label for="discounted_price">Discounted Price:</label>
        <input type="number" step="0.01" id="discounted_price" name="discounted_price" value="<?php echo htmlspecialchars($product['discounted_price']); ?>" required>
        <label for="expiration_date">Expiration Date:</label>
        <input type="date" id="expiration_date" name="expiration_date" value="<?php echo htmlspecialchars($product['expiration_date']); ?>" required>
        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>">
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>
        <label for="seller_city">City:</label>
        <input type="text" id="seller_city" name="seller_city" value="<?php echo htmlspecialchars($product['seller_city']); ?>">
        <label for="seller_district">District:</label>
        <input type="text" id="seller_district" name="seller_district" value="<?php echo htmlspecialchars($product['seller_district']); ?>">
        <label for="seller_address">Address:</label>
        <input type="text" id="seller_address" name="seller_address" value="<?php echo htmlspecialchars($product['seller_address']); ?>">
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
