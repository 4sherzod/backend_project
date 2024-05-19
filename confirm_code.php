<?php 
     require_once "db.php";
     require_once "mail.php";
     session_start();

     $new_user = $_SESSION['new_user'];
     
     var_dump($new_user);
     if ( isset($_GET["resend"]) ) {
          $resend = $_GET["resend"];
          if($resend == '1') {
               $_SESSION['code'] = rand(100000, 999999);
               Mail::send($email, "TEST", "IDK SMTH");     
          }
     }

     $receivedCode = isset($_SESSION['code']) ? $_SESSION['code'] : '';
     echo "<br>code is: ", $receivedCode;


     if ( !empty($_POST)) {
        extract($_POST) ;
        //var_dump($_POST);
        if ($code == $receivedCode) {
               addUser($new_user);
               
               unset($_SESSION["new_user"]);
               header("Location: login.php") ;
               exit;
        }
        else {
          ?>
          <script>
               document.addEventListener('DOMContentLoaded', function() {
                    var err = document.getElementById('err');
                    err.className = 'show';
               });
          </script>
        <?php }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="confirm.css">
</head>
<body>
     <form method="post">
          <div class="box">
               <div>
                    <!-- <i class="far fa-envelope" id="envelope"></i> -->
                    <img class="img"src="./email.png" alt="">

               </div>
               <h4>Verify its you</h4><hr>
               <div>
                    <p class="text">A verification code was sent to<b><?php echo $new_user['email'],'&nbsp'; ?></b></p>
                    <p>Please check your inbox and enter the code below</p>
                    <p>6 digit code</p>
               </div>
               <input type="text" class="input" id="code" name="code" value="<?= isset($_POST['code'])?$_POST['code']:''?>" maxlength="6">
               <div id="err" class="hidden">Wrong code. Please try again</div>
               <button type="submit" class="btn">Confirm</button>
               <p class="text">Didn't receive any email?<b><a href="confirm_code.php?resend=1">Try again</a></b></p>
          </div>
     </form>
</body>
</html>

<script>
     document.getElementById("code").addEventListener("keyup", function() {
     this.value = this.value.replace(/[^0-9]/g, "");
});
</script>