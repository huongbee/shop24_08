<?php

class DBConnect{
    private $db = null;
    private $sttm = null;

    function __construct($dbName='shop_2408', $user='root', $password=''){
        try{
            $this->db = new PDO("mysql:host=localhost;dbname=$dbName",$user, $password);
            $this->db->exec('set names utf8');
        }
        catch(\Exception $e){
            echo $e->getMessage();
            die;
        }
    }

    //for INSERT/UPDATE/DELETE
    function executeQuery($sql, $data = []){
        $sttm = $this->db->prepare($sql);
        return $sttm->execute($data);
    }
    function getLastId(){
        return $this->db->lastInsertId();
    }

    //for SELECT 1 row
    function loadOneRow($sql,$data=[]){
        $check = $this->setStatement($sql, $data);
        if($check){
            return $this->sttm->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    //for SELECT > 1 row
    function loadMoreRow($sql ,$data=[]){
        $check = $this->setStatement($sql, $data);
        if($check){
            return $this->sttm->fetchAll(PDO::FETCH_OBJ);
        }
        throw new Exception("Wrong query: $sql");
    }
    function setStatement($sql, $data = []){
        $this->sttm = $this->db->prepare($sql);
        for($i = 1; $i <= count($data); $i++){
            $this->sttm->bindValue($i,$data[$i-1]);
        }
        return $this->sttm->execute();
    }


}


?>