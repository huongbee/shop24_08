<?php
include 'BaseController.php';
include_once 'model/CheckoutModel.php';
include_once 'helper/Cart.php';
include_once 'helper/functions.php';
include_once 'helper/PHPMailer/mail.php';
!isset($_SESSION) ? session_start() : '';

class CheckoutController extends BaseController{

    function getCheckoutPage(){
        $oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
        if($oldCart==null)
        header('Location:http://localhost/shop2408/trang-chu');
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
                
                unset($_SESSION['cart']);
                
                //send mail
                $link = "http://localhost/shop2408/order/$token";
                $linkCancel = "http://localhost/shop2408/order-cancel/$token";

                $subject = "Đặt hàng thành công - Xác nhận đơn hàng DH000$idBill";
                $message = "<p>Đặt hàng thành công</p>
                <p>Tổng tiền đơn hàng là: ".number_format($promtPrice)."vnd</p>
                <p>Vui lòng nhấp vào <a href='$link'>đây</a> để xác nhận đơn hàng</p>
                <p>Để huỷ đơn hàng, bạn chọn vào <a href='$linkCancel'>đây</a> để huỷ</p>
                <p>Thanks and Best Regard!</p>";
                sendMail($email,$fullname,$subject,$message);
                
                $_SESSION['success'] = 'Đặt hàng thành công, thông tin đơn hàng được gửi về email, vui lòng kiểm tra email để xác nhận DH';
                header('Location:http://localhost/shop2408/trang-chu');
                return;
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

    function confirmOrder(){
        $token = trim($_GET['token']); 
        if($token==''){
            $_SESSION['error'] = 'Liên kết bạn nhập vào không hợp lệ, vui lòng thử lại';
            header('Location:http://localhost/shop2408/404.html');
            return;
        }
        $model = new CheckoutModel();
        $bill = $model->findBillByToken($token);
        if(!$bill){
            $_SESSION['error'] = 'Liên kết bạn nhập vào không hợp lệ, vui lòng thử lại';
            header('Location:http://localhost/shop2408/404.html');
            return;
        }
        $tokenDate = strtotime($bill->token_date);
        $now = strtotime(date('Y-m-d H:i:s',time()));
        if(strtotime('+1 day',$tokenDate) >= $now){
            $c = $model->updateStatusBill($bill->id);
            if(!$c){
                $_SESSION['error'] = 'Liên kết bạn nhập vào không hợp lệ, vui lòng thử lại';
                header('Location:http://localhost/shop2408/404.html');
                return;
            }
            $_SESSION['success'] = "ĐH đã xác nhận thành công, Chúng tôi sẽ sớm liên hệ";
            header('Location:http://localhost/shop2408/trang-chu');
            return;
        }
        else{
            $_SESSION['error'] = 'DH không còn hiệu lực, vui lòng đặt DH mới';
            header('Location:http://localhost/shop2408/trang-chu');
            return;
        }
    }
}


?>