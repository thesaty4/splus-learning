function signup_validate() {
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var email = document.getElementById('signup_email').value;
    var country_code = document.getElementById('country_code').value;
    var mobile = document.getElementById('mobile').value;
    var password = document.getElementById('signup_password').value;
    var confirm_password = document.getElementById('confirm_password').value;

    // email verification to check input field empty or not, embbed '|| otp == ''' otp variable in if condition
    // var otp              = document.getElementById('otp').value
    if (fname == '' || lname == '' || email == '' || country_code == '' || mobile == '' || password == '' || confirm_password == '' ) {
        alert("All field required.");
        return false;
    }
    if (mobile.length != 10) {
        alert("Warning : Mobile number should be 10 digitis..");
        return false;
    }
    if (password != confirm_password) {
        alert("Warning : password sould be same.!");
        return false;
    }
    return true;
}

function opt_verification(){
    window.location.href=("../mailer.php?otp=genrate otp");
}

function user_details(arg){
    document.getElementById('user_details').style="position:absolute; height:100vh; background-color:black;";
}

function exam_question_validate(){
    var radio = document.getElementsByName('opt');
    var formValid = false;
    var i = 0;
    while(!formValid && i < radio.length){
        if(radio[i].checked) formValid = true;
        i++;
    }
    if(!formValid) alert("Must check some option");
    return formValid;
}