<?php

class validate
{
  public $servername = "localhost";
  public $dbusername = "root";
  public $dbpassword = "Anju@8274";
  public $dbname = "notepad";
  public $num = '';
  public $checkLogin = false;
  public $info;

  public $notesInfo;


  public $fnameErr = '';
  public $LnameErr = '';
  public $EmailErr = '';
  public $NumErr = '';
  public $AgeErr = '';
  public $passErr = '';
  public $RefisErr = '';
  public $checkSubmit = false;


  public $changeStatus = false; //for user profile update
  public $uploadErr = '';
  public $checkUpload = false;

  /*
   * A common function which will check the data coming from input tag.It checks trim,stripslashes,htmlspecialcharacter
   */
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  /* 
   * Check connection 
   */
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

  //   REgister 

  /*
   * function to validate the first name
   */
  function firstNameValid($firstName)
  {
    $fname = $this->test_input($firstName);
    if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
      $this->fnameErr = '* Only letters and white spaces allowed';
      return false;
    } else {
      $this->fnameErr = '';
      return true;
    }
  }

  /*
   * function the validate lastname
   */
  function lastNameValid($lastName)
  {
    $lname = $this->test_input($lastName);
    if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
      $this->LnameErr = '* Only letter and white space allowed';
      return false;
    } else {
      $this->LnameErr = '';
      return true;
    }
  }
  /*
   * function the validate email syntax
   */
  function emailValid($email)
  {
    $mailId = $this->test_input($email);
    if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mailId)) {
      $this->EmailErr = '* Not a valid email';
      return false;
    } else {
      $this->EmailErr = '';
      return true;
    }

  }

  /*
   * function to validate mobile number 
   */
  function numberValid($mobileNumber)
  {
    $number = htmlspecialchars($mobileNumber);
    if (!preg_match('/^[+][9][1]?[6-9]\d{9}$/', $number)) {
      $this->NumErr = '* Not a valid number';
      return false;
    } else {
      $this->NumErr = '';
      return true;
    }
  }

  /*
   * function to validate password
   */
  function passwordValid($password)
  {
    $pass = htmlspecialchars($password);
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/', $pass)) {
      $this->passErr = '* Not a valid password';
      return false;
    } else {
      $this->passErr = '';
      return true;
    }
  }


  /*
   * function to check registration
   */
  function register($fname, $lname, $email, $phone, $pass)
  {
    $this->firstNameValid($fname);
    $this->lastNameValid($lname);
    $this->emailValid($email);
    $this->numberValid($phone);
    $this->passwordValid($pass);

    if (($this->firstNameValid($fname) == true) && ($this->lastNameValid($lname) == true) && ($this->emailValid($email) == true) && ($this->numberValid($phone) == true) && ($this->passwordValid($pass) == true)) {
      $conn = $this->checkConnection();
      $stmt = $conn->prepare("INSERT INTO userInfo(fname,lname,email,phone,password) VALUES (?,?,?,?,?)");
      $stmt->bind_param('sssss', $fname, $lname, $email, $phone, $pass);

      $query1 = "SELECT email FROM userInfo where email = '" . $email . "';";
      $res = $conn->query($query1);

      $num1 = mysqli_num_rows($res);
      if ($num1 == 0) {
        if ($stmt->execute()) {
          $this->RefisErr = '';
          $this->checkSubmit = true;
          $stmt->close();
          $conn->close();
          return true;
        } else {
          $this->RefisErr = '* Unable to execute';
          $stmt->close();
          $this->$conn->close();
          return false;
        }
      } else {
        $this->RefisErr = '* Email Already in use!! <br> try with another email';
        $stmt->close();
        return false;
      }
    } else {
      $this->RefisErr = '* Error sending Data to database';
    }

  }

  // DashBoard 




  /* 
   * add note function to add note  
   */

  function addNote($title, $NoteBody, $UserNum)
  {
    $conn = $this->checkConnection();

    $stmt = $conn->prepare("INSERT INTO Notes(title,Notebody,currentDate,UserNum) VALUES (?,?,CURDATE(),?)");
    $stmt->bind_param('sss', $title, $NoteBody, $UserNum);

    $query1 = "SELECT title FROM Notes where title = '" . $title . "';";
    $res = $conn->query($query1);

    $num1 = mysqli_num_rows($res);
    if ($num1 == 0) {
      if ($stmt->execute()) {
        $this->uploadErr = '';
        $this->checkUpload = true;
        $stmt->close();
        $conn->close();
        return true;
      } else {
        $this->uploadErr = 'Unable to upload <br> Error : 510';
        $stmt->close();
        $this->$conn->close();
        return false;
      }
    } else {
      $this->uploadErr = 'Song already present in database';
      $stmt->close();
      $this->$conn->close();
      return false;
    }

  }
  /*
   * It will return the the value from db in the note page,which opens on clicking any particular note
   */

  function Note($value)
  {
    $conn = $this->checkConnection();
    $sql = 'SELECT * FROM Notes where numberOfNotes = "' . $value . '";';
    $res = $conn->query($sql);

    /*
     * It will return the number of rows having the following details in the db
     */
    $this->num = mysqli_num_rows($res);
    $this->notesInfo = mysqli_fetch_assoc($res);

  }
}
?>

