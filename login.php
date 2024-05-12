<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
         
          body {
               background-color:#FFFDF6;
               font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          }
          #logindiv{
               margin:auto;
               background-color:white;
               width: 40%;
               text-align: center;
               border-radius: 2px;
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          }
          #logindiv * {
               align-items: center;
               display: block;
               width: 90%;
          }
          #email,#password{
               height: 35px;
               margin: 40px 50px;
               border-radius: 2px;
               border: 1px solid darkgray;
               text-indent: 10px;
          }
          #loginbtn {
               margin: 40px 130px 0px;
               width: 300px;
               height: 40px;
               border-radius: 50px;
               border: 1px solid lightgray;
               background-color: #608F6B;
               font-weight: bold;
               font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
               color:white;
          }
          h1{
               margin-bottom: 30px;
               margin-top: 120px;
               text-align: center;
               color: #DC9D23;
          }

          /* #p {
               border: 1px solid red;
               margin: 10px 50px;
               text-align: center;
          } */
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
          span{ color: #40674A;}

     </style>
</head>
<body>
     <h1>Bil<span>Grocer</span></h1>
     <div id="logindiv">
          <form method="post">
               <br>
               <input type="text" name="email" id="email" placeholder="E-MAIL" value="<?= $email ?? '' ?>"> 
               <input type="text" name="password" id="password" placeholder="PASSWORD" value="<?= $password ?? '' ?>"> 
               <input type="button" value="LOG IN" id="loginbtn">
               <p id="p">New to BilGrocer? <a href="register.php">  Join now</a></p>
          </form>

     </div>
</body>
</html>