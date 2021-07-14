<?php
if(isset($_POST['showQNA'])){
    function showError(){
        header("location:main.php?warning=ERROR: Unexpected user");
    }
    // print_r($_POST);
    $conn = db_conn();
    $topic_id = filter_var($_POST['topic_id'],FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM `topics` WHERE `topic_id`='$topic_id';";
    $obj = mysqli_query($conn,$sql);
    if(mysqli_num_rows($obj) == 0){
        showError();
    }

    $sql = "SELECT * FROM `questions` WHERE `topic_id`='$topic_id';";
    $obj = mysqli_query($conn,$sql);
    if(mysqli_num_rows($obj) == 0){
        echo "<center>0 Record Found!</center>";
    }
    echo "<div class='row p-2'><div class='col-6 text-left'><a href='main.php?modification'><i class='fas fa-backward text-dark'></i></a></div><div class='col-6 text-right'><a href='main.php?modification' class='close text-danger'>&times;</a></div></div>";
    echo "<div class='table-responsive text-center'><table class='table table-striped'>";
    echo "<tr class='bg-dark text-light'>
            <th>#</th><th>Questions</th><th>Options</th><th>Edit</th>
    </tr>";
    $counter = 1;

    echo "<form action='pages/edit-question.php' method='post'>";
    while($rows = mysqli_fetch_assoc($obj)){
        echo "<tr>
        <input type='text' name='question_id".$counter."' value='".$rows['question_id']."' hidden>
        <td> ".$counter."</td> 
        <td> <input type='text' name='question".$counter."' value='".$rows['question']."' class='form-control'></td> 
        <td> <a href='main.php?open_option=".$rows['question_id']."&&t_id=".$topic_id."' class='text-dark'><i class='fas fa-folder-open'></i></td> 
        <td> <button type='submit' name='edit-question' value='".$counter."' class='button-none'><i class='fas fa-edit'></i></button> </td> 
        </tr>";
        $counter += 1;
    }
    echo "</table></div>";    
    $counter -= 1;
    echo "<input type='number' name='number_of_question' value='".$counter."' hidden>
            <button type='submit' name='edit-all-question' class='btn btn-block btn-dark mb-2'><i class='fas fa-recycle'></i> Update All</button>";
    echo "</form>";

}else{
    header("location:main.php?warning=ERROR: Unexpected user!");
}
?>