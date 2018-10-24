<?php
include 'BaseController.php';

class TypeProductController extends BaseController{
    function getTypePage(){
        return $this->loadView('type-product');
    }
}



?>