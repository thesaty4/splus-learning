<?php
    include("../../../../../include/database_connection.php");
    function signup($arg){
        echo "<pre>";
        print_r($arg);
        echo "</pre>";
        include("../../mailer.php");
        $conn         = db_conn();
        $admin        = 'admin';
        $sql          = "INSERT INTO `user` (`fname`,`lname`,`country_code`,`mobile`,`email`,`password`,`account_type`) VALUES (?,?,?,?,?,?,?);";
        $stmt         = mysqli_prepare($conn,$sql);
        if(!$stmt){
            return 'stmt_error';
            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_bind_param($stmt,'sssssss',$arg['fname'],$arg['lname'],$arg['country_code'],$arg['mobile'],$arg['email'],$arg['password'],$admin);
        $stmt_status =  mysqli_stmt_execute($stmt);
        if(!$stmt_status){
            mysqli_stmt_close($stmt);
            return 'stmt_not_execute';
        }
        mysqli_stmt_close($stmt);
        return true;

    }
?>