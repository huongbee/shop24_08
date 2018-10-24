<?php
include 'BaseController.php';

class DetailProductController extends BaseController{

    function getDetailPage(){
        return $this->loadView('detail-product');
    }
}


?>