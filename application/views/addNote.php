<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Note</title>
  <link rel="stylesheet" href="/assets/css/addNote.css">
</head>

<body>
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
          <a href="/dashboardController/show">Dashboard </a>
          <a href="/dashboardController/showAddNote">Add Notes </a>
          <a href="/dashboardController/signOut">Sign Out</a>
        </div>
      </div>
    </header>
    <div class="container">
      <div class="content">
        <h2 class="heading">ADD NOTE</h2>
        <div style="text-align:center;">
          <div id="corrSub">
            <?php
            if (isset($GLOBALS["checkUploadStatus"]) && $GLOBALS["checkUploadStatus"] == true) {
              echo "Data inserted successfully";
            }
            ?>
          </div>

        </div>


        <form action="/dashboardController/addNote" method="post" enctype="multipart/form-data">
          <div class="flex">
            <div class="login-sec">
              <label for="First name">Title</label><br>
              <input type="text" placeholder="Title" name="titleSec"  id="title"required>
            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="Note">Note</label><br>
              <textarea placeholder="Note" name="noteSec" id="noteBody" rows="10" cols="50"></textarea>
            </div>
          </div>
          <br>
          <div class="btn">
            <input type="submit" value="POST" class="login-btn" id="register" name='save'>
            <div style="color:red;">
              <?php if (isset($GLOBALS['regiserr'])) {
                echo $GLOBALS['regiserr'];
              }
              ?>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="/assets/js/addNote.js"></script> -->
</body>

</html>