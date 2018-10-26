<?php
include_once 'BaseController.php';
include_once 'model/IndexModel.php';

class IndexController extends BaseController{
    
    function getHomePage(){
        $model = new IndexModel();
        $slide = $model->selectSlide();
        $specialProduct = $model->selectSpecialProduct();
        // try{
        //     $specialProduct = $model->selectSpecialProduct();
        // }
        // catch(Exception $e){
        //     echo $e->getMessage();
        //     die;
        // }
        $data = [
            'slide' => $slide,
            'specialProduct'=>$specialProduct
        ];
        return $this->loadView('index',$data);
    }
}

?>