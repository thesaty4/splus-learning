<?php
     $conn = db_conn();
     // All data fatched query
     // $sql  = "SELECT `t`.*, `q`.*, `o`.*, `a`.* FROM `topics` AS `t` INNER JOIN `questions` AS `q` ON `t`.`topic_id` = `q`.`topic_id` INNER JOIN `options` AS `o` ON `o`.`question_id`=`q`.`question_id` INNER JOIN `answers` AS `a` ON `a`.`question_id`=`q`.`question_id`;";
     $sql = "SELECT * FROM `topics`";
     $content_obj = mysqli_query($conn,$sql);
    $value = mysqli_num_rows($content_obj);
     if($value == 0){echo "<div class='text-center font-weight-bold fa-2x'>0 Record Found</div>";}
     if($value != 0){
        echo "<div class='table-responsive'><table class='table table-hover table-striped text-center bg-light box font-cambria-math'>
        <thead class='bg-dark text-light'>
           <tr><td>#</td><td>Topics Name</td><td>Editing</td></tr>
        </thead>
        ";
        $numbering = 1;
        while($rows = mysqli_fetch_assoc($content_obj)){
            
            // <button type='submit' name='exam_status'><input type='checkbox' ".$status."></button>
            if($rows['status'] == 'active'){
                $status = 'checked';
            }else if($rows['status'] == 'deactive'){
                $status = '';
            }
            echo "<tr><td>".$numbering."</td><td>".$rows['name']."</td>
                    <td class='d-md-flex'>
                        <div class='col-md-2'><a href='main.php?td=".$rows['topic_id']."' title='Topic Details'><i class='fas fa-folder-open text-dark ml-md-3'></i> </a></div>
                        <div class='col-md-2'>
                            <form action='main.php' method='post'>
                                <input autocomplete='off' type='text' name='topic_id' value='".$rows['topic_id']."' hidden>
                                <button type='submit' name='showQNA' class='button-none'><i class='fas fa-edit text-primary ml-md-3'></i></button>
                            </form>
                        </div>
                        <div class='col-md-2'><a href='main.php?add_q=".$rows['topic_id']."' title='Add Questions'><i class='fas fa-plus text-dark ml-md-3'></i> </a></div>
                        <div class='col-md-2'><a href='pages/data-delete.php?dt=".$rows['topic_id']."' title='Delete TOpic'><i class='fas fa-trash text-danger ml-md-3'></i></a></div>
                        <div class='col-md-2'>
                            <form action='main.php?modification' method='post'>
                                <input autocomplete='off' type='text' name='topic_id' value='".$rows['topic_id']."' hidden>
                                    <button type='submit' name='exam_status' class='button-none'>
                                    <div class='checkbox'>
                                        <label class='switch mt-1 position-absolute-lg'>
                                            <input type='checkbox' ".$status.">
                                            <span class='slider round'></span>
                                        </label>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>";

            $numbering += 1;
        }
        echo "</table></div>";
     }
?>