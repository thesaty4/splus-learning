<?php

function data_validate( $arg ) {
    foreach ( $arg as $key => $value ) {
        if ( $value == '' or $value == null ) {
            return 'empty';
        }
    }
    return true;
}

function data_sanitize( $arg ) {
    $fname = filter_var( $arg['fname'], FILTER_SANITIZE_STRING );
    $lname = filter_var( $arg['lname'], FILTER_SANITIZE_STRING );
    $email = filter_var( $arg['email'], FILTER_SANITIZE_EMAIL );
    $country_code = filter_var( $arg['country_code'], FILTER_SANITIZE_STRING );
    $mobile = filter_var( $arg['mobile'], FILTER_VALIDATE_INT );
    $password = filter_var( $arg['password'], FILTER_SANITIZE_STRING );
    $password = password_hash( $arg['password'], PASSWORD_DEFAULT );
    $valid_email = filter_var( $arg['email'], FILTER_VALIDATE_EMAIL );
    $add_admin = 'add-admin';

    if ( !$valid_email ) {
        return 'invalid_email';
    } else {
        // , 'signup-admin' => $add_admin
        return ['fname' => $fname, 'lname' => $lname, 'email' => $email, 'country_code' => $country_code, 'mobile' => $mobile, 'password' => $password, 'signup-admin' => $add_admin];
    }

}

function show_error( $arg ) {
    $error = [
        'empty' => 'Warning : all field required !',
        'invalid_email' => 'Error : invalid Email farmet !',
        'stmt_error'    => 'Opps something wen\'t wrong',
        'stmt_not_execute' => 'Error: Email or mobile already exists..'
    ];
    echo "<script>window.location.href='../main.php?".$error[$arg]."';</script>";

    // header( 'location:../main.php?error='.$error[$arg] );
}

function show_success( $arg ) {
    $success = [
        'signup_successfull' => 'Admin account added successfull!'
    ];
    echo "<script>window.location.href='../main.php?success=".$success[$arg]."';</script>";

    // header( 'location:../main.php?success='.$success[$arg] );
}
?>