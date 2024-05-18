<?php
    require_once "db.php";
    session_start();
    $user_id = $_SESSION["user"]["user_id"];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $new_product = [
            'title' => $_POST["title"],
            'stock' => $_POST["stock"],
            'normal_price' => $_POST["normal_price"],
            'discounted_price' => $_POST["discounted_price"],
            'expiration_date' => $_POST["expiration_date"],
            'image_url' => $_POST["image_url"],
            'category' => $_POST["category"],
            'user_id' => $user_id
            ];
        addProduct($new_product);
        header('Location: seller.php');
        exit;
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
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
