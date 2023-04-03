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
  <link rel="stylesheet" href="dashboard.css">

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
          <a href="addNote.php">Add Notes </a>
          <a href="login.php">Sign Out</a>
        </div>
      </div>
    </header>

    <div class="container">

      <div class="content" id="page">
        <!-- ajax loaded code  -->
      </div>

    </div>

  </div>
  <footer>
    <p>Developed By Rohan Singh - Free for you <span class="footer-heart">&#10084;</span> </p>
  </footer>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/loadMore.js"></script>
</body>

</html>

