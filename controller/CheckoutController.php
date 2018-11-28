<?php
include 'BaseController.php';
include_once 'model/CheckoutModel.php';
include_once 'helper/Cart.php';
include_once 'helper/functions.php';
include_once 'helper/PHPMailer/mail.php';
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
            $token = strRandom();
            $tokenDate = $dateOrder;
            $idBill = $model->insertBill($idCustomer,$dateOrder, $total, $promtPrice, $paymentMethod, $note, $token, $tokenDate);
            if($idBill){
                // insert bill detail
                foreach($cart->items as $idProduct=>$item){
                    $quantity = $item['qty'];
                    $price = $item['price'];
                    $discountPrice = $item['discountPrice'];
                    $check = $model->insertBillDetail($idBill,$idProduct,$quantity,$price, $discountPrice);
                    if($check==false){
                        $model->delBillDetail($idBill);
                        $model->delBill($idBill);
                        $model->delCustomer($idCustomer);
                    }
                }
                $_SESSION['success'] = 'Đặt hàng thành công, thông tin đơn hàng được gửi về email, vui lòng kiểm tra email để xác nhận DH';

                unset($_SESSION['cart']);
                
                //send mail
                $link = "http://localhost/shop2408/order/$token";
                $subject = "Đặt hàng thành công - Xác nhận đơn hàng DH000$idBill";
                $message = "<p>Đặt hàng thành công</p>
                <p>Tổng tiền đơn hàng là: ".number_format($promtPrice)."vnd</p>
                <p>Vui lòng nhấp vào <a href='$link'>đây</a> để xác nhận đơn hàng</p>
                <p>Thanks and Best Regard!</p>";
                sendMail($email,$fullname,$subject,$message);
            }
            else{
                $model->delCustomer($idCustomer);
                $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
            }
        }
        else{
            $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại';
        }
        header('Location:dat-hang');

    }
}


?>