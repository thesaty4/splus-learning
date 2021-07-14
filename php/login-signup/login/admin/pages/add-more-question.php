<?php
$conn = db_conn();
$topic_id = filter_var($_GET['add_q'],FILTER_SANITIZE_STRING);
$query = "SELECT * FROM `topics` WHERE `topic_id`='$topic_id';";
$rslt = mysqli_query($conn,$query);
if(mysqli_num_rows($rslt) == 0){
    echo "<script>window.location.href='main.php?error=Error : Unexpected input!'</script>";
}
?>

<div class="col-10 font-weight-bold">Adding Question</div>
<div class="col-2"><a href="main.php?modification" class='close'>&times;</a></div>

<div class="col-12">
    <form action="main.php" method='post' class='form-block my-lg-4 my-3 was-validated'>
        <input type="number" name='topic-id' value="<?php echo $topic_id;?>" hidden>
        <input type="text" name='add-new-question' value='new-questions' hidden>
        <input type="number" name='num_of_question' placeholder='How many question you want to add?' class='form-control' required>
        <input type="submit" name="question_field_genrate" value='Genrate' class='btn btn-dark mt-3'>
    </form>
</div>