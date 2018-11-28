<?php
require 'src/PHPMailer.php';
/**
 * Send a message to $email
 * @param string @email
 * @param string @name
 * @param string @subject
 * @param string @content
 */
function sendMail($email, $name, $subject, $content){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->CharSet = "UTF-8";  
        $mail->SMTPDebug = 0;                        
        $mail->isSMTP();   
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;    
        $mail->Username = 'huonghuong08.php@gmail.com'; 
        $mail->Password = 'qweasd@@';                         
        $mail->SMTPSecure = 'tls';   
        $mail->Port = 587;    //ssl:465

        //Recipients
        $mail->setFrom('huonghuong08.php@gmail.com', 'SHOP24082018');
        $mail->addReplyTo('huonghuong08.php@gmail.com', 'SHOP24082018');
        $mail->addAddress($email, $name);

        //Content
        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $content;
       
        return $mail->send();
    } 
    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}

?>