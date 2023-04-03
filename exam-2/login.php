<?php
session_start();

if (isset($_SESSION['LoggedIN'] ) && $_SESSION['LoggedIN'] == true) {
  session_unset();
  session_destroy();
  header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="login.css">
  <script src="/js/validate.js"></script>
</head>

<body>
  <?php
  if (isset($_POST['login'])) {
    //including the validation php file
    include 'validate.php';
    global $obj;
    // //object creation
    $obj = new validate();
    // //calling object methods
    $obj->login($_POST['email'], $_POST['password']);
    if ($obj->num == 1) {
      $obj->checkLogin = true;
      $_SESSION['UserNumber'] = $obj->info['numberOfUsers'];
      $_SESSION['Fname'] = $obj->info['fname'];
      $_SESSION['Lname'] = $obj->info['lname'];
      $_SESSION['email'] = $obj->info['email'];
      $_SESSION['PhoneNumber'] = $obj->info['phone'];
      $_SESSION['LoggedIN'] = true;
      header("location: dashboard.php");
    }



  }
  ?>
  <div class="body">
    <div class="container">
      <div class="content">
        <h1>Login</h1>
        <div id="corrSub">
          <?php

          if (isset($obj->checkLogin) && $obj->checkLogin == false) {
            echo "NOT A REGISTERED USER <br> PLEASE REGISTER YOURSELF";
          }
          ?>
        </div>
        <form action="" method="post">
          <div class="login-sec">
            <label for="Email">Email address or username</label><br>
            <input type="text" name="email" placeholder="Email address or username" id="email" onblur="emailValid()"
              required>
            <div id="emailErr"></div>
          </div>
          <div class="login-sec">
            <label for="Password">Enter Password</label><br>
            <input type="password" name="password" placeholder="Password" id="password" onblur="passwordValid()"
              required>
            <div id="PasswordErr"></div>
          </div>
          <br>
          <div class="btn">
            <input type="submit" value="LOG IN" class="login-btn" id="register" name="login">
          </div>
        </form>
        <div class="flex look">
          <hr>
          <p>or</p>
          <hr>
        </div>
        <div class="askRegister">
          <p>Not a Registered User?</p>
          <div class="anchor">
            <a href="register.php" class="AnchorRedirect">SIGN UP</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>