<?php

class BaseController{

    function loadView(string $view='index', array $data = []){
        include_once "view/layout.view.php";
    }
}


?>