<?php
include 'BaseController.php';

class TypeProductController extends BaseController{
    function getTypePage(){

        $urlType =  $_GET['url'];
        return $this->loadView('type-product');
    }
}



?>