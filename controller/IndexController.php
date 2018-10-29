<?php
include_once 'BaseController.php';
include_once 'model/IndexModel.php';

class IndexController extends BaseController{
    
    function getHomePage(){
        $model = new IndexModel();
        $slide = $model->selectSlide();
        $specialProduct = $model->selectSpecialProduct();
        $bestSellerProduct = $model->selectBestSeller();
        // try{
        //     $specialProduct = $model->selectSpecialProduct();
        // }
        // catch(Exception $e){
        //     echo $e->getMessage();
        //     die;
        // }
        $data = [
            'slide' => $slide,
            'specialProduct'=>$specialProduct,
            'bestSellerProduct'=>$bestSellerProduct
        ];
        return $this->loadView('index','Trang chủ',$data);
    }
}

?>