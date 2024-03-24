<?php
$act = 'forget';
if (isset($_GET['act'])) {
    $act = $_GET['act'];
}
switch ($act) {
    case 'forget':
        include_once "./View/forgetpassword.php";
        break;

    case 'forget_action':
        if (isset($_POST['submit_email'])) {
            $email = $_POST['email']; //lequocanh40029081@gmail.com
            // tạo mảng lưu thông tin email và passnew
            $_SESSION['email'] = array();
            // kiểm tra xem email có tồn tại trong database không
            $kh = new user();
            $checkuser = $kh->checkEmail($email)->rowCount();
            if ($checkuser > 0) {
                // cấp mã code ngẫu nhiên, hay pass mới
                $code = random_int(1000, 1000000); //34567
                // tạo đối tượng
                $item = array(
                    'id' => $code,
                    'email' => $email,
                );
                // add vào session
                $_SESSION['email'][] = $item; //$_SESSION['email]=array(id:187796,email:lequocanh40029081@gmail.com)
                // tiến hành gửi mail
                $mail = new PHPMailer();
                $mail->CharSet = "utf-8";
                $mail->IsSMTP();
                // enable SMTP authentication
                $mail->SMTPAuth = true;
                // GMAIL username to:
                // $mail->Username = "php22023@gmail.com";//
                $mail->Username = "tangquang4@gmail.com"; //
                // GMAIL password
                // $mail->Password = "php22023ngoc";
                $mail->Password = "yeix wmec gfxy hgcl"; //Phplytest20@php
                $mail->SMTPSecure = "tls";  // ssl
                // sets GMAIL as the SMTP server
                $mail->Host = "smtp.gmail.com";
                // set the SMTP port for the GMAIL server
                $mail->Port = "587"; // 465
                $mail->From = 'tangquang4@gmail.com';
                $mail->FromName = 'Quang';
                // $getemail là địa chỉ mail mà người nhập vào địa chỉ của họ đã đăng ký trong trang web
                $mail->AddAddress($email, 'reciever_name');
                $mail->Subject = 'Reset Password';
                $mail->IsHTML(true);
                $mail->Body = 'Cấp lại mã code ' . $code . '';
                if ($mail->Send()) {
                    echo '<script> alert("Check Your Email and Click on the 
                        link sent to your email");</script>';
                    include "./View/resetpw.php";
                } else {
                    echo "Mail Error - >" . $mail->ErrorInfo;
                    include "./View/forgetpassword.php";
                }
                // include "./View/resetpw.php";
            } else {
                echo '<script> alert("Địa chỉ mail ko tồn tại");</script>';
                include "./View/forgetpassword.php";
            }
        }
        break;
    case 'resetpass':
        //nhận pass new mà người dùng nhập vào
        if (isset($_POST['submit_password'])) {
            $pass = $_POST['password'];
            //dò lại trong session, đối tượng nào có pass giống với pass đó
            foreach ($_SESSION['email'] as $ket => $item) {
                if ($item['id'] == $pass) {
                    //echo $item['id'];
                    $salfF = "G435#";
                    $salfL = "T34a!&";
                    $passnew = md5($salfF . $pass . $salfL);
                    $emailold = $item['email'];
                    $kh = new user();
                    $kh->updateEmail($emailold, $passnew);
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=./index.php?action=dangnhap"/>';
        break;
}

?>