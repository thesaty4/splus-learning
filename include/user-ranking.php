<?php
$conn     = db_conn();
$obj      = mysqli_query($conn,"SELECT * FROM `ranks` ORDER BY `percentage` DESC;");
$counter = 1;
if(mysqli_num_rows($obj) == 0){
    echo "<h2>0 Ranks Found!</h2>";
}else{
    ?>
    <div class="table-responsive font-cambria">
        <table class="table table-striped text-capitalize text-center table-hover box-shadow-black bg-light">
            <tr class='bg-dark text-light '><th>#</th><th>Users Name</th><th><i class='fas fa-signle'></i> Rank</th></tr>
            <?php
                while($rows = mysqli_fetch_assoc($obj)){
                    $user_id = $rows['user_id'];
                    $user_obj = mysqli_query($conn,"SELECT fname, lname FROM user WHERE id = $user_id;");
                    $user_rows = mysqli_fetch_assoc($user_obj);
                    echo "<tr>
                        <td>".$counter."</td>
                        <td>".$user_rows['fname']." ".$user_rows['lname']."</td>
                        <td>#".$counter."</td>
                    </tr>";
                    $counter += 1;
                }
            ?>
        </table>
    </div>
    <?php
}
?>