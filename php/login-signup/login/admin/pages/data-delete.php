<?php
session_start();
if(isset($_GET['dt']) and $_SESSION['login']['email'] === 'satyamishra559@gmail.com'){
    $topic_id = $_GET['dt'];
    include("../../../../../include/database_connection.php");
    $conn = db_conn();
    $query = "SELECT `topic_id` FROM `topics` WHERE `topic_id`='$topic_id';";
    $obj = mysqli_query($conn,$query);
    if(mysqli_num_rows($obj) == 0){
        echo "<script>window.location.href='../main.php?error=Unexpected input!';</script>";

        // header("location:../main.php?error=Unexpected input!");
    }
    $rows = mysqli_fetch_assoc($obj);
    $topic_id = $rows['topic_id'];

    $sql = "SELECT `question_id` FROM `questions` WHERE `topic_id`='$topic_id'";
    $obj = mysqli_query($conn,$sql);

    
    while($rows = mysqli_fetch_assoc($obj)){
        // // Deleting answers
        $q_id = $rows['question_id'];
        // echo $q_id."<br>";
        $del_ans = "DELETE FROM `answers` WHERE `question_id` = '$q_id';";
        $status = mysqli_query($conn,$del_ans);
        if(!$status){
            echo "<script>window.location.href='../main.php?error=Unexpected result!';</script>";
            
            // header("location:../main.php?error=Unexpected result!");
        }
        
        // Deleting options
        $del_opt = "DELETE FROM `options` WHERE `question_id` = '$q_id';";
        $status = mysqli_query($conn,$del_opt);
        if(!$status){
            echo "<script>window.location.href='../main.php?error=Unexpected result!';</script>";
            // header("location:../main.php?error=Unexpected result!");
        }
        
    }
    
    
    $del_que = "DELETE FROM `questions` WHERE `topic_id` = '$topic_id';";
    $status = mysqli_query($conn,$del_que);
    if(!$status){
        echo "<script>window.location.href='../main.php?error=Unexpected result!';</script>";
        // header("location:../main.php?error=Unexpected result!");
    }
    
    // exam status deleting
    mysqli_query($conn,"DELETE FROM `exam_status` WHERE `topic_id` = '$topic_id';");
    
    // Deleting topics
    $del_topic = "DELETE FROM `topics` WHERE `topic_id` = '$topic_id';";
    $status = mysqli_query($conn,$del_topic);
    if(!$status){
        echo "<script>window.location.href='../main.php?error=Unexpected result!';</script>";
        // header("location:../main.php?error=Unexpected result!");
    }
    
    echo "<script>window.location.href='../main.php?success=Topic Deleted!';</script>";
    // header("location:../main.php?success=Topic Deleted!");
}else{
    echo "<script>window.location.href='../main.php?error=Warning : Only root Account can delete anything.';</script>";
    // header("location:../main.php?error=Warning : Only root Account can delete anything.");

}
?>