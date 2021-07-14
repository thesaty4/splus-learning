function log_validate(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var captcha = document.getElementById('captcha-code').value;
    var input_captcha = document.getElementById('input-captcha').value;

    if(email == '' || password == '' || captcha == ''){
        alert("all field required");
        return false;
    }
    if(captcha != input_captcha){
        window.location.href=('./login-signup.php?warning=Opps Invalid captcha code, please enter valid captcha');
        return false;
    }
    return true;
}

function passCheck(){
    return false;
}
