<?php
if(isset($_POST['add-question']) or isset($_POST['add-new-question'])){
    function validData($arg){
        foreach ($arg as $key => $value) {
            if($value == ''){
                header("location:../main?warning=All field required!");
            }
        }
    }

    function sanitizeData($arg){
        $data = [];
        $numberQNA = $arg['number-qna'];
        
       if(!isset($arg['add-new-question'])){
            $topicName = filter_var($arg['topic-name'],FILTER_SANITIZE_STRING);
            $tag = filter_var($arg['tag'],FILTER_SANITIZE_STRING);
            $dis = filter_var($arg['discription'],FILTER_SANITIZE_STRING);
            $qnaNumber = filter_var($arg['number-qna'],FILTER_SANITIZE_STRING);
            $topicDetails = [
                't-name' => $topicName,
                'tag' => $tag,
                'dis' => $dis,
                'qnaNumber' => $qnaNumber
            ];
       }else if(isset($arg['add-new-question'])){
            $topicId = filter_var($arg['topic-id'],FILTER_SANITIZE_STRING);
            $qnaNumber = filter_var($arg['number-qna'],FILTER_SANITIZE_STRING);
            $topicDetails = [
                'add-new-question' => 'new-question',
                'topic_id' => $topicId,
                'qnaNumber' => $qnaNumber
            ];
       }
        array_push($data, $topicDetails);

        for($i=1; $i<=$numberQNA; $i++){
            $question = filter_var($arg['q'.$i], FILTER_SANITIZE_STRING);
            $opt1 = filter_var($arg['o1'.$i], FILTER_SANITIZE_STRING);
            $opt2 = filter_var($arg['o2'.$i], FILTER_SANITIZE_STRING);
            $opt3 = filter_var($arg['o3'.$i], FILTER_SANITIZE_STRING);
            $opt4 = filter_var($arg['o4'.$i], FILTER_SANITIZE_STRING);
            $ans = filter_var($arg['answer'.$i], FILTER_SANITIZE_STRING);
            $sanitizeData = [
                'q'.$i => $question, 
                'o1'.$i => $opt1,
                'o2'.$i => $opt2,
                'o3'.$i => $opt3,
                'o4'.$i => $opt4,
                'answer'.$i => $ans,
            ];
            array_push($data, $sanitizeData);
        }

        return $data;
    }

    function insertData($arg){  
        include("../../../../../include/database_connection.php");
        $conn = db_conn();

        if(!isset($arg[0]['add-new-question'])){
            $t_name = $arg[0]['t-name'];
            $tag    = $arg[0]['tag'];
            $dis    = $arg[0]['dis'];
            $qnaNumber = $arg[0]['qnaNumber'];

                    // Topic Insert
            $sql = "INSERT INTO `topics` (`name`,`discription`,`tag`) VALUES (?,?,?);";
            $stmt = mysqli_prepare($conn,$sql);
            if(!$stmt){ header("location:../main.php?error=Opps! Somthing wrong.");}
            mysqli_stmt_bind_param($stmt,'sss',$t_name,$dis,$tag);
            $stmt_result = mysqli_stmt_execute($stmt);
            if($stmt_result){ header("location:../main.php?error=Somthing wrong from server!");}
            mysqli_stmt_close($stmt);



            // // topic id fetching section
            $sql = "SELECT `topic_id` FROM `topics`";
            $obj = mysqli_query($conn,$sql);
            if(!$obj){header("location:../main.php?error=Somthing wrong from server!");}
            $number_of_rows = mysqli_num_rows($obj);
            $counter = 1;
            while($rows = mysqli_fetch_assoc($obj)){
                if($number_of_rows == $counter){
                    $t_id = $rows['topic_id'];
                }
                $counter += 1;
            }
        }else if(isset($arg[0]['add-new-question'])){
            $t_id = $arg[0]['topic_id'];
            $qnaNumber = $arg[0]['qnaNumber'];

        }
   
        // echo "<pre>";
        // print_r($arg);
        // echo "</pre>";
        for($i=1; $i<=$arg[0]['qnaNumber']; $i++){
            // Inserting QUestion 
            $sql = "INSERT INTO `questions` (`question`,`topic_id`) VALUES (?,?);";
            $stmt = mysqli_prepare($conn,$sql);
            if(!$stmt){ header("location:../main.php?error=Opps! Somthing wrong.");}
            mysqli_stmt_bind_param($stmt,'si',$arg[$i]['q'.$i],$t_id);
            $stmt_result = mysqli_stmt_execute($stmt);
            if($stmt_result){ header("location:../main.php?error=Somthing wrong from server!");}
            mysqli_stmt_close($stmt);

            //Fetching Question id
            $sql = "SELECT `question_id` FROM `questions`";
            $obj = mysqli_query($conn,$sql);
            if(!$obj){header("location:../main.php?error=Somthing wrong from server!");}
            $counter = 1;
            $number_of_rows = mysqli_num_rows($obj);
            while($rows = mysqli_fetch_assoc($obj)){
                if($number_of_rows == $counter){
                    $q_id = $rows['question_id'];
                }
                $counter += 1;
            }

        //     // Inserting Options
            $sql = "INSERT INTO `options` (`opt1`,`opt2`,`opt3`,`opt4`,`question_id`) VALUES (?,?,?,?,?);";
            $stmt = mysqli_prepare($conn,$sql);
            if(!$stmt){ header("location:../main.php?error=Opps! Somthing wrong.");}
            mysqli_stmt_bind_param($stmt,'ssssi',$arg[$i]['o1'.$i],$arg[$i]['o2'.$i],$arg[$i]['o3'.$i],$arg[$i]['o4'.$i],$q_id);
            $stmt_result = mysqli_stmt_execute($stmt);
            if($stmt_result){ header("location:../main.php?error=Somthing wrong from server!");}
            mysqli_stmt_close($stmt);

             // Inserting answer
             $sql = "INSERT INTO `answers` (`answer`,`question_id`) VALUES (?,?);";
             $stmt = mysqli_prepare($conn,$sql);
             if(!$stmt){ header("location:../main.php?error=Opps! Somthing wrong.");}
             mysqli_stmt_bind_param($stmt,'si',$arg[$i]['answer'.$i],$q_id);
             $stmt_result = mysqli_stmt_execute($stmt);
             if($stmt_result){ header("location:../main.php?error=Somthing wrong from server!");}
             mysqli_stmt_close($stmt);
        }

       header("location:../main.php?success=".$qnaNumber." Question successfully added!");
    }


// Validate data function
validData($_POST);

// sanitize data function
$sanitizeData = sanitizeData($_POST);
// inserting data into database function
insertData($sanitizeData);
}

?>