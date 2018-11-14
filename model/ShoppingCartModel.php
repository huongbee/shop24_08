<?php
include_once 'DBConnect.php';

class ShoppingCartModel extends DBConnect{

    function findProduct($id){
        $sql = "SELECT id,name,image,price,promotion_price 
                FROM products 
                WHERE id=$id
                AND deleted='0'"; // sp chua xoa
        return $this->loadOneRow($sql);
    }
}

?>