<div class="container-fluid fixed-top bg-dark clearfix box-shadow-black">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="col-4 float-left">
            <div class="navbar-brand font-cambria-math">
                <span class="text-orange"> <i class="fab fa-accusoft mr-1 text-light"></i>Splus-<span class="text-white">Learning</span></span>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collabsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-12 col-sm-8 collapse navbar-collapse navbar-dark text-center" id="collabsibleNavbar">
            <ul class="navbar-nav ml-sm-auto mr-sm-2">
            <div class="col-12">
            <?php
                 if($_SESSION['login']['account_type'] == 'admin'){
                    echo '<a href="../main.php?success=You have successfully exited from exam !" class="nav-link" > <i class="fas fa-sign-out-alt mr-1 text-light"></i>EXIT</a>';
                }else if($_SESSION['login']['account_type'] == 'user'){
                    echo '<a href="../../user/main.php?success=You have successfully exited from exam !" class="nav-link" > <i class="fas fa-sign-out-alt mr-1 text-light"></i>EXIT</a>';
                }
            ?>
        </div>
                </li>
            </ul>
        </div>
    </nav>
</div>