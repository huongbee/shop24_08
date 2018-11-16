<?php

if($_SERVER['REQUEST_METHOD'] == "GET"){
    header('Location:404.html');
    return;
}

include_once 'controller/ShoppingCartController.php';
$c = new ShoppingCartController;
return $c->addToCart();



?>