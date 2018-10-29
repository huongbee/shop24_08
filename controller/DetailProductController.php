<?php
include 'BaseController.php';

class DetailProductController extends BaseController{

    function getDetailPage(){

        $url = $_GET['url'];
        $id = $_GET['id'];

        return $this->loadView('detail-product');
    }
}


?>