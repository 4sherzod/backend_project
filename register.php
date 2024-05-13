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
            color:white;
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
        .box{
          padding-bottom: 30px;
        }
        #city{
          display: flex;
          gap: 40px;
          margin: 0 50px;
          width: 467px;
        }
     </style>
     <script src="register.js"></script>
</head>
<body>
    <h1 class="title">Create an Account</h1>
    <div id="registerdiv" class="box">
        <form method="post">
            <div id="opt">
                <div id="consumer" class="chosen">Consumer</div>
                <div id="market" class="normal">Market</div>
            </div>
            <input type="text" class="input" id="fname" placeholder="First Name" value="<?= isset($_POST['fname'])?$_POST['fname']:''?>"> 
            <input type="text" class="input" id="lname" placeholder="Last Name" value="<?= isset($_POST['lname'])?$_POST['lname']:''?>">
            <input type="text" class="input" id="marketname" placeholder="Market Name"  style="display: none;" value="<?= isset($_POST['marketname'])?$_POST['marketname']:''?>">  
            <input type="text" class="input" id="email" placeholder="E-mail" value="<?= isset($_POST['email'])?$_POST['email']:''?>"> 
            <input type="password" class="input" id="password" placeholder="Password" value="<?= isset($_POST['password'])?$_POST['password']:''?>">
          
            <div id="city">
                 <input type="text" class="input2" name="city" id="" placeholder="City" value="<?= isset($_POST['city'])?$_POST['city']:''?>" >
                 <input type="text" class="input2" name="disctrict" id="" placeholder="District" value="<?= isset($_POST['district'])?$_POST['district']:''?>">
            </div>
            <input type="text" class="input" name="" id="" placeholder="Address" value="<?= isset($_POST['address'])?$_POST['address']:''?>">
            <button type="submit" class="btn">Create Account</button>
         </form>
     </div>
</body>
</html>
