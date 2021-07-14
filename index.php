<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splus Learning</title>
    <link rel="stylesheet" type="text/css" href="./icon/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap-js/.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="./js/main-page.js"></script>
    <script src="./js/alert-message.js"></script>
    <style>
        /* .home-page-opacity::after{
            content: '';
            position:absolute;
            top:0;
            left:0;
            width: 100%;
            height: 100%;
            background: #000;
            opacity: .7;
            z-index: -1;
        } */
     
    </style>
</head>
<body onload='load();'>

<!--CSS Spinner-->
<div class="spinner-wrapper bg-white" id='load'>
   <div class="spinner"></div>
</div>
<script>
function load(){
    document.getElementById("load").style.display='none';
}
</script>
<!-- ---------------------------------------------------header GET request handling area -------------------------------------------------- -->
<?php
include("./include/database_connection.php");
$conn = db_conn();
$sql = "SELECT * FROM `visiter`";
$obj = mysqli_query($conn,$sql);
$value = mysqli_fetch_assoc($obj);

$sql = "UPDATE `visiter` SET `num_visiter` = ?";
$stmt = mysqli_prepare($conn,$sql);
$data = $value['num_visiter'] + 1;
mysqli_stmt_bind_param($stmt,'s',$data);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$conn = db_conn();
$sql = "SELECT * FROM `visiter`";
$obj = mysqli_query($conn,$sql);
$value = mysqli_fetch_assoc($obj);

    if(isset($_GET)){
        echo '<div id="alert" class="fixed-top fixed-absolute mt-5">';
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


<?php include("./include/navbar.php");?>
<?php if(!(isset($_GET['home']) or isset($_GET['about']) or isset($_GET['contect-us']) or isset($_GET['review']))){
?>
    <div class="container">
        <div id="home" class="d-flex justify-content-center align-items-center home-page-opacity">
            <div class="row text-center text-white font-cambria">
            <div class="col-md-12">
                <center> <i class="fab fa-accusoft fa-5x text-light"></i></center>
                <h2 class="letter-space"><strong>If opportunity doesn't knock, <t class="text-orange">Now Build a door!</t></strong></h2>
            </div>
            <div class="col">
                <h5 class="letter-space text-light">Test Yourself !</h5>
            </div>
            <div class="col-12 mt-5">
                    <a href="./php/login-signup/login-signup.php" class="col-md-5 btn btn-outline-light">Let's Start</a>
                </div>
            </div>    
        </div>
    </div>
<?php
}?>

<!---------------------------------------------------------------Home Section------------------------------------------------------------- -->
<?php
    if(isset($_GET['home'])){
?>
    <div class="container-fluid home-page-opacity">
        <div id="home" class="d-flex justify-content-center align-items-center mx-2">
            <div class="row text-center text-white font-cambria">
            <div class="col-md-12">
                <center> <i class="fab fa-accusoft fa-5x text-light"></i></center>
                <h2 class="letter-space"><strong>If opportunity doesn't knock, <t class="text-orange">Now Build a door!</t></strong></h2>
            </div>
            <div class="col">
                <h5 class="letter-space text-light">Test Yourself !</h5>
            </div>
            <div class="col-12 mt-5">
                    <a href="./php/login-signup/login-signup.php" class="col-md-5 btn btn-outline-light">Let's Start</a>
                </div>
            </div>    
        </div>
    </div>
<?php
    }
?>



<!----------------------------------------------------------- About section--------------------------------------------------------- -->
<?php
if(isset($_GET['about'])){
?>
<div class="container">
    <div id="about" class="row d-sm-flex justify-content-center align-items-center mt-md-5 mt-0">
       <div class="card mt-5 m-md-auto p-md-3">
           <div class="card-body">
               <div class="card-title"><strong> <i class="fas fa-globe-asia mr-1 text-dark"></i>Website Owner</strong></div>
               <div class="card-text">
                    <ul class="text-dark font-cambria">
                        <span>Hey Guys, my self 'Saty Mishra' i'm 21 year old. i have 
                            successfuly complete Graduation and also 
                            A LEVEL and Ethical hacking from NIELIT Gorakhpur.
                            <div id="demo" class="collapse">
                                So if you have belongs to IT sectore then this pletform is very 
                                usefull for you.
                                So Guys in this website You will able to Examing about <strong>
                                Ethical Hacking,Cyber security, Networking, A LEVEL OBJECTIVE Exam,
                                O LEVEL OBJECTIVE Exam and may more...</strong>
                            </div>
                            <a type="linke" class="text-danger"  data-toggle="collapse" data-target="#demo" style=" cursor: pointer;"><strong>Read More!</strong></a>
                            <div class="col text-right text-grey">- Satya Mishra<br>(Developer & Website Owner)</div>
                        </span>
                    </ul>
                    <div class="card-title"><strong> <i class="fas fa-globe-asia mr-1 text-dark"></i>Latest Topics</strong></div>
                        <div class="card-text">
                             <ul class="text-dark font-cambria">
                                 <span>C Language, C++ , DCN, LINUX, Database, Ethical hacking, Python, java etc.. 
                                 </span>
                             </ul>
                        </div>
                       <div class="card-title"><strong><i class="fas fa-eye"></i>Visiter Count!</strong><br>
                            <h2 class="ml-5"><?php echo $value['num_visiter'];?>+</h5>
                        </div>
                    <div class="col text-center">
                        <a href="https://www.facebook.com/satya.narayanmishra.5815255"><i class="fab fa-facebook ml-3 text-primary"></i></a>
                        <a href="https://www.instagram.com/imsatyamishra"><i class="fab fa-instagram ml-3 text-primary"></i></a>
                        <a href="https://twitter.com/ImSatyaMishra"><i class="fab fa-twitter ml-3 text-primary"></i></a>
                        <a href="https://www.youtube.com/channel/UCywHi-uIYTUB_wy-cmoHzsA"><i class="fab fa-youtube ml-3 text-danger"></i></a>
                    </div>
                    <div class="col text-center mt-1">
                        <a href="https://imsatya.000webhostapp.com" class="btn btn-primary">Details</a>
                    </div>
               </div>
           </div>
       </div>
    </div>
</div>
<?php
}
?>




<!-- ---------------------------------------------------------Contect us section--------------------------------------------------------- -->
<?php
if(isset($_GET['contect-us'])){
?>
<div class="container">
    <div class="d-flex justify-content-center align-items-center" id="contect-us">
       <form action="./php/mailer.php" method="post" onsubmit="return(mail_sender())" class="was-validated bg-dark p-5 radius box-shadow-black">
           <div class="col form-group">
               <div class="form-title text-center font-cambria-math text-orange"><h1>Contect Us</h1></div>
                <i class="fas fa-user mr-1 text-light"></i><lable class="mb-2 mr-2 text-light">Your Name :</lable>
                <input autocomplete="off" autocomplete='off' type="text" name="name" class="form-control mb-2 mr-2" id="mailer-name" placeholder="Enter Your Name .." required>
                <!-- <div class="valid-feedback">Valid.</div> -->
                <!-- <div class="invalid-feedback">Please fill out this field</div> -->
                <i class="fas fa-clipboard mr-1 text-light"></i><lable class="mb-2 mr-2 text-light">Subject :</lable>
                <input autocomplete="off" autocomplete='off' type="text" name="subject" class="form-control mb-2 mr-2" id="mailer-subject" placeholder="Type Subject .." required>
                <!-- <div class="valid-feedback">Valid.</div> -->
                <!-- <div class="invalid-feedback">Please fill out this field</div> -->
                <i class="fas fa-envelope mr-1 text-light"></i><lable class="mb-2 mr-2 text-light">Message :</lable>
                <input autocomplete="off" autocomplete='off' type="text" name="message" class="form-control mb-2 mr-2" id="mailer-message" placeholder="Enter Message .." required>
                <!-- <div class="valid-feedback">Valid.</div> -->
                <!-- <div class="invalid-feedback">Please fill out this field</div> -->
                <center><button class="btn btn-primary" type="submit" name="mail-send">Send</button></center>
           </div>
        </form>
    </div>
</div>
<?php
}
?>


<!-- Review section  -->
<?php
if(isset($_GET['review'])){
?>

<div class="mt-sm-5"><div class="row"></div></div>
<div class="container mt-5" id="review">
<?php
 $conn = db_conn();
 $sql  = "SELECT * FROM `review`";
 $review_object = mysqli_query($conn,$sql);
?>
    <div class="row text-center text-warning bg-maroon radius-top p-2">
        <!-- <div class="col-md-4">
            <h4 class="text-light">Like or Dislike</h4>
               <li class="far fa-heart"></li> 10+
               <li class="far fa-thumbs-up ml-2"></li> 10+
               <li class="far fa-thumbs-down ml-2"></li> 0
        </div> -->

        <div class="col-md-6">
             <h4 class="text-light">Rating</h4>
             <?php 
                $rate1_count = 0;
                $rate2_count = 0;
                $rate3_count = 0;
                $rate4_count = 0;
                $rate5_count = 0;

                while($rows = mysqli_fetch_assoc($review_object)){
                    if($rows['rating'] == 1){ $rate1_count += 1; }
                    if($rows['rating'] == 2){ $rate2_count += 1; }
                    if($rows['rating'] == 3){ $rate3_count += 1; }
                    if($rows['rating'] == 4){ $rate4_count += 1; }
                    if($rows['rating'] == 5){ $rate5_count += 1; }
                }
                $total_rating = $rate1_count + $rate2_count + $rate3_count + $rate4_count + $rate5_count;
                if($total_rating == 0){
                    $rate1 = 0 ;
                    $rate2 = 0 ;
                    $rate3 = 0 ;
                    $rate4 = 0 ;
                    $rate5 = 0 ;
                }else{
                    $rate1 = floor($rate1_count * 100 / $total_rating) ;
                    $rate2 = floor($rate2_count * 100 / $total_rating) ;
                    $rate3 = floor($rate3_count * 100 / $total_rating) ;
                    $rate4 = floor($rate4_count * 100 / $total_rating) ;
                    $rate5 = floor($rate5_count * 100 / $total_rating) ;
                }
               
            

            
    echo "  <div class='row x'>
                <div class='col-1'>1</div>

                <div class='col-9'>
                    <div class='progress mt-2' style='height:5px';>
                        <div class='progress-bar' style='width:".$rate1."%;'></div>
                    </div>
                </div>

                <div class='2'>".$rate1."%</div>
            </div>
    
                

            <div class='row '>
                <div class='col-1'>2</div>

                <div class='col-9'>
                    <div class='progress mt-2' style='height:5px';>
                        <div class='progress-bar' style='width:".$rate2."%;'></div>
                    </div>
                </div>

                <div class='2'>".$rate2."%</div>
            </div>

           
            <div class='row '>
                <div class='col-1'>3</div>

                <div class='col-9'>
                    <div class='progress mt-2' style='height:5px';>
                        <div class='progress-bar' style='width:".$rate3."%;'></div>
                    </div>
                </div>

                <div class='2'>".$rate3."%</div>
            </div>


            <div class='row'>
                <div class='col-1'>4</div>

                <div class='col-9'>
                    <div class='progress mt-2' style='height:5px';>
                        <div class='progress-bar' style='width:".$rate4."%;'></div>
                    </div>
                </div>

                <div class='2'>".$rate4."%</div>
            </div>

            
            <div class='row'>
                <div class='col-1'>5</div>

                <div class='col-9'>
                    <div class='progress mt-2' style='height:5px';>
                        <div class='progress-bar' style='width:".$rate5."%;'></div>
                    </div>
                </div>

                <div class='2'>".$rate5."%</div>
            </div>";
        ?>
        </div>



        <div class="col-md-6">
            <h4 class="text-light">Review</h4>
              <?php
                if(!isset($_SESSION['login'])){
                    echo "<p class='text-desable'>You can't send review before login</p>";
                }else{
                        $conn = db_conn();
                        $sql  = "SELECT * FROM `review`";
                        $object = mysqli_query($conn,$sql);
                        $flag   = 0;
                        while($rows = mysqli_fetch_assoc($object)){
                            if($rows['id'] == $_SESSION['login']['id']){
                                $flag += 1;
                            }
                        }
                    if($flag == 0){
?>
                    <div class="row">
                    <div class="col d-flex justify-content-center mb-1">
                        <form action="<?php echo $_SERVER['PHP_SELF']."?review";?>" method="post" id='rating-scroll'>
                            <button type="submit" name="rating" value="1" class="button-erase mr-1"><i class="far fa-star"></i></button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?review";?>" method="post">
                            <button type="submit" name="rating" value="2" class="button-erase mr-1"><i class="far fa-star"></i></button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?review";?>" method="post">
                            <button type="submit" name="rating" value="3" class="button-erase mr-1"><i class="far fa-star"></i></button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?review";?>" method="post">
                            <button type="submit" name="rating" value="4" class="button-erase mr-1"><i class="far fa-star"></i></button>
                        </form>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?review";?>" method="post">
                            <button type="submit" name="rating" value="5" class="button-erase mr-1"><i class="far fa-star"></i></button>
                        </form>
                    </div>
                    </div>
<?php                   
                    echo '<form action="./php/rating-manage.php" method="post" onsubmit class="form">';
                    if(isset($_POST['rating'])){
                        echo "<div>";
                        for($i=0;$i<$_POST['rating'];$i++){
                            echo "<i class='fas fa-star'></i>";
                        }
                        echo "</div>";
                    }
                        if(isset($_POST['rating'])){
                            echo '<input autocomplete="off" type="text" name="num-rating" value="'.$_POST['rating'].'" hidden>';
                            echo "<input autocomplete='off' type='text' name='id' value='".$_SESSION['login']['id']."' hidden>";
                            echo '<textarea class="form-control" name="review" placeholder="Type review.." id="" cols="30" rows="3" required></textarea>
                             <input autocomplete="off" type="submit" value="Submit" onclick="review_verify()" class=" mt-1 btn btn-sm btn-success w-100 p-1">';
                        }else{
                            echo '<textarea class="form-control" name="review" placeholder="Before write your review, first of all must have select rating..." id="" cols="30" rows="3" disabled></textarea>
                            <input autocomplete="off" type="button" value="Submit" class="btn btn-sm w-100 btn-success mt-1" title="Please select rating" disabled>';

                        }
                   echo '</form>';
                }if($flag == 1){echo '<textarea class="form-control" name="review" placeholder="You Have already submit review... Thanks" id="" cols="30" rows="4" disabled></textarea>';}
            }
?>

</div>
</div>
<?php
 $conn = db_conn();
 $sql  = "SELECT * FROM `review`";
 $object = mysqli_query($conn,$sql);
if( mysqli_num_rows($object)){
    $conn = db_conn();
    $sql  = "SELECT `u`.`id`, `u`.`fname`, `u`.`lname`, `u`.`email`,`r`.`rating`,`r`.`review` FROM
    `user` AS `u` INNER JOIN `review` AS `r` ON `u`.`id`=`r`.`id`";
    $object = mysqli_query($conn,$sql);
    echo '<div class="row bg-light text-left text-capitalize text-dark">';
    while($rows = mysqli_fetch_assoc($object)){
            if(isset($_SESSION['login']) && $_SESSION['login']['id'] == $rows['id'] ){
                echo '<div class="col-12 mt-3 mb-3 clearfix">';
                echo '<div class="col-12 d-flex">';
                    echo '<div class="col-sm-6"><i class="fas fa-user-circle mr-sm-1"></i> '.$rows['fname']." ".$rows['lname']."</div>";
                    echo '<div class="col-sm-6 text-right">';
                        for($i=0;$i<$rows['rating'];$i++){
                            echo "<i class='fas fa-star'></i>";
                        }
                    echo '</div>';
                echo '</div>';
                echo "<div class='col-12 text-lowercase mt-1'>
            <form class='form' action='php/main-page.php' method='post'>
                <input autocomplete='off' type='text' name='update-review' value='".$rows['review']."' class='form-control w-100'>
                </div>";
                if(isset($_SESSION['login']) && $_SESSION['login']['id'] == $rows['id']){
                    echo "<div class='btn-group float-right mr-md-5 mt-3 bg-aqua'>
                <input autocomplete='off' type='text' name='id' value='".$_SESSION['login']['id']."' hidden>
                <button type='submit' name='edit-review' class='btn btn-sm btn-primary px-5 active'>Update</button>
            </form>";
                      echo "<form action='php/main-page.php' method='post'>
                                <input autocomplete='off' type='text' name='id' value='".$_SESSION['login']['id']."' hidden>
                                <button type='submit' name='review-delete' class='btn btn-sm btn-primary px-5 '>Delete</button>
                            </form>";
                    echo "</div>";
                }
            echo '</div>';
            }
        }
    $object = mysqli_query($conn,$sql);
    while($rows = mysqli_fetch_assoc($object)){
        if(isset($_SESSION['login']) && $_SESSION['login']['id'] == $rows['id'] ){}else{
            echo '<div class="col-12 mb-3 mt-3">';
            echo '<div class="row px-4 d-flex">';
                echo '<div class="col-md-6"><i class="fas fa-user-circle mr-1"></i> '.$rows['fname']." ".$rows['lname']."</div>";
                echo '<div class="col-md-6 text-right">';
                    for($i=0;$i<$rows['rating'];$i++){
                        echo "<i class='fas fa-star'></i>";
                    }
                echo '</div>';
            echo '</div>';
            echo "<div class='col-12 text-lowercase mt-1'>
                    <form class='form'>
                         <input autocomplete='off' type='text' value='".$rows['review']."' class='form-control' disabled>    
                    </form>
            </div>";
            echo "<div class='text-right mr-5 mt-3'>";
              echo "</div>";
            if(isset($_SESSION['login']) && $_SESSION['login']['id'] == $rows['id']){
                echo "<div class='ml-5 mt-3 '><a href class='btn btn-sm btn-primary'>Edit</a></div>";
            }
        echo '</div>';
    }
}
    echo '</div">';
}else{
    echo '<div class="row bg-white">
            <div class="col text-center">No Review found!</div>
        </div>';
};
?>

<!-- </div> -->
</div>
</div>

<?php
}
?>
<div class="bg-black">
    <?php  include("./include/copyright.php");?>
</div>
</body>
</html>