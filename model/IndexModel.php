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

    function selectBestSeller(){
        $sql = "SELECT id_product, sum(quantity) as total
                FROM `bill_detail`  
                GROUP BY id_product
                ORDER BY total DESC
                LIMIT 0,10";
    }
    
}


?>