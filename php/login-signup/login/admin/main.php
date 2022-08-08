<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']['account_type'] === 'admin'){
?>
<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Splus-Learning</title>
<link rel = 'stylesheet' type = 'text/css' href = '../../../../icon/fontawesome-free-5.13.0-web/css/all.css'>
<link rel = 'stylesheet' type = 'text/css' href = '../../../../css/bootstrap.min.css'>
<link rel = 'stylesheet' type = 'text/css' href = '../../../../css/style.css'>
<style>
    body {
        /* background:#0000; */
        background:url("../../../../img/morning-nature.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
</style>

<script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
<script src = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'></script>
<script src = '../../../../js/signup-validate.js'></script>
<script src = '../../../../js/alert-message.js'></script>

</head>
<body>
<?php
    include( '../../../../include/navbar-for-user.php' );
    include('../../../../include/database_connection.php');
?>
<div class="container-fluid">
    <div class="container-fluid bg-light sticky-top radius-bottom box font-cambria-math">
        <nav class="navbar navbar-expand-lg bg-light navbar-light">
            <div class="d-lg-none col-4 float-left">
                <div class="navbar-brand font-cambria-math">
                    <strong class="text-dark font-cambria">Dashboard</strong>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collabsibleNavbar">
                <span class="navbar-toggler-icon">
                    <!-- m,  <div class="line1"></div>
                    <divk class="line2"></div>
                    <div class="line3"></div> -->
                </span>
            </button>
            <div class="col-md-12 collapse navbar-collapse navbar-dark " id="collabsibleNavbar">
                <ul class="navbar-nav  px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?topics" class="<?php if(isset($_GET['topics']) || isset($_POST['question_field_genrate'])){ echo 'text-primary';}else{ echo "text-dark ";}?>" style="text-decoration:none;"><i class="fas fa-envelope mr-1"></i>Topic</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?modification" class=" <?php if(isset($_GET['modification']) || isset($_GET['td']) || isset($_GET['add_q'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-address-card mr-1"></i>Modification</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?users" class=" <?php if(isset($_GET['users'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-users mr-1"></i>Users</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?ranking" class="<?php if(isset($_GET['ranking'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-signal mr-1"></i>Ranking</a>
                    </li>
                </ul>

                <ul class="navbar-nav px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?add_account" class=" <?php if(isset($_GET['add_account'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-plus mr-1"></i>Add Admin</a>
                    </li>
                </ul>

                <ul class="navbar-nav px-3 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?exam" class=" <?php if(isset($_GET['exam'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-play mr-1"></i>Exam</a>
                    </li>
                </ul>

                <ul class="navbar-nav px-3 mt-2 mt-lg-0 mr-lg-auto">
                    <li class="nav-item">
                        <a href="main.php?profile=<?php echo $_SESSION['login']['id'];?>" class=" <?php if(isset($_GET['profile']) || isset($_POST['profile_update']) || isset($_GET['passUpdate']) || isset($_POST['changeMyPass'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-user mr-1"></i>Profile</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-lg-auto d-none d-lg-block">
                    <li class="nav-item">
                        <strong>Dashboard</strong>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <?php
    if(isset($_GET['success']) or isset($_GET['error']) or isset($_GET['warning'])){
        echo '<div id="alert" class="fixed-top position-relative">';
            if(isset($_GET['success'])){
                echo "<script> successAlert('".$_GET['success']."');</script>";
            }
            if(isset($_GET['error'])){
                echo "<script> dangerAlert('".$_GET['error']."');</script>";
            }
            if(isset($_GET['warning'])){
                echo "<script> warningAlert('".$_GET['warning']."');</script>";
            }
        echo '</div>';
        }
    ?>
    <!-- Content container -->
    <div class="container h-100vh">
        <?php if(!(isset($_GET['topic']) || isset($_GET['modification']) || isset($_GET['users']) || isset($_GET['ranking']) || isset($_GET['td']) || isset($_GET['add_account']) || isset($_GET['add_q']) || isset($_POST['showQNA']) || isset($_GET['open_option']) || isset($_GET['exam']) || isset($_GET['profile']) || isset($_GET['passUpdate']) || isset($_POST['changeMyPass']))){
         ?> 

            <!-- Topic area -->
            <div <?php if(!isset($_POST['question_field_genrate'])){ echo 'class="d-flex justify-content-center align-items-center"';}?> id="home">
                <?php if(!isset($_POST['question_field_genrate'])) {?>
                     <div class="jumbotron w-100 box-shadow-black">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' class="form-block was-validated">
                            <input autocomplete='off' type="text" name="t-name" placeholder="Write your topic name.." class="form-control mt2" required>
                            <input autocomplete='off' type="number" name="num_of_question" placeholder="How many question you want to add.?" class="form-control mt-2" required>
                            <input autocomplete='off' type="text" name="tag" placeholder="Enter your tags..." class="form-control mt-2" required>
                            <textarea name="discription" id="" cols="30" rows="3" placeholder="Write topic Discription.." class="form-control mt-2" required></textarea>
                            <input type="submit" name='question_field_genrate' value="Genrate" class="btn btn-primary btn-block mt-3">
                        </form>
                    </div>
        <?php }?>

        
            <!-- Topic area -->
            <?php if(isset($_POST['question_field_genrate'])){
                include("./pages/question_gen.php");
             } ?>
            </div>
         <?php
         }
        ?>
        <?php
        
        if(isset($_GET['modification'])){?>

           <!-- Modification area -->
           <div class='mt-4'><div class="w-100">
                <?php include('./pages/topics-modification.php');?>
            </div></div>
        <?php
        }if(isset($_GET['td'])){?>

            <!-- Modification area -->
            <div class="d-flex justify-content-center align-items-center" id="home"><div class="bg-light box p-2 mb-5 w-100">
                 <?php include('./pages/topics-details.php');?>
             </div></div>
            <?php
        }if(isset($_GET['add_q'])){
            // Adding more question?>

            <!-- Modification area -->
            <div class='mt-4'><div class="row bg-light box p-2 mb-5 w-100">
                 <?php include('./pages/add-more-question.php');?>
             </div></div>
            <?php
        } if(isset($_POST['showQNA'])){?>

            <!-- show questions -->
            <div class="mt-5"><div class="box-shadow-black bg-light px-2 px-md-3 w-100">
                 <?php include('./pages/show-questions.php');?>
             </div></div>
         <?php
         } if(isset($_GET['open_option'])){?>
            <!-- //  show options -->
            <div class="d-flex justify-content-center align-items-center" id="home"><div class="box-shadow-black bg-light px-2 px-md-3 w-100">
                 <?php include('./pages/show-option.php');?>
             </div></div>
        <?php }
        

        if(isset($_GET['users'])){
            // Users Area
            include("pages/users.php");
        }?>
        

    
        <?php
        if(isset($_GET['ranking'])){?>
            <!-- ranking area -->
            <div class='container'>
              <div class="mt-5">
                 <?php include("../../../../include/user-ranking.php");?>
              </div>
            </div>
        <?php 
        }?>

    <?php
    // admin account add section
        if(isset($_GET['add_account'])){
            include("pages/add-admin.php");
        }
    ?>
    <!-- Exam Area -->
<?php
    if(isset($_GET['exam'])){
        include("pages/exam-start.php");
    }


    // Profile Area
    if(isset($_GET['profile']) || isset($_POST['profile_update']) || isset($_GET['passUpdate']) || isset($_POST['changeMyPass'])){
        include("../../../../include/profile.php");
    }
?>
    </div>
</div>




<!-- Deactivate user -->
<?php
            if(isset($_POST['d'])){
                $conn = db_conn();
                $id = $_POST['d'];
                $sql = "SELECT * FROM `user` WHERE `id`='$id';";
                $status = mysqli_query($conn,$sql);
                if(!$status){
                    echo "<script>window.location.href='main.php?warning=You have enterd invalid id';</script>";
                }
                $rows = mysqli_fetch_assoc($status);
                if($rows['email'] == 'satyamishra559@gmail.com'){
                    echo "<script>window.location.href='main.php?warning=Sorry This is root account!';</script>";
                }else{
                    if($rows['status'] == 'active'){
                        $sql = "UPDATE `user` SET `status` = 'deactive' WHERE `id`='$id';";
                        $status = mysqli_query($conn,$sql);
                        if(!$status){
                            echo "<script>window.location.href='main.php?error=You have enterd invalid id';</script>";
                        }else{
                            echo "<script>window.location.href='main.php?users';</script>";
                        }
                    }else if($rows['status'] == 'deactive'){
                        $sql = "UPDATE `user` SET `status` = 'active' WHERE `id`='$id';";
                        $status = mysqli_query($conn,$sql);
                        if(!$status){
                            echo "<script>window.location.href='main.php?error=You have enterd invalid id';</script>";
                        }else{
                            echo "<script>window.location.href='main.php?users';</script>";
                        }
                    }
                }
            }


// Exam status change
if(isset($_POST['exam_status'])){
    $conn = db_conn();
    $topic_id = filter_var($_POST['topic_id'], FILTER_SANITIZE_STRING);
    echo $topic_id;
    $sql = "SELECT `topic_id`,`status` FROM `topics` WHERE `topic_id` = '$topic_id';";
    $obj = mysqli_query($conn,$sql);
    if(mysqli_num_rows($obj) == 0){
        echo "<script>window.location.href='main.php?error=Error: Unexpected data!;</script>";
    }
    else{
        $rows = mysqli_fetch_assoc($obj);
        $status = $rows['status'];
        $topic_id = $_POST['topic_id'];
        echo $status;
        if($status == 'active'){
            $obj = mysqli_query($conn, "UPDATE `topics` SET `status` = 'deactive' WHERE `topic_id` = '$topic_id';");
        }else if($status == 'deactive'){
            $obj = mysqli_query($conn, "UPDATE `topics` SET `status` = 'active' WHERE `topic_id` = '$topic_id';");
        }
        if($obj){
            echo "<script>window.location.href='main.php?modification;</script>";
        }
    }
    echo "<script>window.location.href='main.php?modification';</script>";
}
        ?>





<?php //if(!(isset($_POST['question_field_genrate']) || isset($_GET['add_account']) || isset($_GET['add_q']) || isset($_POST['showQNA']) || isset($_GET['profile']) || isset($_GET['passUpdate']))){?>
<!-- <div class="bg-black"> -->
    <?php
        // include( '../../../../include/copyright.php' );
    ?>
<!-- </div> -->
<?php// }?>
</body>
</html>
<?php
}else{
    echo "<script>window.location.href='../../../../index.php';</script>";
    
    // header("location:../../../../index.php");
}
?>