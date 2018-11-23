<?php

include_once 'DBConnect.php';

class CheckoutModel extends DBConnect{

    function insertCustomer($fullname, $email, $address, $phone, $gender){
        $sql = "INSERT INTO customers(name,gender,address,phone,email) 
                VALUES ('$fullname','$gender','$address','$phone','$email')";
        return $this->executeQuery($sql);
    }   

    function insertBill($idCustomer,$dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate){
        $sql = "INSERT INTO bills(id_customer, date_order, total, promt_price,payment_method,note,token,token_date)
                VALUES($idCustomer, '$dateOrder', $total, $promtPrice,'$paymentMethod', '$note', '$token', '$tokenDate')";
        return $this->executeQuery($sql);
    }

    function insertBillDetail($idBill,$idProduct,$quantity,$price, $discountPrice){
        $sql = "INSERT INTO bill_detail(id_bill,id_product,quantity,price,discount_price)
                VALUES ($idBill,$idProduct,$quantity,$price,$discountPrice)";
        return $this->executeQuery($sql);
    }
}


?>