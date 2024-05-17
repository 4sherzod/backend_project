<?php
     session_start();
     require_once "db.php";
     $logged = false;
     if(isset($_SESSION["user"])){
          $logged = true;
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
          header { 
               display: flex;
               padding: 10px;
               background-color: aliceblue;
               margin: 0 auto;
               align-items: center;
               text-align: center;
          }
          input[type=text] {
               left: 200px;
               padding: 10px;
               width: 350px;
               height: 30px;
               font-size: 17px;
               margin: 0 auto;
               align-items: center;
               text-align: center;
          }
          #menu {
               display: flex;
               float: right;
               width: 150px;
               height: 50px;
          }
          #menu a {
               width: 75px;   
               height: 50px;
               margin: 5px;
               border: solid black 1px;
          }
          .grid-container {
               display: grid;
               grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
               gap: 10px;
               padding: 10px;
          }
          .item {
               border: solid black 1px;
               text-align: center;
               display: flex;
               flex-direction: column;
               justify-content: space-between;
               padding: 10px;
          }
          a {
               text-decoration: none;
               color: inherit;
          }
          .item img {
               max-width: 100%;
               height: auto;
               object-fit: cover;
          }
          .item p span {
               background-color: darkred;
               color: white;
               padding: 3px;
          }
          .item p {
               float: bottom;
               color: black;
               margin: 0;
          }
     </style>
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
     <header>
          <?php
               if($logged) {
          ?>
               <p>Welcome <?=$_SESSION["user"]["first_name"]?> <br> <a href="logout.php">(Log out)</a></p>
          <?php
               }
               else {
          ?>
               <p>Welcome <br> <a href="login.php">(Log in)</a></p>
          <?php
               }
          ?>
          <input type="text" id="searchInput" placeholder="Search..." onfocus="clearPlaceholder(this)" onblur="restorePlaceholder(this)">
          <div id="menu">
               <a href="shoppingcart.php"><img src="" alt="Shopping Cart"></a>
          </div>
     </header>
     <hr>
     <div class="grid-container">
     <?php
          $products = getProducts();
          foreach($products as $i) {
               echo '<div class="item"><a href="productdetail.php?id=', $i['product_id'], '">';
               echo '<img src="',$i['image_url'],'" alt="',$i['title'],'">
               <p><span>',$i['discounted_price'],' TL</span></p>
               <p>',$i['title'],'</p>';
               echo '</a></div>';
          }
     ?>
     </div>
</body>
</html>
