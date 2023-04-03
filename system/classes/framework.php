<?php 

class framework{
    public function view($fileName ){
        if(file_exists("../application/views/".$fileName.".php")){
            require_once ("../application/views/$fileName.php");
        }
        // else{
        //     echo '<script>alert("ERROR!!")</script>';
        // }
    }
    public function model($fileName){
        if(file_exists("../application/models/".$fileName.".php")){
            require_once ("../application/models/$fileName.php");
        }
        // else{
        //     echo '<script>alert("ERROR!!")</script>';
        // }
    }
}

?>