<div class="mt-5"><div class="bg-light w-100 box-shadow-black" <?php if(isset($_GET['users'])  && isset($_GET['user_id'])){echo "style='display:none;'";}?>>
    <?php
        $conn = db_conn();
        $sql  = "SELECT * FROM `user`";
        $user_obj = mysqli_query($conn,$sql);
        if(!$user_obj){echo "object doesn't created";}
        if(mysqli_num_rows($user_obj) == 0){echo "<div class='text-center font-weight-bold fa-2x'>0 Record Found</div>";}
       
        if($_SESSION['login']['account_type'] == 'admin'){
            $num_user = "<td>".mysqli_num_rows($user_obj)."</td>";         
         }else if($_SESSION['login']['account_type'] == 'user'){
            $num_user = '';
        }
        
        echo "<div class='table-responsive'>";
            echo "<table class='table table-hover table-striped text-center'>";
                echo "<thead class='bg-dark text-light'><tr><td>#</td><td>Name</td><td>Type</td><td>Details</td>".$num_user."</tr></thead>";
                $counter = 1 ;
                while($user_data = mysqli_fetch_assoc($user_obj)){
                    if($user_data['status'] == 'active'){
                        $status = 'checked';
                    }else if($user_data['status'] == 'deactive'){
                        $status = '';
                    }
                    echo "<tr>
                    <td class='text-capitalize'>".$counter."</td>
                    <td class='text-capitalize'>".$user_data['fname']." ".$user_data['lname']."</td>
                    <td class='text-capitalize'>".$user_data['account_type']."</td>
                    <td><a href='main.php?users&&user_id=".$user_data['id']."'><i class='fas fa-folder-open text-dark' title='Open'></i></a></td>";

                    if($_SESSION['login']['account_type'] == 'admin'){
                           echo "<td>
                            <form action='main.php?users' method='post'>
                                <input type='text' name='d' value='".$user_data['id']."' hidden>
                                <button type='submit' class='border-none'>
                                    <div class='checkbox'>
                                        <label class='switch mt-1 position-absolute-lg'>
                                        <input type='checkbox' ".$status.">
                                        <span class='slider round'></span>
                                        </label>
                                    </div>
                                </button>
                            </form>
                            </td>";
                        }
                    echo "</tr>";      
                    $counter += 1;
                }
            echo "</table>";
            echo "</div>";
        echo "</div>";
    ?>  
    <?php if(isset($_GET['users'])  && isset($_GET['user_id'])){
        $conn = db_conn();
        $id = $_GET['user_id'];
        $sql  = "SELECT * FROM `user` WHERE `id` = '$id'";
        $user_obj = mysqli_query($conn,$sql);
        echo '<div class="row bg-light p-3 box mb-5 w-md-100">
            <div class="col-10 font-weight-bold" style="font-size:20px;">User Details</div>
            <div class="col-2"><a href="main.php?users" class="close" aria-label="close">&times;</a></div>
            <div class="col-12 text-capitalize ml-md-5 font-cambria"><br>';
            if(mysqli_num_rows($user_obj) == 0){echo "<strong>Opps Invalid Data!</strong>";}
                while($u_data = mysqli_fetch_assoc($user_obj)){ 
                    echo "<i class='fas fa-user'></i> &nbsp; First name      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['fname']."<br><br>";
                    echo "<i class='fas fa-user'></i> &nbsp; Last name       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['lname']."<br><br>";
                    if($_SESSION['login']['account_type'] == 'admin'){       
                        echo "<i class='fas fa-phone'></i> &nbsp; Mobile number   &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['country_code'].$u_data['mobile']."<br><br>";
                        echo "<i class='fas fa-envelope'></i> &nbsp; Email Id   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['email']."<br><br>";
                     }
                    echo "<i class='fas fa-users'></i> &nbsp;Account Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['account_type']."<br><br>";
                    echo "<i class='fas fa-folder-open'></i>&nbsp; Account Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['status']."<br><br>";
                    echo "<i class='fas fa-clock'></i>&nbsp; Time of Creating &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['c_time']."<br><br>";
                    echo "<i class='fas fa-calendar-alt'></i>&nbsp; Date of Creating &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$u_data['c_date']."<br><br>";
                }
             echo '</div>
        </div>';
    } ?>
    </div>
</div><br>