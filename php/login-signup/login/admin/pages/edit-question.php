<?php
 include("../../../../../include/database_connection.php");
    if(isset($_POST['edit-question'])){
        // print_r($_POST);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // echo "edit-question";
        $edit_question_num = filter_var($_POST['edit-question'],FILTER_SANITIZE_STRING);
        $q_id       = filter_var($_POST['question_id'.$edit_question_num.''],FILTER_SANITIZE_STRING);
        $question          = filter_var($_POST['question'.$edit_question_num.''],FILTER_SANITIZE_STRING);
        $conn = db_conn();
        $sql = "UPDATE `questions` SET `question` = '$question' WHERE `question_id` = '$q_id';";
        $stmt = mysqli_query($conn,$sql);
        if(!$stmt){
            header("location:../main.php?error=Something wrong!");
        }
        header("location:../main.php?success=1 Question updated!");
        
    }
    
    if(isset($_POST['edit-all-question'])){  
        $num_of_question = filter_var($_POST['number_of_question'],FILTER_SANITIZE_STRING);
        $sanitize_data = [];
        for($i = 1; $i <= $num_of_question; $i++){
            $question_id = filter_var($_POST["question_id".$i.""],FILTER_SANITIZE_STRING);
            $question = filter_var($_POST["question".$i.""],FILTER_SANITIZE_STRING);
            $data = ['question_id' => $question_id, 'question' => $question];
            array_push($sanitize_data, $data);
            
        }
        $conn = db_conn();
        for($i=0; $i<$num_of_question; $i++){
            $question_id = $sanitize_data[$i]['question_id'];
            $question    = $sanitize_data[$i]['question'];
            $query = "UPDATE `questions` SET `question` = '$question' WHERE `question_id` = '$question_id';";
            $stmt = mysqli_query($conn,$query);
            if(!$stmt){
                header("location:../main.php?error=Something wrong!");
            }
        }
            mysqli_close($conn);
            header("location:../main.php?success=All questions updated!");
        }
?>