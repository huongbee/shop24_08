<?php

if($_SERVER['REQUEST_METHOD'] == "GET"){
    header('Location:404.html');
    return;
}

include_once 'controller/ShoppingCartController.php';
$c = new ShoppingCartController;
if(isset($_POST['action']) && $_POST['action'] =='update')
    return $c->updateCart();
if(isset($_POST['action']) && $_POST['action'] =='delete')
    return $c->deleteCart();
return $c->addToCart();



?>