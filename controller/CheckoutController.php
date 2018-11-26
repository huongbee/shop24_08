<?php
include 'BaseController.php';
include_once 'model/CheckoutModel.php';
include_once 'helper/Cart.php';
!isset($_SESSION) ? session_start() : '';

class CheckoutController extends BaseController{

    function getCheckoutPage(){
        return $this->loadView('checkout');
    }

    function postCheckout(){
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $note = $_POST['note'];
        $paymentMethod = $_POST['payment_method'];

        $model = new CheckoutModel;
        $idCustomer = $model->insertCustomer($fullname, $email, $address, $phone, $gender);
        if($idCustomer){
            //insert bill
            $dateOrder = date('Y-m-d H:i:s',time());
            $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
            $cart = new Cart($oldCart);
            $total = $cart->totalPrice;
            $promtPrice = $cart->promtPrice;
            $tokenDate = $dateOrder;
            $token = strRandom();
            $idBill = insertBill($idCustomer,$dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate);

        }
        else{
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
        }
        header('Location:dat-hang');

    }
}


?>