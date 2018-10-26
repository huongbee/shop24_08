<?php
include_once 'DBConnect.php';

class IndexModel extends DBConnect{

    function selectSlide(){
        $sql = "SELECT * FROM slide WHERE status=1";
        return $this->loadMoreRow($sql);
    }

    function selectSpecialProduct(){
        $sql = "SELECT p.*, u.url as url 
                FROM products p 
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE p.status=1";
        return $this->loadMoreRow($sql);
    }
    
}


?>