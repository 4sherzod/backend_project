<?php
session_start();
require_once "db.php";
$logged = false;
if(isset($_SESSION["user"])){
     $logged = true;
     $user = $_SESSION["user"];
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="index.css">
     <script>
          function clearPlaceholder(input) {
               input.placeholder = '';
          }
          function restorePlaceholder(input) {
               if (input.value === '') {
                    input.placeholder = 'Search...';
               }
          }
     </script>
</head>
<body>
     <form method="GET" action="">
          <header>
               <?php
                    if($logged){
                    echo '<p>Welcome ', $_SESSION["user"]["first_name"], '<br><a href="logout.php">(Log out)</a></p>';
                    echo "<div><a href='edit_profile.php'>edit_profile</a></div>";
                    }
                    else {
                         echo '<p>Welcome <br> <a href="login.php">(Log in)</a></p>';
                    }
               ?>
               <input type="text" id="searchInput" name="search" placeholder="Search..." onfocus="clearPlaceholder(this)" onblur="restorePlaceholder(this)" value="<?php echo htmlspecialchars($search); ?>">
               <div id="menu">
                    <a href="shoppingcart.php"><img src="" alt="Shopping Cart"></a>
               </div>
          </header>
     </form>
     <hr>
     <div class="grid-container">
     <?php
          if($logged) $products = getProducts($user["user_city"], $search);
          else $products = getProducts(null, $search);

          foreach($products as $i) {
               if(!$logged || $i["user_district"] == $user["user_city"]){
                    echo '<div class="item"><a href="productdetail.php?id=', $i['product_id'], '">';
                    echo '<img src="',$i['image_url'],'" alt="',$i['title'],'">
                    <p><span>',$i['discounted_price'],' TL</span></p>
                    <p>',$i['title'],'</p>';
                    echo '</a></div>';
               }
          }
          foreach($products as $i) {
               if($logged && $i["user_district"] != $user["user_city"]){
                    echo '<div class="item"><a href="productdetail.php?id=', $i['product_id'], '">';
                    echo '<img src="',$i['image_url'],'" alt="',$i['title'],'">
                    <p><span>',$i['discounted_price'],' TL</span></p>
                    <p>',$i['title'],'</p>';
                    echo '</a></div>';
               }
          }
     ?>
     </div>
</body>
</html>
