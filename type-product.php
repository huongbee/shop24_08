<?php
include 'controller/TypeProductController.php';

$c = new TypeProductController;
if(isset($_POST['idType'])){
    return $c->getProductMenuLeft();
}
return $c->getTypePage();

?>