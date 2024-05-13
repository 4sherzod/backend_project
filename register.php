<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <style>
        body{
            background-color:#FFFDF6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        #registerdiv{
               margin:auto;
               background-color:white;
               width: 40%;
               text-align: center;
               border-radius: 2px;
               box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          }
         
     </style>
</head>
<body>
     <h1>Create an Account</h1>
     <div id="registerdiv">
         <form method="post">
             <input type="radio" name="consumer" id="consumer"><label for="consumer">Consumer</label> 
             <input type="radio" name="market" id="market"><label for="market">Market</label><br>
              <input type="text" name="fname" id="" placeholder="Fist Name" value="<?= $fname ?? '' ?>"> <br>
              <input type="text" name="lname" id="" placeholder="Last Name" value="<?= $lname ?? '' ?>"> <br>
              <input type="text" name="email" id="" placeholder="E-mail" value="<?= $email ?? '' ?>"> <br>
              <input type="text" name="password" id="" placeholder="Password" value="<?= $password ?? '' ?>"> <br>
              <button type="submit">Create Account</button>
              <a href="login.php">back</a>
         </form>
     </div>
</body>
</html>