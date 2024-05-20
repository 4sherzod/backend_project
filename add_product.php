<?php
require_once "db.php";
session_start();
$user_id = $_SESSION["user"]["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($_FILES['filename']['name']);
    $image_url = '';

    if (move_uploaded_file($_FILES['filename']['tmp_name'], $upload_file)) {
        $image_url = $upload_file;
    } else {
        echo "Failed to upload image.";
    }

    $new_product = [
        'title' => $_POST["title"],
        'stock' => $_POST["stock"],
        'normal_price' => $_POST["normal_price"],
        'discounted_price' => $_POST["discounted_price"],
        'expiration_date' => $_POST["expiration_date"],
        'image_url' => $image_url,
        'category' => $_POST["category"],
        'user_id' => $user_id
    ];

    addProduct($new_product);
    //echo "product added";
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
    <link rel="stylesheet" href="add_edit_product.css">
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <div>
            <label for="title">Product Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div>
            <label for="normal_price">Normal Price:</label>
            <input type="number" step="0.01" id="normal_price" name="normal_price" required>
        </div>
        <div>
            <label for="discounted_price">Discounted Price:</label>
            <input type="number" step="0.01" id="discounted_price" name="discounted_price" required>
        </div>
        <div>
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" id="expiration_date" name="expiration_date" required>
        </div>
        <div>
            <label for="myFile">Add Image:</label>
            <input type="file" id="myFile" name="filename" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <button type="submit" class="button">Add Product</button>
    </form>
</body>
</html>
