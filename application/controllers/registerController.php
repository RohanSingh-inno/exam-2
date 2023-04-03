<?php 
class registerController extends framework{
    function register()
    {
        $this->view("register");
    }


    public function check()
    {
        $this->model("registerModel");
        if ($_POST["register"]) {

            $registers = new registerModel;
        
            $registers->register($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["number"], $_POST["password"]);

            $GLOBALS['ferr'] = $registers->fnameErr;
            $GLOBALS['lerr'] = $registers->LnameErr;
            $GLOBALS['mailerr'] = $registers->EmailErr;
            $GLOBALS['numerr'] = $registers->NumErr;
            $GLOBALS['passerr'] = $registers->passErr;
            $GLOBALS['regiserr'] = $registers->RefisErr;
            $GLOBALS['checkSubmit'] = $registers->checkSubmit;


            $this->view("register");


        }



    }
    
}
?>