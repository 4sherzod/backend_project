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

          .checkbox-container {
               display: flex;
               /* margin-top: 20px; */
               margin-left: 50px;
               width: 150px;
          }
          .checkbox-label {
               text-align: left;
               text-indent: 10px;
          }
          #a {
               width: 20px
          }
     </style>
</head>
<body>
     <h1 class="title"><span>Bil</span>Grocer</h1>
     <div id="logindiv" class="box">
          <form method="post">
               <br>
               <input type="text" class="input" name="email" placeholder="E-MAIL" value="<?= $email ?? '' ?>"> 
               <input type="password" class="input" name="password" placeholder="PASSWORD" value="<?= $password ?? '' ?>"> 
               <div class="checkbox-container">
                    <div id="a">
                         <input type="checkbox" id="remember" name="remember" style="margin-right: 5px;"> 
                    </div>
                    <div class="checkbox-label"><label for="remember" >Remember me</label></div>
               </div>
               <button type="submit" class="btn">LOG IN</button>
               <p id="p">New to BilGrocer? <a href="register.php">  Join now</a></p>
          </form>
     </div>
</body>
</html>