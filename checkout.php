<?php
include 'controller/CheckoutController.php';

$c = new CheckoutController;

return $_SERVER['REQUEST_METHOD'] == 'POST' ? $c->postCheckout() : $c->getCheckoutPage();

?>