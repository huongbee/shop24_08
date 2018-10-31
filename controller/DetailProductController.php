<?php
include 'BaseController.php';
include 'model/DetailProductModel.php';

class DetailProductController extends BaseController{

    function getDetailPage(){

        $url = $_GET['url'];
        $id = $_GET['id'];

        $model = new DetailProductModel;
        $product = $model->selectProductById($id,$url);
        if(!$product){
            //return $this->loadView('404','404 Not Found!');
            header('Location:404.html');
            return;
        }
        $title = $product->name;
        // print_r($product);die;
        $data = [
            'product'=>$product
        ];
        return $this->loadView('detail-product',$title,$data);
    }
}


?>