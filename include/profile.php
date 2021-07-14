<?php
$conn = db_conn();
if(isset($_GET['profile'])){
    $user_id = $_SESSION['login']['id'];
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user where id=$user_id;")) == 0){
        echo "<script>window.location.href='main.php?error=Error : 404 Unexpected user id!';</script>";
    }else{
        $obj = mysqli_query($conn,"SELECT * FROM user WHERE id=$user_id;");
        echo "<div class='mt-5'>";
        echo "<form action='main.php' method='post' class='bg-light p-4 radius box-shadow-black was-validated'>";
        echo "<div class='w-100'><center><i class='fas fa-user-circle fa-5x'></i></center></div>";
        while($rows = mysqli_fetch_assoc($obj)){
            echo "<lable class='font-weight-bold mb-1'> First Name : </lable>";
            echo "<input type='number' name='user_id' value='".$user_id."' hidden>";
            echo "<input type='text' name='fname' value='".$rows['fname']."' class='form-control mb-2' required>";
            echo "<lable class='font-weight-bold mb-1'> Last Name : </lable>";
            echo "<input type='text' name='lname' value='".$rows['lname']."' class='form-control mb-2' required>";
           
            echo "<lable class='font-weight-bold mb-1'> Email Id : </lable>";
            echo "<input type='text' name='email' value='".$rows['email']."' class='form-control mb-2' required>";
           
            echo "<lable class='font-weight-bold mb-1'> Mobile Number : ".$rows['country_code']."</lable>";
            echo "<input type='text' name='mobile' value='".$rows['mobile']."' class='form-control mb-2' required>";
            
            echo "<table class='table table-striped'><tr><td><lable class='font-weight-bold mb-1'> Account Type : ".$rows['account_type']."</lable></td></tr>";
            
            echo "<tr><td><lable class='font-weight-bold mb-1'> Account Status : ".$rows['status']."</lable></td></tr>";
            
            echo "<tr><td><lable class='font-weight-bold mb-1'> Creating Time : ".$rows['c_time']."</lable></td></tr>";

            echo "<tr><td><lable class='font-weight-bold'> Creating Date : ".$rows['c_date']."</lable></td></tr></table>";
            echo "<div class='btn-group w-100'><button type='submit' name='profile_update' value='update' class='btn btn-dark active'><i class='fas fa-edit'></i> Update</button>";
            echo "<a href='main.php?passUpdate=".$_SESSION['login']['id']."' class='btn btn-dark'>Password Change</a></div>";
        }
        echo "</form>";
        echo "</div>";
    }
}
// profile updating process
if(isset($_POST['profile_update'])){
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    foreach ($_POST as $key => $value) {
       if($value == ''){
           echo "<script>window.location.href='main.php?warning=Warning : All field required!';</script>";
       }
    }
    $user_id = filter_var($_POST['user_id'],FILTER_SANITIZE_STRING);
    $fname = filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

    $rslt = mysqli_query($conn,"UPDATE `user` SET `fname` = '$fname', `lname` = '$lname', `mobile` = '$mobile', `email` = '$email' WHERE `id` = '$user_id';");
    if(!$rslt){
        echo "<script>window.location.href='main.php?error=Error : Data updating problem occured!';</script>";
    }else{
        echo "<script>window.location.href='main.php?success=Success : Profile updated!';</script>";
    }
}

// password GUI
if(isset($_GET['passUpdate'])){
    $user_id = $_GET['passUpdate'];
    if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user where id=$user_id;")) == 0){
        echo "<script>window.location.href='main.php?error=Error : 404 Unexpected user id!';</script>";
    }else{
        echo "<div class='d-flex justify-content-center align-items-center h-100vh' style='height:85vh;'><form action='main.php' method='post' class='bg-light p-4 radius box-shadow-black was-validated' onsubmit='return(passCheck());'> 
            
        <input type='text' name='user_id' value='".$user_id."' hidden>
            <div class='col mb-1'><center><i class='fas fa-lock fa-5x'></i></center></div>
            <lable class='mb-1 font-weight-bold'><i class='fas fa-key'></i> Old Password :</lable>
            <input type='text' name='oldPass' class='form-control mb-3' id='oldPass' placeholder='Old Password' required>
            <lable class='mb-1 font-weight-bold'><i class='fas fa-key'></i> New Password :</lable>
            <input type='password' name='newPass' id='newPass' class='form-control mb-3' placeholder='New Password' required>
            <lable class='mb-1 font-weight-bold'><i class='fas fa-key'></i> Confirm New Password :</lable>
            <input type='password' name='confirmPass' id='confirmPass' class='form-control mb-3' placeholder='Re-type Password' required>
            <button type='submit' name='changeMyPass' value='change' class='btn btn-dark w-100'><i class='fas fa-edit'></i> Update</button>
            </form></div>";
    }
}

// password changing
if(isset($_POST['changeMyPass'])){
    $user_id = $_POST['user_id'];
    foreach ($_POST as $key => $value) {
        if($value == ''){
            echo "<script>window.location.href='main.php?warning=Warning : All field required!';</script>";
        }
    }

    $oldPass = filter_var($_POST['oldPass'],FILTER_SANITIZE_STRING);
    $newPass = filter_var($_POST['newPass'],FILTER_SANITIZE_STRING);
    $confirmPass = filter_var($_POST['confirmPass'],FILTER_SANITIZE_STRING);
    if($newPass != $confirmPass){
        echo "<script>window.location.href=('main.php?warning=Warning : New and Confirm password must be same!');</script>";
    }
    $obj = mysqli_query($conn,"SELECT `password` FROM `user` WHERE `id` = '$user_id';");
    if(mysqli_num_rows($obj) == 0){
        echo "<script>window.location.href=('main.php?error=Error404 : Unexpected user id!');</script>";
        // echo $db_pass['password'];
    }
    
    $db_pass = mysqli_fetch_assoc($obj);
    $pass    = $db_pass['password'];
    // Password verification
    $status = password_verify($oldPass,$pass);
    if(!$status){
        echo "<script>window.location.href=('main.php?error=Opps! Invalid Password :(');</script>";
    }else{
        $password = password_hash($newPass,PASSWORD_DEFAULT);
        $status = mysqli_query($conn,"UPDATE `user` SET `password` = '$password';");
        if(!$status){
            echo "<script>window.location.href=('main.php?error=Error404 : Password Update Unsuccessfull :(');</script>";
        }else{
            echo "<script>window.location.href=('main.php?success=Success : Password has been changed.. :)');</script>";
        }
    }
}
?>
<script>
    function passCheck(){
        var oldPass = document.getElementById("oldPass").value;
        var newPass = document.getElementById("newPass").value;
        var confirmPass = document.getElementById("confirmPass").value;
        if(oldPass == '' or newPass == '' or confirmPass == ''){
            alert("Warning : All field required!");
            return false;
        }
        if(newPass != confirmPass){
            alert("Warning : New password and confirm passsword should be same!");
            return false;
        }
        return false;
    }
</script>