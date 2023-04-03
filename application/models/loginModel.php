<?php
class loginModel
{
  public $servername = "localhost";
  public $dbusername = "root";
  public $dbpassword = "Anju@8274";
  public $dbname = "notepad";
  public $num = '';
  public $mailId = "";
  public $passReset="";
  public $passResetErr = '';
  public $mailCheck = false;
  public $mailSend = false;
  public $mailSendFailErr = '';
  public $info;

  /*
   * Utility function to check special characters,signs etc
   */
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function checkConnection()
  {
    /* 
     * Create connection 
     */
    $conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);
    /*
     * Check connection
     */
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }

  function login($login, $pass)
  {
    $conn = $this->checkConnection();
    $sql = "SELECT * FROM userInfo where email = '" . $login . "' AND password = '" . $pass . "'";
    $res = $conn->query($sql);
    
    /*
     * It will return the number of rows having the following details in the db
     */
    $this->num = mysqli_num_rows($res);
    $this->info = mysqli_fetch_assoc($res);
  }
  /*
   * function to validate email via API
   */
  function emailValid($email)
  {
    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$email",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: text/plain",
          "apikey: O2RfRcCmytBtpCTDcaScbR0YUNftd7nw"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
      )
    );

    $response = curl_exec($curl);
    curl_close($curl);

    $email_check = json_decode($response, true);
    // print_r($email_check) ;

    if ($email_check['format_valid'] && $email_check['smtp_check']) {
      $this->mailId = $email_check["email"] . " is a valid email";
      $this->mailCheck = true;
      echo $this->mailId;
    } else {
      $this->mailId = " Invalid Email Address";
    }
  }


  /*
   * function to check if mail already present in db
   */
  function ResetLinkSend($email)
  {
    $conn = $this->checkConnection();
    $query1 = "SELECT email FROM userInfo where email = '". $email."';";
    $res = $conn->query($query1);

    $num = mysqli_num_rows($res);
    if ($num == 1) {
    //   $this->mailer($email);
    }else{
      $this->passReset = "Not a register user !!";
    }
  }

  /*
   * function to update password in db
   */
  function passResetValid($email,$newpass)
  {
    $conn = $this->checkConnection();
    $query1 = "SELECT email FROM userInfo where email = '" . $email . "';";
    $res = $conn->query($query1);

    $num = mysqli_num_rows($res);
    if ($num > 0) {
      $sql = "UPDATE userInfo SET Password = '" . $newpass . "' WHERE email ='" . $email . "';";
      $conn->query($sql);
    } else {
      $this->passResetErr = "Not a register user !!";
    }
  }

  /*
   * function to send mail
   */
//   function mailer($data)
//   {
//     $mail = new PHPMailer(true);

//     try {
//       //Server settings
//       $mail->SMTPDebug = 0; //Enable verbose debug output
//       $mail->isSMTP(); //Send using SMTP
//       $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
//       $mail->SMTPAuth = true; //Enable SMTP authentication
//       $mail->Username = 'jayeshyadav947@gmail.com'; //SMTP username
//       $mail->Password = 'fiqxjfjjrinoruug'; //SMTP password
//       $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
//       $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//       //Recipients
//       $mail->setFrom('rohan.singh@innoraft.com', 'God');
//       $mail->addAddress($data); //Add a recipient   
//       $mail->addReplyTo('rohan.singh@innoraft.com', 'God');

//       /*
//        * Content
//        */
//       /*
//        * Set email format to HTML
//        */
//       $mail->isHTML(true);
//       $mail->Subject = 'Password Reset Alert!';
//       $mail->Body = 'You can reset your password <a href="http://assignment4.net/loginController/resetPasswordPage" style="color:blue;">Here</a> .';


//       $mail->send();
//       $this->mailSend = true;
//     } catch (Exception $e) {
//       $this->mailSendFailErr = $mail->ErrorInfo;
//       $this->mailSend = false;
//     }
//   }


}
?>