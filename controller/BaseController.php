<?php
include_once 'helper/Cart.php';
session_start();
include_once 'model/TypeProductModel.php';

class BaseController{

    private $domain = null;
    private $url = null;
    function __construct(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        
        $this->domain = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; //http://localhost

        $this->url = $this->domain.$_SERVER['REQUEST_URI'];
    }
    

    function loadView(string $view='index', string $title='Home', array $data = []){
        $domain = $this->domain;
        $url = $this->url;
        $model = new TypeProductModel;
        $categories = $model->selectCategories();
        // print_r($categories);die;
        include_once "view/layout.view.php";
    }

    function loadHtmlAjax($view, $data = []){
        include_once "view/ajax/$view.view.php";
    }
}

?>