<?php
session_start();
include("../../../../include/database_connection.php");
function login($arg){
    if(isset($_SESSION['login'])){
        $_SESSION['login'] = [];
        if(ini_get('session.use_cookies')){
            // $parameters = session_get_cookie_params();
            setcookie(session_name(),time()-15, "/");
        }
        session_destroy();
    }
    $email = $arg['email'];
    $password = $arg['password'];
    $conn = db_conn();
    $sql = 'SELECT * FROM `user` WHERE `email` = ?';
    $stmt = mysqli_prepare($conn,$sql);
    if(!$stmt){
        return 'stmt_error';
    }
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_bind_result($stmt,$db_id, $db_fname,$db_lname, $db_country_code, $db_mobile, $db_email, $db_password, $account_type, $status, $c_time, $c_date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    if($status == 'deactive'){
        return 'account_deactive';
    }else if(password_verify($password,$db_password)){
        mysqli_stmt_close($stmt);
        return [
            'id' => $db_id,
            'fname' => $db_fname,
            'country_code'      => $db_country_code,
            'mobile'            => $db_mobile,
            'email'             => $db_email,
            'account_type'      => $account_type,
            'status'            => $status,
            'c_time'            => $c_time,
            'c_date'            => $c_date
        ];
    }else{
        return 'invalid_user';
        mysqli_stmt_close($stmt);
    }
    return [];
    mysqli_stmt_close($stmt);
}
?>