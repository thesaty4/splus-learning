<?php
    include("../../../include/database_connection.php");
    function signup($arg){
        include("../../mailer.php");
        $conn         = db_conn();
        $sql          = "INSERT INTO `user` (`fname`,`lname`,`country_code`,`mobile`,`email`,`password`) VALUES (?,?,?,?,?,?);";
        $stmt         = mysqli_prepare($conn,$sql);
        if(!$stmt){
            return 'stmt_error';
            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_bind_param($stmt,'ssssss',$arg['fname'],$arg['lname'],$arg['country_code'],$arg['mobile'],$arg['email'],$arg['password']);
        $stmt_status =  mysqli_stmt_execute($stmt);
        if(!$stmt_status){
            mysqli_stmt_close($stmt);
            return 'stmt_not_execute';
        }
        mysqli_stmt_close($stmt);
        return true;

    }
?>