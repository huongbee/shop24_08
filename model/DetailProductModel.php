<?php
include_once 'DBConnect.php';

class DetailProductModel extends DBConnect{

    function selectProductById($id,$url){
        // $data = [$id,$url];
        // $sql = "SELECT p.* 
        //         FROM products p
        //         INNER JOIN page_url u
        //         ON p.id_url = u.id
        //         WHERE p.id=?
        //         AND url=?";
        // return $this->loadOneRow($sql,$data);
        
        $sql = "SELECT p.* 
                FROM products p
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE p.id = $id
                AND url = '$url'";
        return $this->loadOneRow($sql);
    }
}



?>