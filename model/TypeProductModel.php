<?php
include_once 'DBConnect.php';

class TypeProductModel extends DBConnect{

    function selectCategories(){
        $sql = "SELECT c.*, u.url as url 
                FROM categories c
                INNER JOIN page_url u
                ON c.id_url = u.id";
        return $this->loadMoreRow($sql);
    }
}


?>