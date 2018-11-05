<?php
include 'BaseController.php';
include_once 'model/TypeProductModel.php';

class TypeProductController extends BaseController{
    function getTypePage(){

        $urlType =  $_GET['url'];
        $model = new TypeProductModel;
        // c1
        // $type = $model->selectCategoriesByUrl($urlType);
        //c2
        $type = $model->selectCategories($urlType);
        if(!$type){
            header('Location:404.html');
            return;
        }
        // get product by type
        if(isset($_GET['page']) && $_GET['page']!=0){
            $page = (int) $_GET['page'];
        }
        else{
            $page = 1;
        }
        /**
         * page = 1 => 0,12
         * page = 2 => 12,12 
         * page = 3 => 24,12
         */
        $itemPerPage = 12;
        $position = ($page-1)*$itemPerPage;

        $products = $model->selectProductById($type->id,$position,$itemPerPage);
        $data = [
            'type'=>$type,
            'products'=>$products
        ];
        return $this->loadView('type-product',$type->name,$data);
    }
}



?>