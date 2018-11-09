<?php
include 'BaseController.php';
include_once 'model/TypeProductModel.php';
include_once 'helper/Pager.php';

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
        $countProduct = $model->selectProductById($type->id);
        $totalProduct = count($countProduct); 
        $pager = new Pager($totalProduct,$page,$itemPerPage,3);
        $pagination = $pager->showPagination();

        $allType = $model->countProductByType();
        // print_r($allType);die;
        $data = [
            'type'=>$type,
            'products'=>$products,
            'pagination'=>$pagination,
            'allType'=>$allType
        ];
        return $this->loadView('type-product',$type->name,$data);
    }

    function getProductMenuLeft(){
        $idType = $_POST['idType'];
        
    }

    /*
    SELECT p.*, u.url
    FROM products p 
    INNER JOIN page_url u
    ON p.id_url = u.id
    WHERE id_type = 6 LIMIT 12,12

    SELECT p.*, u.url
    FROM products p 
    INNER JOIN page_url u
    ON p.id_url = u.id
    WHERE id_type = 6

    */
}



?>