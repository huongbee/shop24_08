<?php
include 'controller/ShoppingCartController.php';

$c = new ShoppingCartController;
return $c->getShoppingCart();

?>