<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// import the modules
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require "PHPMailer/PHPMailerAutoload.php";

// submit the form
function sendOtp($email, $otp){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;
    $mail->Username = 'ngugikaguathi453@gmail.com'; //your email address
    $mail->Password = 'sqkfmzwliqpjwevx'; // your password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('ngugikaguathi453@gmail.com'); // your email address
    $mail->addAddress($email);
    $mail->isHTML(true);

    $mail->Subject = "OTP for Verification";
    $mail->Body = "Verification OTP number<br><br>". $otp;

    $result = $mail->send();
    return $result;
}
?>