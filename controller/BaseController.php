<?php

class BaseController{

    function loadView(string $view='index', string $title='Home', array $data = []){
        include_once "view/layout.view.php";
    }
}

?>