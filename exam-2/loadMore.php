<?php
session_start();
/* 
   * getting data from  database
   */
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "Anju@8274";
    $dbname = "notepad";
    // $conn = $this->checkConnection();
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    /*
     * Check connection
     */
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $limit = 1;
    $page = "";
    if (isset($_POST['page_no'])) {
      $page = $_POST['page_no'];
    } else {
      $page = 0;
    }
    $query1 = 'select * from Notes where UserNum ='.$_SESSION['UserNumber'].' LIMIT ' . $page . ', ' . $limit .' ;';
    $res = $conn->query($query1);
   
    

    if (mysqli_num_rows($res) > 0) {
      $output = "";
      $output .= "<div class='sec'>";
      while ($row = mysqli_fetch_assoc($res)) {
        $title = $row["title"];
        $body = $row['NoteBody'];
        $currDate = $row['currentDate'];
        $number = $row['numberOfNotes'];
        $_SESSION['NumberOfNotes']  = $row['numberOfNotes'];

        $output .= "  <a href='NotePage.php'> 
                      <h2>$title</h2>
                      <h3>$currDate</h3>
                      <p>$body</p>
                      </a>";
      }
      $output .= "</div>
                  <div class='flex loadMore'>
                    <button class='ajaxbtn' data-id='{$number}'>Load more</button>
                  </div>";

      echo $output;
    } else {
      echo "Add some notes!";
    }

?>