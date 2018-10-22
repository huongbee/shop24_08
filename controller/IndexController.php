<?php
include_once 'BaseController.php';

class IndexController extends BaseController{
    
    function getHomePage(){
        return $this->loadView('index');
    }
}

?>