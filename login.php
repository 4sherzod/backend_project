<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
          body {
               background-color:lightblue;
          }
          #login{
               background-color:white;
          }
     </style>
</head>
<body>
     <h1>LOGIN</h1>
     <div id="login">
          <form method="post">
               <input type="text" name="email" id="" placeholder="E-MAIL" value="<?= $email ?? '' ?>"> <br>
               <input type="text" name="password" id="" placeholder="PASSWORD" value="<?= $password ?? '' ?>"> <br>
               <button type="submit">LOGIN</button>
               <p>New to BilFood? <a href="register.php">Join now</a> </p>
          </form>
     </div>
</body>
</html>