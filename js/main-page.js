function mail_sender(){
    var name   = document.getElementById("mailer-name").value;
    var subject = document.getElementById("mailer-subject").value;
    var message = document.getElementById("mailer-message").value;
    if(name == '' || subject == '' || message == ''){
        window.location.href=("./index.php?success=All filed required.");
        return false;
    }return ture;
}
