<?php
if(isset($_POST['topic_update'])){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    foreach ($_POST as $key => $value) {
        if($value == ''){
            header("location:../main.php?warning= All field required!");
        }
    }
    include("../../../../../include/database_connection.php");
    $conn = db_conn();
    $topic_name = $_POST['t-name'];
    $topic_id = $_POST['t-id'];
    $topic_disc = $_POST['t-disc'];
    $topic_tag = $_POST['t-tag'];
    $sql = "UPDATE `topics` SET `name` = '$topic_name', `discription` = '$topic_disc' , `tag`='$topic_tag' WHERE `topic_id` = '$topic_id'";
    $status = mysqli_query($conn,$sql);
    $stmt = mysqli_prepare($conn,$sql);
    if(!$stmt){
        header("location:../main.php?error=Opps! somthing wrong..");
    }
    mysqli_stmt_bind_param($stmt,'si',$topic_name,$topic_id);
    $status = mysqli_stmt_execute($stmt);
    if(!$status){
        header("location:../main.php?error=Opps! somthing wrong..");
    }
    header("location:../main.php?success=Topic Updated..!");
}
?>