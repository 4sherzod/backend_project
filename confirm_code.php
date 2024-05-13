<?php 
     session_start();
     $receivedCode = isset($_SESSION['code']) ? $_SESSION['code'] : '';
     echo "code is: ", $receivedCode;
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
     <form method="post">
          <input type="text" class="input" name="code" placeholder="Confirmation Code" value="<?= isset($_POST['code'])?$_POST['code']:''?>">
          <button type="submit">confirm</button>
     </form>
</body>
</html>