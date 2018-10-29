<?php
include 'BaseController.php';
include 'model/DetailProductModel.php';

class DetailProductController extends BaseController{

    function getDetailPage(){

        $url = $_GET['url'];
        $id = $_GET['id'];

        $model = new DetailProductModel;
        $p = $model->selectProductById($id,$url);
        // var_dump($p);
        // die;

        return $this->loadView('detail-product');
    }
}


?>