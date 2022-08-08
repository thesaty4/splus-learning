<?php
if(isset($_POST['option-edit'])){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $q_id = filter_var($_POST['question_id'],FILTER_SANITIZE_STRING);
    $opt1 = filter_var($_POST['opt1'],FILTER_SANITIZE_STRING);
    $opt2 = filter_var($_POST['opt2'],FILTER_SANITIZE_STRING);
    $opt3 = filter_var($_POST['opt3'],FILTER_SANITIZE_STRING);
    $opt4 = filter_var($_POST['opt4'],FILTER_SANITIZE_STRING);
    $answer = filter_var($_POST['answer'],FILTER_SANITIZE_STRING);
    include("../../../../../include/database_connection.php");
    $conn = db_conn();
    $sql = "UPDATE `options` SET `opt1` = ? , `opt2` = ? , `opt3` = ? , `opt4` = ? WHERE `question_id` = ?;";
    $stmt = mysqli_prepare($conn,$sql);
    if(!$stmt){
        echo "<script>window.location.href='../main.php?error=Error : Somthing wrong!';</script>";
        
        // header("location:../main.php?error=Error : Somthing wrong!");
    }
    mysqli_stmt_bind_param($stmt,'sssss',$opt1,$opt2,$opt3,$opt4,$q_id);
    $rslt = mysqli_stmt_execute($stmt);
    if(!$rslt){
        echo "<script>window.location.href='../main.php?error=Error : Somthing wrong!';</script>";
        // header("location:../main.php?error=Error : Somthing wrong!");
    }
    $sql = "UPDATE `answers` SET `answer` = ? WHERE `question_id` = ?;";
    $stmt = mysqli_prepare($conn,$sql);
    if(!$stmt){
        echo "<script>window.location.href='../main.php?error=Error : Somthing wrong!';</script>";
        // header("location:../main.php?error=Error : Somthing wrong!");
    }
    mysqli_stmt_bind_param($stmt,'ss',$answer,$q_id);
    $rslt = mysqli_stmt_execute($stmt);
    if(!$rslt){
        echo "<script>window.location.href='../main.php?error=Error : Somthing wrong!';</script>";
        // header("location:../main.php?error=Error : Somthing wrong!");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    echo "<script>window.location.href='../main.php?success=Options updated successfull!';</script>";
    // header("location:../main.php?success=Options updated successfull!");
}else{
    echo "<script>window.location.href='../main.php?error=Error : Unautorized !';</script>";
    // header("location:../main.php?error=Error : Unautorized ! ");
}
?>