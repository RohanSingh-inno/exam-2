<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="register.css">
  <script src="/js/validate.js"></script>
</head>

<body>
<?php
  if (isset($_POST['register'])) {
    //including the validation php file
    include 'validate.php';
    global $obj;
    // //object creation
    $obj = new validate();
    // //calling object methods
    $obj->register($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['number'], $_POST['password']);
  }


  ?>
  <div class="body">
    <div class="container">
      <div class="content">
        <h1>Register</h1>
        <div id="corrSub">
          <?php 
          
          if (isset($obj->checkSubmit) && $obj->checkSubmit == true) {
            echo "Successfully Submitted";
          }
          ?>
        </div>
        <form action="" method="post">
          <div class="flex">
            <div class="login-sec">
              <label for="First name">Enter First Name</label><br>
              <input type="text" placeholder="First name" name="fname" id="fname" onblur="fnameValid()" required>
              <div id="fnameErr"></div>
              <div style="color:red;">
                <?php
                if (isset($GLOBALS['ferr'])) {
                  echo $GLOBALS['ferr'];
                }
                ?>
              </div>
            </div>
            <div class="login-sec">
              <label for="Last name">Enter Last Name</label><br>
              <input type="text" placeholder="Last name" name="lname" id="lname" onblur="lnameValid()" required>
              <div id="lnameErr"></div>
              <div style="color:red;">
                <?php if (isset($GLOBALS['lerr'])) {
                  echo $GLOBALS['lerr'];
                } ?>
              </div>

            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="Email">Email address or username</label><br>
              <input type="text" placeholder="Email address or username" name="email" id="email" onblur="emailValid()"
                required>
              <div id="emailErr"></div>
              <div style="color:red;">
                <?php if (isset($GLOBALS['mailerr'])) {
                  echo $GLOBALS['mailerr'];
                } ?>
              </div>
            </div>
            <div class="login-sec">
              <label for="Number">Enter Contact Number</label><br>
              <input type="text" placeholder="Enter your Phone Number" name="number" id="phone" onblur="phoneValid()"
                required>
              <div id="phoneErr"></div>
              <div style="color:red;">
                <?php if (isset($GLOBALS['numerr'])) {
                  echo $GLOBALS['numerr'];
                } ?>
              </div>
            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="Password">Create a Password</label><br>
              <input type="password" placeholder="Create Password" name="password" id="password"
                onblur="passwordValid()" required>
              <div id="PasswordErr"></div>
              <div style="color:red;">
                <?php if (isset($GLOBALS['passerr'])) {
                  echo $GLOBALS['passerr'];
                } ?>
              </div>
            </div>
            <div class="login-sec">
              <label for="Password">Confirm your Password</label><br>
              <input type="password" placeholder="Confirm your Password" id="confirm_password" onblur="passwordMatch()"
                required>
              <div id="diffPassword"></div>
            </div>
          </div>
          <br>
          <div class="btn">
            <input type="submit" value="SIGN UP" class="login-btn" id="register" name='register'>

          </div>
          <div class="registerCheck">
            <?php if (isset($GLOBALS['regiserr'])) {
              echo $GLOBALS['regiserr'];
            }
            ?>
          </div>
        </form>
        <div class="flex look">
          <hr>
          <p>or</p>
          <hr>
        </div>
        <div class="askRegister">
          <p>Already have an Account?</p>
          <div class="anchor">
            <a href="login.php" class="AnchorRedirect">LOG IN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>