<?php
include_once 'model/TypeProductModel.php';

class BaseController{


    function loadView(string $view='index', string $title='Home', array $data = []){
        $model = new TypeProductModel;
        $categories = $model->selectCategories();
        // print_r($categories);die;
        include_once "view/layout.view.php";
    }
}

?>