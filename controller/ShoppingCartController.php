<?php
include 'BaseController.php';
include_once 'model/ShoppingCartModel.php';
include_once 'helper/Cart.php';
session_start();


class ShoppingCartController extends BaseController{

    function getShoppingCart(){
        return $this->loadView('shopping-cart');
    }

    function addToCart(){
        $id = $_POST['idSP'];
        $model = new ShoppingCartModel;
        $product = $model->findProduct($id);
        if(!$product){
            return [
                'code'=>0,
                'message'=>'Product not found!'
            ];
        }
        $qty = 1;
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$qty);
        $_SESSION['cart'] = $cart;
        print_r($_SESSION['cart']);

        return [
            'code'=>1,
            'message'=>'Add to cart success!'
        ];

    }
}


?>