<?php
class dashboardController extends framework
{
    /* 
     * function to load dashboard
     */
    public function show()
    {
        session_start();
        if ($_SESSION['LoggedIN'] == true) {
            $_SESSION['Fname'];
            $this->model('dashboardModel');
            $getPic = new dashboardModel;

            $this->view("Dashboard");
        } else {
            header("location: /loginController/login");
        }
    }
    /* 
     * loadMore 
     */
    public function loadMore()
    {
        $this->model('dashboardModel');
        $getPic = new dashboardModel;
        echo $getPic->getDetails();
    }

    /* 
     * function to show add note
     */
    public function showAddNote()
    {
        session_start();
        if ($_SESSION['LoggedIN'] == true) {
            $this->view("addNote");
        } else {
            header("location: /loginController/login");
        }

    }

    /* 
     * function to show user profile
     */
    public function showUserProfile()
    {
        session_start();
        $this->model("dashboardModel");
        $data = new dashboardModel;
        if (isset($_SESSION['LoggedIN'])) {
            $this->view("userProfile");
        } else {
            header("location: /loginController/login");
        }
    }

    /* 
     * functio for signout
     */
    public function signOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location: /loginController/login");

    }
    public function addNote()
    {
        if (isset($_POST['save'])) {
            session_start();
            $this->model("dashboardModel");
            $addFiles = new dashboardModel;

            $addFiles->addNote($_POST['titleSec'], $_POST['noteSec'], $_SESSION['UserNumber']);

            $GLOBALS['uploadErr'] = $addFiles->uploadErr;
            $GLOBALS['checkUploadStatus'] = @$addFiles->checkUpload;

            $this->view("addNote");
        }
    }


}
?>