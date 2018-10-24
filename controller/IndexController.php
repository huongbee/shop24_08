<?php
include_once 'BaseController.php';

class IndexController extends BaseController{
    
    function getHomePage(){
        $data = [];
        return $this->loadView('index',$data);
    }
}

?>