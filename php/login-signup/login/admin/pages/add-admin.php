<div class="row w-100 mb-5">
        <div class="col-12 form-block font-cambria" id="signup">
                <!-- <div class="d-flex justify-content-center align-items-center"> -->
                    <form action="signup/main.php" method="post" onsubmit="return(signup_validate())" class="mt-5 px-5 py-4 w-100 radius box-shadow-black box was-validated">
                        <h2 class="center text-dark text-center"><i class="fas fa-users mr-2"></i>Create Admin </h2>

                        <lable class="ml-2 mb-2"><i class="fas fa-user"></i> First Name :</lable>
                        <input autocomplete='off' type="text" name="fname" id="fname" placeholder='First Name' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-user"></i> Last Name :</lable>
                        <input autocomplete='off' type="text" name="lname" id="lname" placeholder='Last Name' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-envelope"></i> Email :</lable>
                        <input autocomplete='off' type="email" name="email" id="signup_email" placeholder='Email : example@gmail.com' class="form-control mt-1" required>
                        
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
                            <input autocomplete='off' type="number" name="mobile" id="mobile" placeholder='Mobile Number' class="form-control" required>
                        </div>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-lock"></i> Password :</lable>
                        <input autocomplete='off' type="password" name="password" id="signup_password" placeholder='Type Password' class="form-control mt-1" required>

                        <lable class="ml-2 mb-2 mt-3"><i class="fas fa-lock"></i> Confirm Password :</lable>
                        <input autocomplete='off' type="password" name="confirm_password" id="confirm_password" placeholder='Re-type Password' class = 'form-control mt-1 mb-1' required>
                    
                    <!-- Email verification -->
                        <!-- <lable class="ml-2 mb-2 mt-3"><i class="fas fa-envelope"></i> Email verification OTP :</lable>
                        <input autocomplete='off' type="text" name="otp" id="otp" placeholder='Enter Email OTP' class = 'form-control mt-1 mb-1' disabled> -->
                    
                        <center class="mt-3"><input type = 'submit' value = 'add-admin' name = 'signup-admin' class = 'btn btn-dark btn-block'> 
                        <!-- <button type = 'button' onclick="opt_verification()" name = "otp" class = 'btn btn-primary'>Get OTP</button> -->
                        </center>
                        
        </form>
        <!-- </div> -->
        </div>

       </div>
