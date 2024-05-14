<?php
const DSN = "mysql:host=localhost;dbname=test;charset=utf8mb4" ;
const USER = "root" ;
const PASSWORD = "" ;

try {
     $db = new PDO(DSN, USER, PASSWORD) ; 
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
     $stmt = $db->prepare("update users set token = ? where user_email = ?") ;
     $stmt->execute([$token, $email]) ;
}
function getUserByToken($token) {
     global $db;
     $stmt = $db->prepare("select * from users where token = ?");
     $stmt->execute([$token]) ;
     return $stmt->fetch() ;
  }

  
 function isAuthenticated() {
     return isset($_SESSION["user"]) ;
 }