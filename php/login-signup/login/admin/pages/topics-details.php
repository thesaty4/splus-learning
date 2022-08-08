<?php
$conn = db_conn();
$topic_id = $_GET['td'];
$query = "SELECT * FROM `topics` WHERE `topic_id`='$topic_id'";
$num_of_que = "SELECT `question_id` FROM `questions`;";
$number_of_rows_obj = mysqli_query($conn,$num_of_que);
if(!$number_of_rows_obj){
    echo "<script>window.location.href='main.php?error=Opps! somthing wrong';</script>";
    
    // header("location:main.php?error=Opps! somthing wrong");
}
$n_o_q = mysqli_num_rows($number_of_rows_obj);
$status = mysqli_query($conn,$query);
if(!$status){
    echo "<script>window.location.href='main.php?error=Opps! somthing wrong';</script>";
    // header("location:main.php?error=Opps! somthing wrong");
}
echo "<div class='row p-2 font-cambria'>
        <div class='col-12 d-flex mb-md-4'>
            <div class='col-10 font-weight-bold font-cambria pl-5'>Topic Details</div>
            <div class='col-2 mb-2'><a href='main.php?modification' class='close text-danger pr-2'>&times;</a></div>
        </div>
    ";
while ($rows = mysqli_fetch_assoc($status)) {
    echo "<form action='pages/update_data.php' method='post' class='was-validated'><input type='text' name='t-id' value='".$rows['topic_id']."' hidden><div class='row w-100 ml-md-5 ml-2'>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-edit'></i> Topic Name : </div>
            <div class='col-lg-10 text-capitalize mb-3'><input name='t-name' value='".$rows['name']."' class='px-2' required></div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-edit'></i> Tag : </div>
            <div class='col-lg-10 text-capitalize mb-3'><input name='t-tag' value='".$rows['tag']."' class='px-2' required></div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-edit'></i> Discription : </div>
            <div class='col-lg-10 text-capitalize mb-3'><input name='t-disc' value='".$rows['discription']."' class='px-2' required></div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-edit'></i> Question No : </div>
            <div class='col-lg-10 text-capitalize mb-3'>".$n_o_q."</div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-laptop'></i> Exam status : </div>
            <div class='col-lg-10 text-capitalize mb-3'>".$rows['status']."</div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-clock'></i> Creating Time : </div>
            <div class='col-lg-10 text-capitalize mb-3'>".$rows['c_time']."</div>
            <div class='col-lg-2 font-weight-bold'><i class='fas fa-calendar'></i> Creating Date : </div>
            <div class='col-lg-10 text-capitalize'>".$rows['c_date']."</div>
            <div class='col-12 mt-4'><button type='submit' name='topic_update' class='btn btn-primary'><i class='fas fa-edit'></i> Update</button></div>
          </div>";
}
echo "</div></form>"

?>