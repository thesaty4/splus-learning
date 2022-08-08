<?php session_start();
if ( isset( $_SESSION['login'] ) ) {
    echo "<script>window.location.href='./login/'".$_SESSION['login']['account_type']."/main.php';</script>";

    // header( 'location:./login/'.$_SESSION['login']['account_type'].'/main.php' );
} else {
    ?>
    <!DOCTYPE html>
    <html lang = 'en'>
    <head>
    <meta charset = 'UTF-8'>
    <meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
    <title>Login</title>
    <link rel = 'stylesheet' type = 'text/css' href = '../../icon/fontawesome-free-5.13.0-web/css/all.css'>
    <link rel = 'stylesheet' type = 'text/css' href = '../../css/bootstrap.min.css'>
    <link rel = 'stylesheet' type = 'text/css' href = '../../css/style.css'>
    <style>
    body {
        background:url( '../../img/nature.jpg' );
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
    </style>
    <script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
    <script src = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'></script>
    <script src = '../../js/signup-validate.js'></script>
    <script src = '../../js/login-validate.js'></script>
    <script src = '../../js/alert-message.js'></script>
    </head>
    <body>
    <!-- ---------------------------------------------------header GET request handling area -------------------------------------------------- -->
    <?php
    if ( isset( $_GET ) ) {
        echo '<div id="alert" class="fixed-top position-absolute mt-5">';
        if ( isset( $_GET['success'] ) ) {
            echo "<script> successAlert('".$_GET['success']."');</script>";
        }
        if ( isset( $_GET['error'] ) ) {
            echo "<script> dangerAlert('".$_GET['error']."');</script>";
        }
        if ( isset( $_GET['warning'] ) ) {
            echo "<script> warningAlert('".$_GET['warning']."');</script>";
        }
        echo '</div>';
    }
    ?>

    <?php
    include( '../../include/comman-navbar.php' );
    ?>
<div class = 'container h-100vh d-flex justify-content-center align-items-center'>
<?php
    if ( !( isset( $_GET['login'] ) or isset( $_GET['signup'] ) ) ) {
        ?>
        <div class = 'row mt-5 w-100' id = 'log-form'>
        <div class = 'col-12 form-block' >
        <div class = 'd-flex justify-content-center align-items-center mt-5'>
        <form action = './login/login-process/main.php' method = 'post' onsubmit = 'return(log_validate())' id = 'login' class = 'mt-0 p-5 w-100 radius box-shadow-black mb-0 mb-sm-4 was-validated'>
        <h2 class = 'center text-dark text-center'><i class = 'fas fa-user mr-2'></i>Login</h2>

        <lable class = 'ml-2 mb-2'><i class = 'fas fa-envelope mr-2'></i>Email :</lable>
        <input autocomplete="off" type = 'email' name = 'email' id = 'email' class = 'form-control mt-1' placeholder = 'Email' required><br>

        <lable class = 'ml-2 mb-2 mt-3'><i class = 'fas fa-unlock-alt mr-2'></i>Password :</lable>
        <input autocomplete="off" type = 'password' name = 'password' id = 'password' class = 'form-control mt-1' placeholder = 'Password' required><br>

        <lable class = 'ml-2 mb-2 mt-3'><i class = 'fas fa-fingerprint mr-2'></i>Captcha</lable>
        <?php $code = mt_rand( 1111, 9999 );
        echo "<input autocomplete='off' type='text' name='captcha-code' id='captcha-code' value='".$code."' hidden>";
        ?>
        <lable class = 'ml-2 mb-2 mt-3 bg-white px-4 px-md-5 '><i><?php echo '<b>'.$code.'</b>';
        ?></i></lable></i>
        <input autocomplete="off" type = 'text' name = 'input-captcha' id = 'input-captcha' class = 'form-control mt-1' placeholder = 'Enter Captcha code' required><br>

        <center><b>I don't have Any account, <a href="login-signup.php?signup">Create New Account!</a></b></center><br>
                    <center><input type="submit" name='login' value="Login" class="btn btn-dark btn-block"></center>
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>

        
<?php
    if(isset($_GET['signup'])){
?>
       <div class="row w-100 mt-5">
        <div class="col-12 form-block mt-5" id="signup">
                <!-- <div class="d-flex justify-content-center align-items-center"> -->
                    <form action="./signup/main.php" method="post" onsubmit="return(signup_validate())" class="mt-5 px-5 py-4 w-100 radius box-shadow-black box was-validated">
                        <h2 class="center text-dark text-center"><i class="fas fa-users mr-2"></i>Sign Up</h2>

                        <lable class="ml-2 mb-2"><i class="fas fa-user"></i> First Name :</lable>
                        <input autocomplete="off" type="text" name="fname" id="fname" placeholder='First Name' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-user"></i> Last Name :</lable>
                        <input autocomplete="off" type="text" name="lname" id="lname" placeholder='Last Name' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-envelope"></i> Email :</lable>
                        <input autocomplete="off" type="email" name="email" id="signup_email" placeholder='Email : example@gmail.com' class="form-control mt-1" required>
                        
                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-phone"></i> Mobile :</lable>
                        <div class="col d-flex px-0">
                            <select name="country_code" id="country_code" class="w-25 pl-lg-5 form-control" required>
                                <option value="">Select</option>
                                <option value="+91">+91</option>
                                <option value="+92">+92</option>
                                <option value="+977">+977</option>
                                <option value="+1">+1</option>
                                <option value="+31">+11</option>
                            </select>
                            <input autocomplete="off" type="number" name="mobile" id="mobile" placeholder='Mobile Number' class="form-control" required>
                        </div>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-lock"></i> Password :</lable>
                        <input autocomplete="off" type="password" name="password" id="signup_password" placeholder='Type Password' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-lock"></i> Confirm Password :</lable>
                        <input autocomplete="off" type="password" name="confirm_password" id="confirm_password" placeholder='Re-type Password' class = 'form-control mt-1 mb-1' required>
                    
                    <!-- Email verification
                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-envelope"></i> Email verification OTP :</lable>
                        <input autocomplete="off" type="text" name="otp" id="otp" placeholder='Enter Email OTP' class = 'form-control mt-1 mb-1' disabled>
                     -->
                        <div class="col text-center"><strong>Already account? Click</strong> <a href="login-signup.php" class="link">Login</a></div>
                        <center class="mt-3"><input type = 'submit' value = 'Ragister' name = 'signup' class = 'btn btn-dark btn-block'</center>
                        
        </form>
        <!-- </div> -->
        </div>

       </div>
    <?php
    }
    ?> 
</div>
<br><br><br><br>
    <div class = 'bg-black mt-3'>
    <?php
    include( '../../include/copyright.php' );
        ?>
        </div>
        </body>
        </html>

        <?php
    }

    ?>