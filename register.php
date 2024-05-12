<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>
<body>
     <h1>Create an Account</h1>
     <form method="post">
          <input type="text" name="fname" id="" placeholder="Fist Name" value="<?= $fname ?? '' ?>"> <br>
          <input type="text" name="lname" id="" placeholder="Last Name" value="<?= $lname ?? '' ?>"> <br>
          <input type="text" name="email" id="" placeholder="E-mail" value="<?= $email ?? '' ?>"> <br>
          <input type="text" name="password" id="" placeholder="Password" value="<?= $password ?? '' ?>"> <br>
          <input type="radio" name="market" id="market"><label for="market">Market</label>
          <input type="radio" name="consumer" id="consumer"><label for="consumer">Consumer</label> <br>
          <button type="submit">Create Account</button>
          <a href="login.php">back</a>
     </form>
</body>
</html>