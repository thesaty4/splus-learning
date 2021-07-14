
<div class="row ml-auto mr-auto bg-light w-100 p-2 mt-5 box">
    <div class="col-12"><a href="main.php" class="close text-danger" aria-label="close">&times;</a></div><br><br>
    <div class="col-12"><?php 
        foreach ($_POST as $key => $value) {
            if($value == ''){
                echo "<script>window.location.href='main.php?warning=All field Required!';</script>";
            }
        }
        

        // if(isset($_POST)){
        //     echo "<script>window.location.href='main.php?warning=Number of question to small!;</script>";
        // }
        // echo "<script>
        //     var NumOfQuestion = ".$_POST['num_of_question']."; 
        //     alert('hellos');
        //     if(NumOfQuestion.length() <= 0){
        //         window.location.href='main.php?warning=Number of question to small!;
        //     }
        //     </script>";

        $num_of_question = $_POST['num_of_question'];
        if($num_of_question <= 0){
            echo "<script>window.location.href='main.php?warning=Warning : Number of question to small!';</script>";
        }else if($num_of_question > 100){
            echo "<script>window.location.href='main.php?warning=Warning : You can add only 100 Question in 1 attempt';</script>";
        }
        // $_SERVER['PHP_SELF']
        echo '<form action="pages/question_add.php" method="post" class="form-block was-validated">';
        for($i=1; $i <= $num_of_question; $i++){
            ?>
               <strong>Question : </strong> <?php echo $i;?>
               <input type="text" name='<?php echo "q".$i; ?>' placeholder='<?php echo $i." Write Question.."?>' class='form-control mt-2'  required> 
               <input type="text" name='<?php echo "o1".$i; ?>' placeholder='<?php echo " Option : A"?>' class='form-control mt-1'  required> 
               <input type="text" name='<?php echo "o2".$i; ?>' placeholder='<?php echo " Option : B"?>' class='form-control mt-1'  required> 
               <input type="text" name='<?php echo "o3".$i; ?>' placeholder='<?php echo " Option : C"?>' class='form-control mt-1'  required> 
               <input type="text" name='<?php echo "o4".$i; ?>' placeholder='<?php echo " Option : D"?>' class='form-control mt-1'  required>
               <select name="<?php echo 'answer'.$i;?>" class='form-control mt-1' required>
                    <option value="">Select Answer</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
               </select><br>
            <?php
        }
        if(!isset($_POST['add-new-question'])){
        ?>
                <input type="text" name='topic-name' value="<?php echo $_POST['t-name'];?>" hidden>
                <input type="text" name='tag' value="<?php echo $_POST['tag'];?>" hidden>
                <input type="text" name='discription' value="<?php echo $_POST['discription'];?>" hidden>
        <?php }else{
        echo    "<input type='text' name='add-new-question' value='new-question' hidden>";
        echo    "<input type='number' name='topic-id' value='".$_POST['topic-id']."' hidden>";
        } ?>
                <input type="text" name='number-qna' value="<?php echo $num_of_question;?>" hidden>
                <input type="submit" name='add-question' value='Add' class='btn btn-primary btn-block'>
        <?php
        echo '</form>';?>
    </div>
</div>


<?php
    if(isset($_POST['question_field_genrate'])){    
    }
?>