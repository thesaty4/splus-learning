<?php
function validate_data($arg){
    foreach ($arg as $key => $value) {
        if($value == ''){
            return 'field_required';
        }
    }
    return true;
}
function sanitize_data($arg){
    $email = filter_var($arg['email'],FILTER_SANITIZE_STRING);
    $password = filter_var($arg['password'],FILTER_SANITIZE_STRING);
    $validate_email = filter_var($email,FILTER_VALIDATE_EMAIL);
    if(!$validate_email){
        return 'invalid_email';
    }
    return [
        'email' => $email,
        'password' => $password
    ];
}

function show_error($arg){
    $error = [
        'invalid_user'   => 'Warning : invalid email or password!',
        'stmt_error'     => 'Opps Something wrong from database try again!',
        'somthing_wrong' => 'Somthing wrong please try again!',
        'field_required' => 'All field required!',
        'invalid_email'  => 'Invalid email, please enter valid email!',
        'account_deactive'  => 'Opps! This account Deactivated'
    ];
    echo "<script>window.location.href='../../login-signup.php?warning=".$error[$arg]."';</script>";

    // header("location:../../login-signup.php?warning=".$error[$arg]);
}

function show_success($arg){
    $success = [
        
    ];
    echo "<script>window.location.href='../../login-signup.php?warning=".$success[$arg]."';</script>";

    // header("location:../../login-signup.php?warning=".$success[$arg]);
}



// final log in page
function log_page($arg){
    if($arg['account_type'] === 'admin'){
        header("location:../admin/main.php");
    }
    if($arg['account_type'] === 'user'){
        header("location:../user/main.php");
    }
}
?>