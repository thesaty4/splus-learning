<?php
        // echo "open option";
        $q_id = filter_var($_GET['open_option'],FILTER_SANITIZE_STRING);
        $t_id = filter_var($_GET['t_id'],FILTER_SANITIZE_STRING);
        $conn = db_conn();
        
        $sql = "SELECT `o`.* , `a`.* FROM `options` AS `o` INNER JOIN `answers` AS `a` ON `o`.`question_id`=`a`.`question_id` WHERE `o`.`question_id` = '$q_id';";
        $obj = mysqli_query($conn,$sql);
        if(!$obj){
            echo "<script>alert('Opps! somthing wrong');</script>";
        }
        
        $obj = mysqli_query($conn,$sql);
        if(!$obj){
            echo "<script>alert('Opps! somthing wrong');</script>";
        }
        if(mysqli_num_rows($obj) == 0){
            echo "<script>window.location.href='main.php?error=Error : Unexpected input!';</script>";
        }
        $rows = mysqli_fetch_assoc($obj);

        $q_sql = "SELECT `question` FROM `questions` WHERE `question_id` = '$q_id';";
        $q_obj = mysqli_query($conn,$q_sql);
        $q_rows = mysqli_fetch_assoc($q_obj);
?>
        <div class="row text-center bg-dark text-light font-cambria p-2">
            <div class="col-2">
            <form action='main.php' method='post'>
                    <input type='text' name='topic_id' value='<?php echo $t_id;?>' hidden>
                    <button type='submit' name='showQNA' class='button-none text-light'>
                <i class='fas fa-backward'></i></button>
            </form>
            </div>
            <div class="col-8"><?php echo "Que : ".$q_rows['question']." ?"; ?></div>
            <div class="col-1 "> 
                <form action='main.php' method='post'>
                    <input type='text' name='topic_id' value='<?php echo $t_id;?>' hidden>
                    <button type='submit' name='showQNA' class='button-none close text-light'>&times;</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <form action="pages/option-edit.php" method='post' class='form-block'>
            <table class='table table-striped'>
                <input type="text" name='question_id' value="<?php echo $rows['question_id'];?>" hidden>
                <tr><td><label class='mb-1 font-weight-bold'>Option A :</label>
                <input type="text" name='opt1' value="<?php echo $rows['opt1'];?>" class='form-control'></td></tr>
                
                <tr><td><label class='mb-1 font-weight-bold'>Option B :</label>
                <input type="text" name='opt2' value="<?php echo $rows['opt2'];?>" class='form-control'></td></tr>
                
                <tr><td><label class='mb-1 font-weight-bold'>Option C :</label>
                <input type="text" name='opt3' value="<?php echo $rows['opt3'];?>" class='form-control'></td></tr>
                
                <tr><td><label class='mb-1 font-weight-bold'>Option D :</label>
                <input type="text" name='opt4' value="<?php echo $rows['opt4'];?>" class='form-control'></td></tr>
                
                <tr><td><label class='mb-1 font-weight-bold'>Answer :</label>
                <select name="answer" class='form-control'>
                    <option value="a" <?php if($rows['answer'] == 'a'){echo "selected"; }?> >A</option>
                    <option value="b" <?php if($rows['answer'] == 'b'){echo "selected"; }?> >B</option>
                    <option value="c" <?php if($rows['answer'] == 'c'){echo "selected"; }?> >C</option>
                    <option value="d" <?php if($rows['answer'] == 'd'){echo "selected"; }?> >D</option>
                </select></td></tr>
            </table>
                <button type='submit' name='option-edit' class='btn btn-block bg-dark text-light mb-2 button-none'><i class='fas fa-recycle'></i > Update</button>
            </form>
        </div>
<?php
        // echo "<pre>";
        // print_r($rows);
        // mysqli_close($conn);
?>