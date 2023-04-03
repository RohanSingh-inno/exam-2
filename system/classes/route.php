<?php

class route
{
    public $controller = "loginController";
    public $method = "login";
    public $param = [];

    public function __construct()
    {
        $url = $this->url();
        //echo $_SERVER["REQUEST_URI"];
        if (!empty($url)) {
            if (file_exists("../application/controllers/" . $url[0] . ".php")) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }


        // Include controller
        require_once "../application/controllers/" . $this->controller . ".php";
        // Instantiate controller
        $this->controller = new $this->controller;


        if(isset($url[1]) && !empty($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);

            } 
        }

        if(isset($url)){
            $this->param = $url;
        } else {
            $this->param = [];
        }

        call_user_func_array([$this->controller, $this->method], $this->param);

    }


    public function url()
    {
        if (isset($_SERVER["REQUEST_URI"])) {
            $url = $_SERVER["REQUEST_URI"];
            $url = trim($url, "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }

    }
}
?>