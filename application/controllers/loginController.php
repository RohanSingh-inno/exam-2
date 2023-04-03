<?php
class loginController extends framework{
    function login()
    {
        $this->view("login");
    }

    // public function forgetPassword()
    // {
    //     $this->view("forgetPassword");
    // }

    public function loginCheck()
    {
        session_start();
        if (isset($_POST['login'])) {
            $this->model("loginModel");
            $loginValid = new loginModel;
            $loginValid->login($_POST['email'], $_POST['password']);
            $GLOBALS['number'] = $loginValid->num; 
            
            if ($loginValid->num == 1) {
                $_SESSION['UserNumber'] = $loginValid->info['numberOfUsers'];
                $_SESSION['Fname'] = $loginValid->info['fname'];
                $_SESSION['Lname'] = $loginValid->info['lname'];
                $_SESSION['email'] = $loginValid->info['email'];
                $_SESSION['PhoneNumber'] = $loginValid->info['phone'];
                $_SESSION['LoggedIN'] = true;

                $this->model('dashboardModel');
                // $getImgInfo = new dashboardModel;
                // $imgArr = $getImgInfo->getCoverPic();
                // $_SESSION["imgINFO"] = $imgArr;

                $this->view("Dashboard");
            } else {
                $this->view("login");
            }
        } else {
            header("location: /loginController/login");
        }
    }

    
}
?>