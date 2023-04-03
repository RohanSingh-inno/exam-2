<?php

class dashboardModel
{
    public $servername = "localhost";
    public $dbusername = "root";
    public $dbpassword = "Anju@8274";
    public $dbname = "notepad";
    public $changeStatus = false; //for user profile update

    public $uploadErr = '';
    public $checkUpload = false;



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


    /* 
     * getting data from  database
     */
    public function getDetails()
    {
        $conn = $this->checkConnection();
        $limit = 1;
        $page = "";
        if (isset($_POST['page_no'])) {
            $page = $_POST['page_no'];
        } else {
            $page = 0;
        }
        $query1 = 'select * from Notes LIMIT ' . $page . ', ' . $limit . ';';
        $res = $conn->query($query1);

        if (mysqli_num_rows($res) > 0) {
            $output = "";
            $output .= "<div class='sec'>";
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row["title"];
                $body = $row['NoteBody'];
                $currDate = $row['currentDate'];
                $number = $row['numberOfNotes'];

                $output .= " <h2>$title</h2>
                             <h3>$currDate</h3>
                             <p>$body</p>";
            }
            $output .= "</div>
                  <div class='flex loadMore'>
                    <button class='ajaxbtn' data-id='{$number}'>Load more</button>
                  </div>";

            return $output;
        } else {
            return "Add some notes!";
        }
    }


    /* 
     * add note function to add note  
     */

    public function addNote($title, $NoteBody, $UserNum)
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
}

?>

