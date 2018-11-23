<?php
include 'BaseController.php';

class CheckoutController extends BaseController{

    function getCheckoutPage(){
        return $this->loadView('checkout');
    }

    function postCheckout(){
        
    }
}


?>