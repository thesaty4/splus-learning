<?php
if(isset($_POST['review-delete'])){
    include("../include/database_connection.php");
    $sql = "DELETE FROM `review` WHERE `id`=?";
    $conn = db_conn();
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$_POST['id']);
    mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    echo "<script>window.location.href='../index.php?success=Your Review,Like or Dislike, heart are deleted!#review';</script>";

    // header("location:../index.php?success=Your Review,Like or Dislike, heart are deleted!#review");

}else if(isset($_POST['edit-review'])){
    include("../include/database_connection.php");
    $conn = db_conn();

    $review = filter_var($_POST['update-review'],FILTER_SANITIZE_STRING);
    $id     = $_POST['id'];
    echo $review;
    echo $id;
    $sql = "UPDATE `review` SET `review` = ? WHERE `id` = ?;";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'si',$review,$id);
    mysqli_stmt_execute($stmt);
    mysqli_close($conn);
    echo "<script>window.location.href='../index.php?success=Review Updated successfull!#review';</script>";

    // header("location:../index.php?success=Review Updated successfull!#review");

    // echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
}else{
    echo "<script>window.location.href='../index.php?error=You can't access this page#review';</script>";

    // header("location:../index.php?error=You can't access this page#review");
}
?>