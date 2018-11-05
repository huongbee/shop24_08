<?php
include_once 'DBConnect.php';

class TypeProductModel extends DBConnect{

    function selectCategories($url = null){
        $sql = "SELECT c.*, u.url as url 
                FROM categories c
                INNER JOIN page_url u
                ON c.id_url = u.id";
        if($url != null){
            $sql .= " WHERE url='$url'";
            return $this->loadOneRow($sql);
        }
        return $this->loadMoreRow($sql);
    }

    function selectCategoriesByUrl($url){
        $sql = "SELECT c.*
                FROM categories c
                INNER JOIN page_url u
                ON c.id_url = u.id
                WHERE url='$url'";
        return $this->loadOneRow($sql);
    }

    function selectProductById($idType,$position=0,$qty=12){
        $sql = "SELECT p.*, u.url
                FROM products p 
                INNER JOIN page_url u
                ON p.id_url = u.id
                WHERE id_type = $idType
                LIMIT $position,$qty";
        return $this->loadMoreRow($sql);
    }
}


?>