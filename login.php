<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
     <style>
          #p {
               margin: 20px 190px;
               text-align: center;
               white-space: nowrap; 
               text-align: center;
               width: 20px;
               height: 40px;
          }

        #p a {
               display: inline-block;
          }
          span{ color: #DC9D23;}

     </style>
</head>
<body>
     <h1 class="title"><span>Bil</span>Grocer</h1>
     <div id="logindiv" class="box">
          <form method="post">
               <br>
               <input type="text" class="input" name="email" placeholder="E-MAIL" value="<?= $email ?? '' ?>"> 
               <input type="text" class="input" name="password" placeholder="PASSWORD" value="<?= $password ?? '' ?>"> 
               <input type="button" class="btn" value="LOG IN" id="loginbtn">
               <p id="p">New to BilGrocer? <a href="register.php">  Join now</a></p>
          </form>
     </div>
</body>
</html>