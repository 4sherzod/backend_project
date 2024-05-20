<?php

require_once "db.php";
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["type_of_user"] == '0') {
    header("Location: index.php");
    exit;
}

$stmt = $db->prepare('select * from products where user_id = ?');
$stmt->execute([$_SESSION["user"]["user_id"]]);
$list = $stmt->fetchAll();

$stmt = $db->prepare("SELECT * FROM products WHERE user_id = ?");
$stmt->execute([$_SESSION["user"]["user_id"]]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


function isDateBeforeToday($date) {
    // Parse the input date
    $inputDate = strtotime($date);
    if ($inputDate === false) {
        // Invalid date format
        return false;
    }

    // Get today's date
    $today = strtotime(date('Y-m-d'));

    // Compare the dates
    return $inputDate < $today;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h1{
            width: fit-content;
            margin: 50px auto;
            color: #40674A;
        }

        td,th{
            padding: 10px;
            border-bottom: 1px solid grey;
        }
        table {
            margin: auto;
            border-collapse: collapse;
        }
        span{ color: #DC9D23;}
        /* *{
            border: 1px solid red;
        } */
        .cross{
            color: lightgray;
        }
        .btncross a{
            margin-right: 10px;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            color: white;
            background-color: lightgray;
        }
        .btncross a:hover{
            background-color: gray;
        }
    </style>
</head>
<body>
    <h1>Welcome, <span> 
        <?php 
            $marketname = $_SESSION['user']['market_name'];
            echo $marketname; 
        ?>!</span></h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Stock</th>
                <th>Normal Price</th>
                <th>Discounted Price</th>
                <th>Expiration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
                    <?php 
                        if(isDateBeforeToday($row['expiration_date'])==true) {
                            echo "<tr class='cross'>";
                        }
                        else{ echo "<tr>";}
                    ?>
                    
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                    <td><?php echo htmlspecialchars($row['normal_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['discounted_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['expiration_date']);?></td>
                    <?php 
                        if(isDateBeforeToday($row['expiration_date'])==true) {
                            echo "<td class='btncross'>";
                        }
                        else{ echo "<td class='action-links'>";}
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
