<?php

include_once 'DBConnect.php';

class CheckoutModel extends DBConnect{

    function insertCustomer($fullname, $email, $address, $phone, $gender){
        $sql = "INSERT INTO customers(name,gender,address,phone,email) 
                VALUES ('$fullname','$gender','$address','$phone','$email')";
        $check = $this->executeQuery($sql);
        if($check){
            return $this->getLastId();
        }
        return false;
    }   

    function insertBill($idCustomer,$dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate){
        $sql = "INSERT INTO bills(id_customer, date_order, total, promt_price,payment_method,note,token,token_date)
                VALUES($idCustomer, '$dateOrder', $total, $promtPrice,'$paymentMethod', '$note', '$token', '$tokenDate')";
        $check = $this->executeQuery($sql);
        if($check){
            return $this->getLastId();
        }
        return false;
    }

    function insertBillDetail($idBill,$idProduct,$quantity,$price, $discountPrice){
        $sql = "INSERT INTO bill_detail(id_bill,id_product,quantity,price,discount_price)
                VALUES ($idBill,$idProduct,$quantity,$price,$discountPrice)";
        return $this->executeQuery($sql);
    }

    function delCustomer($id){
        $sql = "DELETE FROM customers WHERE id=$id";
        return $this->executeQuery($sql);
    }

    function delBill($id){
        $sql = "DELETE FROM bills WHERE id=$id";
        return $this->executeQuery($sql);
    }
    function delBillDetail($idBill){
        $sql = "DELETE FROM bill_detail WHERE id_bill=$idBill";
        return $this->executeQuery($sql);
    }

    function findBillByToken($token){
        $sql = "SELECT * FROM bills WHERE token='$token' AND status=0";
        return $this->loadOneRow($sql);
    }
    function updateStatusBill($idBill){
        $sql = "UPDATE bills 
                SET status=1,
                token = null,
                token_date = null 
                WHERE id=$idBill";
        return $this->executeQuery($sql);
    }
}


?>