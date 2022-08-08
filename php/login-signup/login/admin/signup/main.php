<?php
session_start();
if ( isset( $_POST['signup-admin'] ) ) {
    include( 'function.php' );
    if(isset($_SESSION['otp'])){
        if($_SESSION['otp'] != $_POST['otp']){
            echo "<script>window.location.href='../main.php?error=Opps invalid OTP, please enter valid otp.';</script>";

            // header("location:../main.php?error=Opps invalid OTP, please enter valid otp.");
        }
    }
    $status = data_validate( $_POST );
    if ( $status === true ) {
        $status = data_sanitize( $_POST );
        if ( is_array( $status ) ) {
            include( 'database.php' );
            $status = signup( $status );
            if ( $status === true ) {
                show_success( 'signup_successfull' );
            } else {
                show_error( $status );
            }
        } else {
            show_error( $status );
        }
    } else {
        show_error( $status );
    }
}else{
    header("location:../main.php?error=Error : Opps This page not able to open!");
}
?>