<script>
    var $type_of_user;
</script>
<?php
    require_once "db.php";
    session_start();
    $userID = $_SESSION['user']['user_id'];
    echo $userID;
    $user = getUserById($userID);
    var_dump($user);
    echo $user['user_email'];


    //if ( !empty($_POST)) {
    //     extract($_POST) ;
    //     //var_dump($_POST);
    //     if($fname) echo "123";
    //     else echo "456";
    //     if ((isset($fname) && $fname == "TEST") || (isset($marketname) && $marketname == "TEST")) {
    //         $new_user = [
    //                     'fname' => $fname,
    //                     'lname' => $lname,
    //                     'marketname' => $marketname,
    //                     'email' => $email,
    //                     'password' => $password,
    //                     'city' => $city,
    //                     'district' => $district,
    //                     'address' => $address,
    //                     'type_of_user' => $type_of_user
    //                     ];
    //         $_SESSION['code'] = rand(100000, 999999);
    //         $_SESSION['new_user'] = $new_user;
    //         Mail::send($email, "TEST", "IDK SMTH");
    //         header("Location: confirm_code.php") ;
    //         exit;
    //     }
    //     else {
    //         echo 'Make the name = "TEST" to go to the confirmation page';
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
     <style>
        #opt{
            display: flex;
            margin: 10px 50px 0;
            height: 90px;
        }
        #consumer,#market{
            color: white;
            height: 50px;
            margin-top: 40px;
            line-height: 50px;
            font-weight: bold;
        }
        #consumer {
            border-radius: 20px 0 0 20px;
        }
        #market{
            border-radius: 0 20px 20px 0;
        }
        #consumer:hover, #market:hover{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .normal{
            background-color: #EEC982;
        }
        .chosen {
            background-color: #DC9D23;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #city{
          display: flex;
          gap: 40px;
          margin: 0 50px;
          width: 467px;
        }
        #p{
            margin: 20px 160px;
        }
        #opt a {
            text-decoration: none;
        }
        .box{
            padding-top: 20px;
        }
     </style>
     
     </head>
<body>
    <h1 class="title">Edit your Account</h1>
    <div id="registerdiv" class="box">
        <form method="post">
            <input type="text" class="input" name="fname" id="fname" placeholder="First Name" style="display: <?= $type_of_user == 0 ? 'block' : 'none'; ?>" value="<?= isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
            <input type="text" class="input" name="lname" id="lname" placeholder="Last Name" style="display: <?= $type_of_user == 0 ? 'block' : 'none'; ?>" value="<?= isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
            <input type="text" class="input" name="marketname" id="marketname" placeholder="Market Name" style="display: <?= $type_of_user == 0 ? 'none' : 'block'; ?>" value="<?= isset($_POST['marketname']) ? $_POST['marketname'] : ''; ?>">
            <input type="text" class="input" name="email" id="email" placeholder="E-mail" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <input type="password" class="input" name="password" id="password" placeholder="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>">
          
            <div id="city">
                <input type="text" class="input2" name="city" id="" placeholder="City" value="<?= isset($_POST['city']) ? $_POST['city'] : ''; ?>">
                <input type="text" class="input2" name="district" id="" placeholder="District" value="<?= isset($_POST['district']) ? $_POST['district'] : ''; ?>">
            </div>
            <input type="text" class="input" name="address" id="address" placeholder="Address" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>">
            <button type="submit" class="btn">Create Account</button>
            <p id="p">Already have an account? <a href="login.php"> Sign in</a></p>
        </form>
     </div>
</body>
</html>