<?php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login']['account_type'] === 'user'){
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
        background:url("../../../../img/nature.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
    #home-page-opacity::after{
        content: '';
        position:absolute;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        background: #000;
        opacity: .3;
        z-index: -1;
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
// Header
     include( '../../../../include/navbar-for-user.php' );
     include( '../../../../include/database_connection.php' );
     if(isset($_GET['success']) or isset($_GET['error']) or isset($_GET['warning'])){
        echo '<div id="alert" class="fixed-top position-absolute mt-5">';
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
                <ul class="navbar-nav px-4 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?home" class=" <?php if(isset($_GET['home'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-home mr-1"></i>Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-4 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?exam" class=" <?php if(isset($_GET['exam'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-play mr-1"></i>Exam</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-4 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?ranking" class="<?php if(isset($_GET['ranking'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-signal mr-1"></i>Ranking</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-4 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a href="main.php?users" class=" <?php if(isset($_GET['users'])){ echo 'text-primary';}else{ echo "text-dark";}?>" style="text-decoration:none;"><i class="fas fa-users mr-1"></i>Users</a>
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
// Home area
if(isset($_GET['home'])  || !(isset($_GET['home']) || isset($_GET['exam']) || isset($_GET['ranking']) || isset($_GET['users']) || isset($_GET['profile']) || isset($_GET['passUpdate']) || isset($_POST['changeMyPass']))){
    echo "<div class='d-flex justify-content-center align-items-center' id='home-page-opacity' style='height:84.5vh;'>
        <div class='position-relative'>
            <div class='col-12 text-center h1 text-capitalize text-light font-weight-bold font-cambria' style='letter-spacing:3px;'>Most Welcome in this pletform!</div>
            <div class='col-12 text-center text-orange font-weight-bold style='letter-spacing:2px;''>After admin start exam you'll able to do exam for any specific topic..!</div>
        </div>
    </div>";
}

// Exam Area 
if(isset($_GET['exam'])){
    echo "<div class='mt-5 mx-3 mx-md-5'>";
    include("../admin/pages/exam-start.php");
    echo "<div>";
}

// Ranking area
if(isset($_GET['ranking'])){
    echo "<div class='mt-5 mx-3 mx-md-5'>";
    include("../../../../include/user-ranking.php");
echo "</div>";
}

// Users showing area
if(isset($_GET['users'])){
    echo "<div class='mx-3 mx-md-5'>";
        include("../admin/pages/users.php");
    echo "</div>";
}

// Profile Area
if(isset($_GET['profile']) || isset($_POST['profile_update']) || isset($_GET['passUpdate']) || isset($_POST['changeMyPass'])){
    echo "<div class='container'>";
    include("../../../../include/profile.php");
    echo "</div>";
}

?>





<!-- Footer -->

</body>
</html>
<?php
}else{
    header("location:../../../../index.php");
}
?>

<?php 
// if(isset($_GET['home'])){?>
<!-- <div class="bg-black"> -->
<?php
//  include("../../../../include/copyright.php");
 ?>
<!-- </div> -->
<?php 
// }?>