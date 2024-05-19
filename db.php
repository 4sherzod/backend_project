<?php
const DSN = "mysql:host=localhost;dbname=UsersDB;charset=utf8mb4" ;
const USER = "root" ;
const DBPASSWORD = "" ;

try {
     $db = new PDO(DSN, USER, DBPASSWORD) ; 
     // $stmt = $db->prepare("select * from users");
     // $stmt->execute();
     // $users = $stmt->fetchAll();
} catch(PDOException $e) {
     echo "Set username and password in 'db.php' appropriately" ;
     exit ;
}


function checkUser($email, $pass, &$user) {
     global $db;
     
     $stmt = $db->prepare("select * from users where user_email = ?");
     $stmt->execute([$email]);
     $user = $stmt->fetch();
     
     if ( $user) {
          return password_verify1($pass, $user["user_password"]);
     }
     return false ;
}

function password_verify1($s1, $s2) {
     return $s1 == $s2;
}

function setTokenByEmail($email, $token) {
     global $db;
     $stmt = $db->prepare("update users set user_session_token = ? where user_email = ?") ;
     $stmt->execute([$token, $email]) ;
}
function getUserByToken($token) {
     global $db;
     $stmt = $db->prepare("select * from users where user_session_token = ?");
     $stmt->execute([$token]) ;
     return $stmt->fetch() ;
  }

  
 function isAuthenticated() {
     return isset($_SESSION["user"]) ;
 }

 function getProducts ($city){
     global $db;
     $stmt = $db->prepare("select p.*, u.user_district
                         from products p
                         join users u on p.user_id = u.user_id
                         where u.user_city = ?");
     $stmt->execute([$city]);
     return $stmt->fetchAll();
 }

function getUserById($id) {
     global $db;
     $stmt = $db->prepare("select * from users where user_id = ?");
     $stmt->execute([$id]) ;
     return $stmt->fetch() ;
}

function addUser($user) {
     global $db;
     $stmt = $db->prepare("
     INSERT INTO users (
          first_name, last_name, market_name, user_email, user_password, user_city, user_district, user_address, type_of_user
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
     ");
     $stmt->execute([
          $user['fname'],
          $user['lname'],
          $user['marketname'],
          $user['email'],
          $user['password'],
          $user['city'],
          $user['district'],
          $user['address'],
          $user['type_of_user'],    // Assuming '0' for 'type_of_user'
      ]);
}

function addProduct($product) {
     global $db;
     $stmt = $db->prepare("
     INSERT INTO products (
          title, stock, normal_price, discounted_price, expiration_date, image_url, category, user_id
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
     ");
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

function getProductbyId ($product_id){
     global $db;

     $stmt = $db->prepare("SELECT * FROM products WHERE product_id = ?");
     $stmt->execute([$product_id]);
     return $stmt->fetch();
     
 }
