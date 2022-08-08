<?php
 echo "<pre>";
 print_r($_POST);
 echo "</pre>";
 if(isset($_POST)){
     include("../include/database_connection.php");
     $conn = db_conn();
     $num_rating = $_POST['num-rating'];
     $id         = $_POST['id'];
     $review     = filter_var($_POST['review'],FILTER_SANITIZE_STRING);
     $sql = "INSERT INTO  `review` (`id`,`rating`,`review`) VALUES (?,?,?)";
     $stmt = mysqli_prepare($conn,$sql);
     mysqli_stmt_bind_param($stmt,'iss',$id,$num_rating,$review);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     echo "<script>window.location.href='../index.php?success= Thanks for giving your review!#review ';</script>";
    //  header("location:../index.php?success= Thanks for giving your review!#review ");
 }
?>