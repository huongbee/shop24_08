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
                WHERE p.status=1
                AND p.deleted=0";
        return $this->loadMoreRow($sql);
    }

    function selectBestSeller(){
        $sql = "SELECT p.*, u.url as url, sum(quantity) as total
                FROM `bill_detail` d
                INNER JOIN products p
                ON d.id_product = p.id
                INNER JOIN page_url u
                ON p.id_url = u.id
                AND p.deleted=0
                GROUP BY id_product
                ORDER BY total DESC
                LIMIT 0,10";
        return $this->loadMoreRow($sql);
    }
    
}


?>