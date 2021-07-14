<?php
// if(!(isset($_GET['home']) || isset($_GET['about']) || isset($_GET['contect-us']) || isset($_GET['review']))){
//     $text = "text-primary";
// }
// if(isset($_GET['home']) || isset($_GET['about']) || isset($_GET['contect-us']) || isset($_GET['review'])){
//     $text = "text-primary";
// }else{
//     $text = ""
// }
?>
<div class="container-fluid fixed-top bg-dark clearfix">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="col-4 float-left">
            <div class="navbar-brand font-cambria-math">
                <span class="text-orange"> <i class="fab fa-accusoft mr-1 text-light"></i>Splus-<span class="text-white">Learning</span></span>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collabsibleNavbar">
            <span class="navbar-toggler-icon">
                <!-- <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div> -->
            </span>
        </button>
        <div class="col-12 col-lg-8 collapse navbar-collapse navbar-dark text-center" id="collabsibleNavbar">
            <ul class="navbar-nav ml-lg-auto mr-lg-2">
                <li class="nav-item">
                    <a href="index.php?home" class="nav-link"><i class="fas fa-home mr-1 text-light"></i>Home</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item">
                    <a href="index.php?about" class="nav-link"><i class="fas fa-address-card mr-1 text-light"></i>About</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item">
                    <a href="index.php?contect-us" class="nav-link"><i class="fas fa-signal mr-1 text-light"></i>Contect Us</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item">
                    <a href="index.php?review" class="nav-link"><i class="fas fa-envelope mr-1 text-light"></i>Review</a>
                </li>
            </ul>
            <!-- logout icon implement -->
            <?php
            if(isset($_SESSION['login'])){
?>
            <ul class="navbar-nav mr-sm-2">
                <li class="nav-item">
                     <a href="./include/logout.php"  class="nav-link"><i class="fas fa-sign-out-alt mr-1 text-light"></i>Logout</a>
                </li>
            </ul>
<?php
            }
?>
            <div class="d-xl-block d-none float-right">
                <a href="https://www.facebook.com/satya.narayanmishra.5815255" class="ml-2"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/imsatyamishra" class="ml-2"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/ImSatyaMishra" class="ml-2"><i class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com/channel/UCywHi-uIYTUB_wy-cmoHzsA" class="ml-2"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </nav>
</div>