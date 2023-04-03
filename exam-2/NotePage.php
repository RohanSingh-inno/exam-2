<?php
// local-notepad-app.com
session_start();
if (!isset($_SESSION['LoggedIN'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Note</title>
  <link rel="stylesheet" href="NotePage.css">

</head>

<body>
  <?php

  include 'validate.php';
  global $obj;
  // //object creation
  $obj = new validate();
  // //calling object methods
  $obj->Note($_SESSION['NumberOfNotes']);

  ?>
  <div class="body">
    <header>
      <div class="navbar flex">
        <div class="logo">
          <p>NotePad</p>
        </div>
        <div class="nav-items">
          <a href="">Hi!
            <?php if (isset($_SESSION['Fname'])) {
              echo $_SESSION['Fname'];
            } ?>
          </a>
          <a href="addNote.php">Add Notes </a>
          <a href="login.php">Sign Out</a>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="flex">
            <div class="login-sec">
              <label for="First name">Title</label><br>
              <input type="text" placeholder="Title" name="titleSec" id="title"
                value="<?php echo $obj->notesInfo['title']; ?>">
            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="Note">Note</label><br>
              <textarea placeholder="Note" name="noteSec" id="noteBody" rows="10"
                cols="50"><?php echo $obj->notesInfo['NoteBody']; ?></textarea>
            </div>
          </div>
          <br>
          <div class="flex btnspecial">
            <div class="btn">
              <input type="submit" value="Save" class="login-btn" id="register" name='save'>
            </div>
            <div class="btn">
              <input type="submit" value="Delete" class="login-btn" id="register" name='save'>
            </div>
          </div>
      </div>
    </div>

    </form>
  </div>
  </div>

  </div>
  <footer>
    <p>Developed By Rohan Singh - Free for you <span class="footer-heart">&#10084;</span> </p>
  </footer>
</body>

</html>