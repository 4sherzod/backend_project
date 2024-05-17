<?php

require_once("db.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("login.php");
    exit;
}
$user_id = $_SESSION["user"];
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
$stmt = $db->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch cart details
$stmt1 = $db->prepare("SELECT * FROM cart WHERE product_id = ? AND user_id = ?");
$stmt1->execute([$id, $user_id["user_id"]]);
$cart = $stmt1->fetch(PDO::FETCH_ASSOC);

$product_id = $product['product_id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['quantity']) && isset($_GET['type'])) {
        $quantity = $_GET['quantity'];
        $type = $_GET['type'];

        if ($type == 'minus') {
            $quantity = max(0, $quantity - 1); 
        } else {
            $quantity = $quantity + 1;
        }

        if ($cart) {
            // Update existing cart entry
            $stmt2 = $db->prepare('UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?');
            $stmt2->execute([$quantity, $user_id["user_id"], $product_id]);
        } else {
            // Insert new cart entry
            $stmt2 = $db->prepare('INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)');
            $stmt2->execute([$user_id["user_id"], $product_id, 1]);
            $quantity = 1; // Set quantity to 1 for new entry
        }

        // Re-fetch cart details
        $stmt1->execute([$id, $user_id["user_id"]]);
        $cart = $stmt1->fetch(PDO::FETCH_ASSOC);
    } else {
        $quantity = $cart ? $cart['quantity'] : 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
/* CSS styles */
body {
    background-color: #FFFDF6;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    color: #fff;
    padding: 20px;
    background-color: #1f4034;
}

header h1 {
    margin: 0;
    color: #DC9D23;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

main {
    padding: 20px;
}

.product-details {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.product-details img {
    max-width: 50%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 2px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.price {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
}

.normal_price {
    font-size: 1.2em;
    color: #333;
}

.description {
    color: #666;
}

button {
    background-color: #DC9D23;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #ff9900;
}

footer {
    background-color: #1f4034;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
}

span {
    color: #40674A;
}

#cross {
    text-decoration: line-through;
}
</style>
<body>

<header>
    <h1>Bil<span>Grocer</span></h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="shoppingcart.php">Cart</a></li>
        </ul>
    </nav>
</header>
<main>
    <div class="product-details">
        <img src="<?=$product['image_url']?>" alt="Product Image">
        <h2><?=$product['title']?></h2>
        <p class="normal_price" id="cross">$<?=$product['normal_price']?></p>
        <p class="price">$<?=$product['discounted_price']?></p>
        <div>
            <button id="decreaseQuantity"><a href="productdetail.php?quantity=<?=$quantity?>&type=minus&id=<?=$id?>">-</a></button>
            <span id="quantity"><?=$quantity?></span>
            <button id="increaseQuantity"><a href="productdetail.php?quantity=<?=$quantity?>&type=plus&id=<?=$id?>">+</a></button>
        </div>
    </div>
</main>
<footer>
    <p>&copy; 2024 Online Store. All rights reserved.</p>
</footer>
</body>
</html>
