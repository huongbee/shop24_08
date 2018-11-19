<?php
include 'BaseController.php';
include_once 'model/ShoppingCartModel.php';
include_once 'helper/Cart.php';
if(!isset($_SESSION)) session_start();


class ShoppingCartController extends BaseController{

    function getShoppingCart(){
        return $this->loadView('shopping-cart');
    }

    function addToCart(){
        $id = $_POST['idSP'];
        $model = new ShoppingCartModel;
        $product = $model->findProduct($id);
        if(!$product){
            echo json_encode([
                'code'=>0,
                'message'=>'Không tìm thấy sản phẩm!'
            ]);
        }
        $qty = isset($_POST['qty']) ? (int) $_POST['qty'] : 1 ;
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$qty);
        $_SESSION['cart'] = $cart;
        
        // print_r($_SESSION['cart']);

        echo json_encode([
            'code'=>1,
            'message'=>'Sản phẩm '.$product->name.' đã được thêm vào giỏ hàng',
            'data'=> $cart->totalQty. 'SP: '.number_format($cart->promtPrice)
        ]);

    }
}


?>