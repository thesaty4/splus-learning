<?php
session_start();
if(isset($_SESSION['login'])){
    $_SESSION['login'] = [];
    if(ini_get('session.use_cookies')){
        // $parameters = session_get_cookie_params();
        setcookie(session_name(),time()-15, "/");
    }
    session_destroy();
    echo "<script>window.location.href='../index.php?success=You Have succesfully LogOut!';</script>";
    
    // header("location:../index.php?success=You Have succesfully LogOut!");
}else{
    echo "<script>window.location.href='../index.php?warning=Something wrong during logout!';</script>";
    // header("location:../index.php?warning=Something wrong during logout!");
}
?>