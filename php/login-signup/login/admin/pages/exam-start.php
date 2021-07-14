<div class='mt-5'>
<?php
     $conn = db_conn();
     // All data fatched query
     // $sql  = "SELECT `t`.*, `q`.*, `o`.*, `a`.* FROM `topics` AS `t` INNER JOIN `questions` AS `q` ON `t`.`topic_id` = `q`.`topic_id` INNER JOIN `options` AS `o` ON `o`.`question_id`=`q`.`question_id` INNER JOIN `answers` AS `a` ON `a`.`question_id`=`q`.`question_id`;";
     $sql = "SELECT * FROM `topics`";
     $content_obj = mysqli_query($conn,$sql);
     if(!$content_obj){echo "object doesn't created";}
     if(mysqli_num_rows($content_obj) == 0){echo "<div class='d-flex justify-content-center align-items-center text-center font-weight-bold fa-2x' style='height:75vh;'>0 Record Found</div>";}
     if(mysqli_num_rows($content_obj) != 0){
        echo "<div class='table-responsive'><table class='table table-hover table-striped text-center bg-light box font-cambria-math'>
        <thead class='bg-dark text-light'>
           <tr><td>#</td><td>Topics Name</td><td>Exam</td><td>Q&A</td></tr>
        </thead>
        ";
        $numbering = 1;
        while($rows = mysqli_fetch_assoc($content_obj)){
            $topic_id = $rows['topic_id'];
            $user_id  = $_SESSION['login']['id'];
            $topic_status = $rows['status'];
            $exam_query = "SELECT * FROM `exam_status` WHERE `topic_id` = '$topic_id' && `user_id` = '$user_id';";
            $exam_obj =   mysqli_query($conn,$exam_query);
            $num_of_rows = mysqli_num_rows($exam_obj);
            if($num_of_rows == 0){
                $status = "<nav class='text-success'><i class='fas fa-play'></i> Start</nav>";
                $exam_status = 'restart';
            }
            $exam_rows = mysqli_fetch_assoc($exam_obj);
            if($exam_rows['exam_status'] == 'start'){
                $status = "<nav class='text-success font-weight-bold'><i class='fas fa-play'></i> Start</nav>";
                $exam_status = 'restart';
            }if($exam_rows['exam_status'] == 'restart'){
                $status = "<nav class='text-danger font-weight-bold'><i class='fas fa-recycle'></i> Restart</nav>";
                $exam_status = 'start';
            }
            
            echo "<tr><td>".$numbering."</td><td>".$rows['name']."</td>
                    <td>";
                        if($topic_status == 'active'){
                            if($_SESSION['login']['account_type'] == 'admin'){
                                echo "<form action='pages/exam-page.php' method='post'>";
                            }else if($_SESSION['login']['account_type'] == 'user'){
                                echo "<form action='../admin/pages/exam-page.php' method='post'>";
                            }
                              echo "<input type='text' name='exam_status' value='".$exam_status."' hidden>
                                    <input type='text' name='topic_id' value='".$topic_id."' hidden>
                                    <input type='text' name='user_id' value='".$user_id."' hidden>
                                    <button type='submit' name='exam_start' class='button-none'>".$status."</button>
                                </form>";
                        }else if($topic_status == 'deactive'){
                            echo "<button class='button-none text-danger'><i class='fas fa-circle'></i> Offline</button>";
                        }
            echo "</td>";
            
            if($num_of_rows == 0){
                $result_show = "<nav class='text-danger font-weight-bold'><i class='fas fa-stop'></i> No Result</nav>";
                echo "<td>".$result_show."</td>";
            }else{
                $result_show = "<nav class='text-success font-weight-bold'><i class='fas fa-folder-open'></i> QNA</nav>";
                
                if($_SESSION['login']['account_type'] == 'user'){
                    echo "<form action='../admin/pages/exam-page.php' method='post'><input type='text' name='exam_status' value='".$exam_status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <input type='text' name='showQNA' value='".$topic_id."' hidden>
                        <td><button type='submit' name='exam_start' class='button-none'>".$result_show."</button></td>
                    </form>";
                }else if($_SESSION['login']['account_type'] == 'admin'){
                    echo "<form action='pages/exam-page.php' method='post'><input type='text' name='exam_status' value='".$exam_status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <input type='text' name='showQNA' value='".$topic_id."' hidden>
                        <td><button type='submit' name='exam_start' class='button-none'>".$result_show."</button></td>
                    </form>";
                }
            }
            echo "
                </tr>";

            $numbering += 1;
        }
        echo "</table></div>";
     }
?>

<!-- <form action='exam-page.php' method='post'>
                        <input type='text' name='exam_status' value='".$status."' hidden>
                        <input type='text' name='topic_id' value='".$topic_id."' hidden>
                        <input type='text' name='user_id' value='".$user_id."' hidden>
                        <input type='text' name='showQNA' value='".$topic_id."' hidden> -->
</div>