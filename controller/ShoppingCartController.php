<?php
include 'BaseController.php';

class ShoppingCartController extends BaseController{

    function getShoppingCart(){
        return $this->loadView('shopping-cart');
    }

    function addToCart(){
        $id = $_POST['idSP'];
        

    }
}


?>