<?php
session_start();
    if(isset($_POST['mail-send'])){
        $name    = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $subject    = filter_var($_POST['subject'],FILTER_SANITIZE_STRING);
        $message    = filter_var($_POST['message'],FILTER_SANITIZE_STRING);
        $to = 'satyamishra559@gmail.com';
        $subject = $name." : ".$subject;
        $messages = $message;
        $headers  = 'From: splus-learning.com';
        if(mail($to,$subject,$messages,$headers)){
           header("location:../index.php?success=Message sent successfull!");
        }else{
            header("location:../index.php?error=Sorry: Email sending fail..!");
        }
    }

    if(isset($_GET['otp'])){
        $otp  = mt_rand(1111,9999);
        $_SESSION['otp'] = $otp;
        $name = $arg['fname']." ".$arg['lname'];
        $subject = 'Splus Learning : Signup verification OTP !';
        $to      = $arg['email'];
        $messages = "Hey Mr ".$arg['fname']." Welcome to Splus learning otp verification ! Please don't share your OPT any where, Be carefull. Your Verification OTP Code is ".$otp." - Thanks for visiting - <br> -Splus Learning";
        $headers  = 'From: splus-learning.com';
        if(mail($to,$subject,$messages,$headers)){
           header("location:./login-signup/login-signup.php?success=OTP send successfulll. kindly check your email");
        }else{
            header("location:./login-signup/login-signup.php?error=Opps OTP sending fail try again.!");
        }
    }
?>