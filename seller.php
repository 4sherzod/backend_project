<?php

require_once "db.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("login.php");
    exit;
}

$stmt = $db->prepare('select * from products where user_id = ?');
$stmt->execute([$_SESSION["user"]["user_id"]]);
$list = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Products</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table{
            border: 1;
        }
    </style>
</head>
<body>
    <h1>All Products</h1>
    <a href="add_product.php">Add New Product</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Stock</th>
            <th>Normal Price</th>
            <th>Discounted Price</th>
            <th>Expiration Date</th>
            <th>Category</th>
            <th>Seller Name</th>
            <th>Actions</th>
        </tr>
        <?php 
        // Check if results are returned
    if (sizeof($list)> 0) {

        // Output data for each row
        echo "<table>";
        foreach ($list as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['stock'] . "</td>";
            echo "<td>" . $row['normal_price'] . "</td>";
            echo "<td>" . $row['discounted_price'] . "</td>";
            echo "<td>" . $row['expiration_date'] . "</td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . getUserById($row['user_id'])["market_name"] . "</td>";
            echo "<td>";
            echo "<a href='view_product.php?id=" . $row['product_id'] . "' >View</a>";
            echo "<a href='edit_product.php?id=" . $row['product_id'] . "' >Edit</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No products found.";
    } ?>
    </table>
</body>
</html>