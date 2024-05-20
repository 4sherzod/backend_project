<?php
const DSN = "mysql:host=localhost;dbname=UsersDB;charset=utf8mb4";
const USER = "root";
const DBPASSWORD = "";

try {
    $db = new PDO(DSN, USER, DBPASSWORD);
} catch(PDOException $e) {
    echo "Set username and password in 'db.php' appropriately";
    exit;
}

function markExpiredProducts() {
    global $db;
    $sql = "UPDATE products SET status = 'expired' WHERE expiration_date < NOW()";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}

// function checkUser($email, $password, &$user) {
//     global $db;
//     $stmt = $db->prepare("SELECT * FROM users WHERE user_email = ?");
//     $stmt->execute([$email]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user && password_verify($password, $user['user_password'])) {
//         return $user;
//     }
//     return false;
// }

function checkUser($email, $pass, &$user) {
    global $db;

    $stmt = $db->prepare("select * from users where user_email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ( $user ) {
         return password_verify1($pass, $user["user_password"]);
    }
    return false ;
}
function password_verify1($pass1, $pass2) {
    return $pass1 == $pass2;
}

function setTokenByEmail($email, $token) {
    global $db;
    $stmt = $db->prepare("UPDATE users SET user_session_token = ? WHERE user_email = ?");
    $stmt->execute([$token, $email]);
}

function getUserByToken($token) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE user_session_token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function isAuthenticated() {
    return isset($_SESSION["user"]);
}

function getProducts($city, $search) {
    global $db;
    if (isset($city)) {
        $stmt = $db->prepare("SELECT p.*, u.user_district
                              FROM products p
                              JOIN users u ON p.user_id = u.user_id
                              WHERE u.user_city = ? AND p.title LIKE ?");
        $stmt->execute([$city, "%$search%"]);
    } else {
        $stmt = $db->prepare("SELECT p.*, u.user_district
                              FROM products p
                              JOIN users u ON p.user_id = u.user_id
                              WHERE p.title LIKE ?");
        $stmt->execute(["%$search%"]);
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addUser($user) {
    global $db;
    $stmt = $db->prepare("INSERT INTO users (
                          first_name, last_name, market_name, user_email, user_password, user_city, user_district, user_address, type_of_user
                          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $user['fname'],
        $user['lname'],
        $user['marketname'],
        $user['email'],
        $user['password'],
        $user['city'],
        $user['district'],
        $user['address'],
        $user['type_of_user'],
    ]);
}

function addProduct($product) {
    global $db;
    $stmt = $db->prepare("INSERT INTO products (
                          title, stock, normal_price, discounted_price, expiration_date, image_url, category, user_id
                          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $product['title'],
        $product['stock'],
        $product['normal_price'],
        $product['discounted_price'],
        $product['expiration_date'],
        $product['image_url'],
        $product['category'],
        $product['user_id'],
    ]);
}

function getProductById($product_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
