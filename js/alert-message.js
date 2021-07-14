
 function successAlert(arg){
    document.getElementById('alert').innerHTML='<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+arg+'</strong></div>';
    setTimeout(function(){ document.getElementById('alert').style.display="none";}, 2000);
 }

 function dangerAlert(arg){
    document.getElementById('alert').innerHTML='<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+arg+'</strong></div>';
    setTimeout(function(){ document.getElementById('alert').style.display="none";}, 2000);
 }

 function warningAlert(arg){
    document.getElementById('alert').innerHTML='<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+arg+'</strong></div>';
    setTimeout(function(){ document.getElementById('alert').style.display="none";}, 2000);
 }