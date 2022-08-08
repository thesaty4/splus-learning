<?php
session_start(); if(isset($_POST['exam_start']) && isset($_SESSION['login'])){
include("../../../../../include/database_connection.php");
$conn = db_conn();
    // Error show 
    function errorShow($msg){
        if($_SESSION['login']['account_type'] == 'admin'){
            echo "<script>window.location.href='../main.php?error=".$msg."';</script>";
            
            // header("location:../main.php?error=".$msg."");
        }else if($_SESSION['login']['account_type'] == 'user'){
            echo "<script>window.location.href='../../user/main.php?error=".$msg."';</script>";
            // header("location:../../user/main.php?error=".$msg."");
        }
    }

    // Exam section

function examStart($topic_id,$user_id,$status){?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Splus-Learning</title>
        <link rel = 'stylesheet' type = 'text/css' href = '../../../../../icon/fontawesome-free-5.13.0-web/css/all.css'>
        <link rel = 'stylesheet' type = 'text/css' href = '../../../../../css/bootstrap.min.css'>
        <link rel = 'stylesheet' type = 'text/css' href = '../../../../../css/style.css'>
        <style>
        body {
            /* background:#0000; */
            background:url("../../../../../img/macbook.jpg");
            /* background-color: black; */
            z-index: -1;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
        /* body::after{
            content: '';
            position:absolute;
            top:0;
            left:0;
            width: 100%;
            height: 100%;
            background: black;
            opacity: .3;
            z-index: -1;
        } */
        #jumbo{
            /* opacity: .6; */
            /* z-index: -1; */
        }
        </style>

        <script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
        <script src = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'></script>
        <script src = '../../../../../js/signup-validate.js'></script>
        <script src = '../../../../../js/alert-message.js'></script>
</head>
<body>
<marquee behavior="loop" direction="left-right" class='fixed-top mt-5 pt-2 bg-aqua font-weight-bold box-shadow-black font-cambria-math' style='letter-spacing:1px;'>Hello student's Welcome to Splus-Learning Examination System. Best of luck for your examination... Helpline +91-9120829055, Email : satyamishra559@gmail.com Thank you...</marquee>
        <?php include("../../../../../include/exam-navbar.php");
            // if(isset($_POST['delete_history'])){
            //     $conn = db_conn();
            //     mysqli_query($conn,"DELETE FROM question_history;");
            // }
            if(!isset($_POST['showQNA'])){
         ?> <div class="d-flex justify-content-center align-items-center h-100vh mx-md-5 mx-4">
                <div class='p-4 radius bg-light box-shadow-black font-cambria-math'><?php
            $conn = db_conn();
            // $sql = "SELECT `q`.*, `o`.*, `a`.* FROM `questions` AS `q` INNER JOIN `options` AS `o` ON `q`.`question_id`=`o`.`question_id` INNER JOIN `answers` AS `a` ON `q`.`question_id` = `a`.`question_id` WHERE `q`.`topic_id` = '$topic_id' ;";
            // $sql = "SELECT * FROM questions WHERE topic_id = $topic_id limit 3,1";
            $sql = "SELECT * FROM questions WHERE topic_id = $topic_id";
            $obj = mysqli_query($conn,$sql);
            $total_rows = mysqli_num_rows($obj);
            if(!$obj){
                errorShow("Error : Invalid user!");
            }
            
                if(mysqli_num_rows($obj) == 0){
                    echo "<div class='mt-5 bg-light fa-2x'><center>0 Question found..!</center></div>";
                }else if(mysqli_num_rows($obj) != 0){
                    if(isset($_POST['page'])){
                        $page_num = $_POST['page'] + 1;
                    }else{
                        $page_num = 0;
                    }
                    $sql = "SELECT * FROM questions WHERE topic_id = $topic_id limit $page_num,1";
                    $obj = mysqli_query($conn,$sql);
                    $num_rows = mysqli_num_rows($obj);
                    
                    $count = $page_num + 1;

                    if($page_num < $total_rows){
                       echo "<div class='h3 font-weight-bold px-md-5'>Number of Questions <span class='ml-md-5'>".$count."/".$total_rows."</span></div><hr>";
                    }
                

// ____________________________________________________________Question Submiting area_______________________________________________________

                        echo "<form action='exam-page.php' method='post' onsubmit='return(exam_question_validate())' was-validated>";
                        while($rows = mysqli_fetch_assoc($obj)){
                            $q_id = $rows['question_id'];
                            $opt_query = "SELECT * FROM options WHERE question_id = $q_id;";
                            $opt_obj   = mysqli_query($conn,$opt_query); 
                            $opt_rows  = mysqli_fetch_assoc($opt_obj);
                            echo "<span class='h5 font-weight-bold text-capitalize'> Question ".$count." : ".$rows['question']." ?</span>"."<br>";
                            echo " <input type='text' name='question_id' value='".$rows['question_id']."' hidden> ";
                            echo " <input type='text' name='counter' value='".$count."' hidden> ";
                            echo "<span class='ml-3'><input type='radio' name='opt' value='a' required> ".$opt_rows['opt1']."</sapn><br>";
                            echo "<span class='ml-3'><input type='radio' name='opt' value='b' required> ".$opt_rows['opt2']."</sapn><br>";
                            echo "<span class='ml-3'><input type='radio' name='opt' value='c' required> ".$opt_rows['opt3']."</sapn><br>";
                            echo "<span class='ml-3'><input type='radio' name='opt' value='d' required> ".$opt_rows['opt4']."</sapn><br><br>";
                        }

                    // --------------------- Answer checking -----------------------
                    function recordInsert($conn,$user_id,$topic_id,$q_id,$opt){
                        // $user_check = 0;
                        // $update_check = 0;

                        // $obj = mysqli_query($conn,"SELECT * FROM question_history WHERE `user_id` = $user_id");
                        // $topic_obj = mysqli_query($conn,"SELECT * FROM question_history WHERE `t_id` = $topic_id;");
                        // if(mysqli_num_rows($obj) == 0){
                        //     mysqli_query($conn,"INSERT INTO `question_history` (`user_id`,`t_id`,`q_id`,`answer`) VALUES ('$user_id','$topic_id','$q_id','$opt');");
                        //     $user_check = 1;
                        // }else if(mysqli_num_rows($topic_obj) == 0){
                        //     mysqli_query($conn,"INSERT INTO `question_history` (`user_id`,`t_id`,`q_id`,`answer`) VALUES ('$user_id','$topic_id','$q_id','$opt');");
                        //     $update_check = 1;
                        // }else{
                        //     mysqli_query($conn,"UPDATE `question_history` SET `answer`= '$opt' WHERE `q_id` = $q_id;");
                        // }
                        if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `question_history` WHERE `user_id` = '$user_id' AND `t_id` = '$topic_id' AND `q_id` = '$q_id';")) == 0){
                            mysqli_query($conn,"INSERT INTO `question_history` (`user_id`,`t_id`,`q_id`,`answer`) VALUES ('$user_id','$topic_id','$q_id','$opt');");
                        }else{
                            mysqli_query($conn,"UPDATE `question_history` SET `answer`= '$opt' WHERE `user_id` = '$user_id' AND `t_id` = '$topic_id' AND `q_id` = '$q_id';");
                        }
                    }

                    if(isset($_POST['question_id'])){
                        $q_id = $_POST['question_id'];
                        $obj = mysqli_query($conn,"SELECT * FROM answers WHERE question_id = $q_id;");
                        $rows = mysqli_fetch_assoc($obj);
                        $db_answer = $rows['answer'];
                        if($db_answer == $_POST['opt']){
                            // echo 'true';
                            $opt = $_POST['opt'];
                            recordInsert($conn,$user_id,$topic_id,$q_id,$opt);
                        }else{
                            // echo 'false';
                            $opt = $_POST['opt'];
                            recordInsert($conn,$user_id,$topic_id,$q_id,$opt);
                        }
                    }
                        
                    // ------------------ Next Button ----------------------
                    if($page_num < $total_rows -1){
                    echo "
                    <input type='text' name='exam_status' value='".$status."' hidden>
                    <input type='text' name='topic_id' value='".$topic_id."' hidden>
                    <input type='text' name='user_id' value='".$user_id."' hidden>
                    <input type='text' name='page' value='".$page_num."' hidden>
                    <button type='submit' name='exam_start' class='btn btn-block btn-dark'><i class='fas fa-recycle'></i> NEXT</button>";             
                    } if($page_num == $total_rows - 1){
                        // $last_page = $page_num + 1;
                        // <input type='text' name='last-page' value='".$last_page."' hidden>
                        echo "
                        <input type='text' name='exam_status' value='".$status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <input type='text' name='page' value='".$page_num."' hidden>
                        <button type='submit' name='exam_start' class='btn btn-block btn-dark'><i class='fas fa-lock'></i> Submit</button>";             
                        }
                echo "</form>"; 
// _________________________________________________________________________________________________________________________________________



            //    -------------------------- Showing result ------------------------------------
               if($page_num == $total_rows){
                        $true = 0;
                        $false = 0;
                        echo "<br><br><br><div class='row'>
                        <div class='col-12 text-center h4 font-weight-bold px-5'> Splus-learning Exam Result </div>
                        </div><hr>";
                        $result_set = mysqli_query($conn,"SELECT * FROM `question_history` WHERE `user_id` = '$user_id' AND `t_id` = '$topic_id';");
                        while($data = mysqli_fetch_assoc($result_set)){
                            $q_id         = $data['q_id'];
                            $right_result = mysqli_query($conn,"SELECT `q`.*, `a`.* FROM `questions` AS `q` INNER JOIN `answers` AS `a`  ON `q`.`question_id`=`a`.`answer_id` WHERE `q`.`question_id` = '$q_id';");
                            $result_data = mysqli_fetch_assoc($right_result);
                            // echo $data['answer']."<hr>";
                            // echo $result_data['answer']."<hr>";
                            if($data['answer'] == $result_data['answer']){
                                $true += 1;
                            }else{
                                $false += 1;
                            }
                        }
                        $per      = ($true*100)/$total_rows;
                        $check_user = mysqli_query($conn,"SELECT * FROM `ranks` WHERE `user_id` = '$user_id';");
                        if(mysqli_num_rows($check_user) == 0){
                            mysqli_query($conn,"INSERT INTO `ranks` (`user_id`,`percentage`) VALUES ('$user_id','$per');");
                        }else if(mysqli_num_rows($obj) == 0){
                            mysqli_query($conn,"INSERT INTO `ranks` (`user_id`,`percentage`) VALUES ('$user_id','$per');");
                        }else{
                            mysqli_query($conn,"UPDATE `ranks` SET `percentage` = '$per' WHERE `user_id` = '$user_id';");
                        }
                        $obj      = mysqli_query($conn,"SELECT * FROM `ranks` ORDER BY `percentage` DESC");
                        $cou  = 1;
                        while($rank_data = mysqli_fetch_assoc($obj)){
                            if($rank_data['user_id'] != $user_id){
                                $cou += 1;
                            }else if($rank_data['user_id'] == $user_id){
                                break;
                            }
                        }
                        echo "<div class='container-fluid'>
                                <table class='table table-striped'>
                                <tr><td><i class='fas fa-envelope'></i> Question Solve : </td><td>".$total_rows."</td></tr>
                                <tr class='text-success font-weight-bold'><td><i class='fas fa-check'></i> Right Answer</td><td>".$true."</td></tr>
                                <tr class='text-danger font-weight-bold'><td><i class='fas fa-times'></i> Wrong Answer</td><td>".$false."</td></tr>
                                <tr><td><i class='fas fa-mobile-alt'></i> Percentage Gain</td><td>".$per."%</td></tr>
                                <tr><td><i class='fas fa-recycle'></i> Rank Gain</td><td>".$cou."</td></tr>
                                </table>
                                </div>";

                        echo "<form action='exam-page.php' method='post'>
                        <input type='text' name='exam_status' value='".$status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <button type='submit' name='exam_start' class='btn btn-block mb-2 btn-danger'><i class='fas fa-recycle'></i> Exam-Restart</button>
                        </form>

                        <form action='exam-page.php' method='post'>
                        <input type='text' name='exam_status' value='".$status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <input type='text' name='showQNA' value='".$topic_id."' hidden>
                        <button type='submit' name='exam_start' class='btn btn-block mb-2 btn-dark'><i class='fas fa-laptop'></i> Show QNA</button>
                        </form>";
                        if($_SESSION['login']['account_type'] == 'admin'){
                            echo "<a href='../main.php' class='btn btn-block btn-danger'><i class='fas fa-home'></i> Go to Home</a>";
                        }else if($_SESSION['login']['account_type'] == 'user'){
                            echo "<a href='../../user/main.php' class='btn btn-block btn-danger'><i class='fas fa-home'></i> Go to Home</a>";
                        }
                        }
                        // ---------------pagination create----------------
                        // echo "<div class='d-flex bg-dark radius'>";
                        //     for($i = 0; $i < $total_rows; $i++){
                        //         echo "<form action='exam-page.php' method='post'>
                        //                 <input type='text' name='exam_status' value='".$status."' hidden>
                        //                 <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        //                 <input type='text' name='user_id' value='".$user_id."' hidden>
                        //                 <input type='text' name='page' value='".$i."' hidden>
                        //                 <button type='submit' name='exam_start' class='button-none text-light p-1'>".$i."</button>
                        //         </form>";
                        //     }
                        // echo "</div>";
                    }
                }
            
            ?>

            
        </div>
<?php } if(isset($_POST['showQNA'])){{
    echo "<br><br><div class='mt-5 d-flex justify-content-center font-cambria-math'><div class='jumbotron'><div class='h1 font-weight-bold px-5'>Your Exam Performance</div><hr>";
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        $status = $_POST['exam_status'];
        $user_id = $_POST['user_id'];
        $topic_id = $_POST['topic_id'];
        $obj = mysqli_query($conn,"SELECT * FROM questions WHERE topic_id = $topic_id;");
        $count = 1;
        while($rows = mysqli_fetch_assoc($obj)){
            $q_id = $rows['question_id'];
            $opt_obj   = mysqli_query($conn,"SELECT * FROM options WHERE question_id = $q_id;"); 
            $answer_obj   = mysqli_query($conn,"SELECT * FROM answers WHERE question_id = $q_id;"); 
            $user_answer_obj   = mysqli_query($conn,"SELECT * FROM question_history WHERE `user_id` = '$user_id' AND `t_id` = '$topic_id' AND `q_id` = '$q_id';"); 

            $user_answer_rows  = mysqli_fetch_assoc($user_answer_obj);
            $answer_rows  = mysqli_fetch_assoc($answer_obj);
            $opt_rows  = mysqli_fetch_assoc($opt_obj);
            if($answer_rows['answer'] == $user_answer_rows['answer']){
                $color  = 'text-success';
            }else{
                $color  = 'text-danger';
                $currect_answer = "<div class='bg-dark text-center text-light radius box-shadow-black'><tr><td>Question ".$count." Currect Answer is : ".$answer_rows['answer']."</td></tr></div>";
            }
            echo "<div class='".$color."'><span class='h5 font-weight-bold text-capitalize'> Question ".$count." : ".$rows['question']." ?</span>"."<br>";?>
            <span class='ml-3'><input type='radio' name='opt <?php echo $count;?>' <?php if($user_answer_rows['answer'] === 'a'){ echo 'checked';}else{ echo "disabled";}?>> <?php echo $opt_rows['opt1'] ?></sapn><br>
            <span class='ml-3'><input type='radio' name='opt <?php echo $count;?>' <?php if($user_answer_rows['answer'] === 'b'){ echo 'checked';}else{ echo "disabled";}?>> <?php echo $opt_rows['opt2'] ?></sapn><br>
            <span class='ml-3'><input type='radio' name='opt <?php echo $count;?>' <?php if($user_answer_rows['answer'] === 'c'){ echo 'checked';}else{ echo "disabled";}?>> <?php echo $opt_rows['opt3'] ?></sapn><br>
            <span class='ml-3'><input type='radio' name='opt <?php echo $count;?>' <?php if($user_answer_rows['answer'] === 'd'){ echo 'checked';}else{ echo "disabled";}?>> <?php echo $opt_rows['opt4'] ?></sapn></div>
           <?php 
            if($answer_rows['answer'] != $user_answer_rows['answer']){
                echo $currect_answer;
            }
            echo "<br><br>";
            $count += 1;
        }
        echo "<form action='exam-page.php' method='post'>
        <input type='text' name='exam_status' value='".$status."' hidden>
        <input type='text' name='topic_id' value='".$topic_id."' hidden>
        <input type='text' name='user_id' value='".$user_id."' hidden>
        <button type='submit' name='exam_start' class='btn  mb-2 btn-block btn-danger'><i class='fas fa-recycle'></i> Exam-Restart</button>
        </form>";
        
        if($_SESSION['login']['account_type'] == 'admin'){
            echo "<a href='../main.php?success=Your exam has been finished!' class='btn btn-block btn-success'><i class='fas fa-check'></i> Exam-Finished</a>";
        }else if($_SESSION['login']['account_type'] == 'user'){
            echo "<a href='../../user/main.php?success=Your exam has been finished!' class='btn btn-block btn-success'><i class='fas fa-check'></i> Exam-Finished</a>";
        }
    echo "</div></div>";
    }

?>
</body>
</html>
  <?php  
}
    // if(isset($_POST['delete_history'])){
    //     $conn = db_conn();
    //     mysqli_query($conn,"DELETE FROM question_history;");
    // }
    $status = filter_var($_POST['exam_status'],FILTER_SANITIZE_STRING);
    $topic_id = filter_var($_POST['topic_id'],FILTER_SANITIZE_STRING);
    $user_id = filter_var($_POST['user_id'],FILTER_SANITIZE_STRING);
    $query = "SELECT * FROM `exam_status` WHERE `topic_id` = '$topic_id' && `user_id` = '$user_id';";
    $obj   = mysqli_query($conn,$query);
    if($status == 'restart'){
        if(mysqli_num_rows($obj) == 0){
            $sql = "INSERT INTO `exam_status` (`exam_status`,`topic_id`,`user_id`) VALUES (?,?,?);";
            $stmt = mysqli_prepare($conn,$sql);
            if(!$stmt){
                errorShow('Error : Somthing wrong!');
            }
            mysqli_stmt_bind_param($stmt,'ssi',$status,$topic_id,$user_id);
            $rslt = mysqli_stmt_execute($stmt);
            if(!$rslt){
                errorShow('Error : Data inserting problem');
            }
            mysqli_stmt_close($stmt);
        }
            $sql = "UPDATE `exam_status` SET `exam_status` = ? WHERE `topic_id` = ? && `user_id` = ?;";
            $stmt = mysqli_prepare($conn,$sql);
            if(!$stmt){
                errorShow('Error : Somthing wrong!');
            }
            mysqli_stmt_bind_param($stmt,'sii',$status,$topic_id,$user_id);
            $rslt = mysqli_stmt_execute($stmt);
            if(!$rslt){
                errorShow('Error : Data updating problem');
            }
            mysqli_stmt_close($stmt);
            examStart($topic_id,$user_id,$status);
        }
        if($status == 'start'){examStart($topic_id,$user_id,$status);}
}else{ 
    echo "<script>window.location.href='../../../../../index.php?error=Unautorized user!';</script>";
    
    // header("location:../../../../../index.php?error=Unautorized user!");
}?>

