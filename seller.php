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

$stmt = $pdo->prepare("SELECT * FROM products WHERE user_id = ?");
$stmt->execute([$_SESSION["user"]["user_id"]]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Products</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Stock</th>
                <th>Normal Price</th>
                <th>Discounted Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                    <td><?php echo htmlspecialchars($row['normal_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['discounted_price']); ?></td>
                    <td class="action-links">
                        <?php
                        echo "<a href='edit_product.php?id=" . $row['product_id'] . "'>Edit</a>";
                        echo "<a href='productdetail.php?id=" . $row['product_id'] . "'>View</a>";
                        echo "<a href='delete_product.php?id=" . $row['product_id'] . "' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>";
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
