<?php
require_once "db.php";

session_start();
$product_id = $_GET['id'];

$product = getProductbyId($product_id);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $stock = $_POST['stock'];
    $normal_price = $_POST['normal_price'];
    $discounted_price = $_POST['discounted_price'];
    $expiration_date = $_POST['expiration_date'];
    $category = $_POST['category'];

    // Update product in the database
    $stmt = $db->prepare("UPDATE products SET title = ?, stock = ?, normal_price = ?, discounted_price = ?, expiration_date = ?, category = ? WHERE product_id = ?");
    $stmt->execute([$title, $stock, $normal_price, $discounted_price, $expiration_date, $category, $product_id]);

    // Redirect to seller.php after saving changes
    header("Location: seller.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
    <style>
        *{
            border: 1px solid red;
        }
        form,h1{
            width: fit-content;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="">
        <div>
            <label for="title">Product Title:</label>
            <input type="text" class="input" name="title" id="title" placeholder="Product Title" value="<?php echo $product["title"];?>">
        </div>
        <br>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" class="input" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
        </div>
        <br>
        <div>
            <label for="normal_price">Normal Price:</label>
            <input type="number" class="input" step="0.01" id="normal_price" name="normal_price" value="<?php echo htmlspecialchars($product['normal_price']); ?>" required>
        </div>
        <br>
        <div>
            <label for="discounted_price">Discounted Price:</label>
            <input type="number" class="input" step="0.01" id="discounted_price" name="discounted_price" value="<?php echo htmlspecialchars($product['discounted_price']); ?>" required>
        </div>
        <br>

        <div>
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" class="input" id="expiration_date" name="expiration_date" value="<?php echo htmlspecialchars($product['expiration_date']); ?>" required>
        </div>
        <br>

        <div>
            <label for="category">Category:</label>
            <input type="text" class="input" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>
        </div>
        <br>

        <button type="submit" class="button">Save Changes</button>

    </form>
</body>
</html>
