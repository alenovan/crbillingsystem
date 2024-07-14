<?php
session_start();
include "secret/config.php";
include "secret/database.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>CR Billing System - App Login</title>
    <meta name="description" content="CR Billing System - App Login">
    <meta name="keywords"
        content="Billiard Lamp Controller System" />
    <link rel="icon" type="image/png" href="<?php echo $baseurl; ?>public/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $baseurl; ?>public/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>public/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>public/assets/css/style.css">
    <link rel="manifest" href="__manifest.json">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?php echo $baseurl; ?>public/assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->
    
    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
        </div>
        <div class="pageTitle"></div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mb-5 text-center">
            <img src="<?php echo $baseurl; ?>public/assets/img/logo-profil.jpg" alt="logo" class="imaged w120 mb-2 rounded">
            <h4 class="mb-5 mt-2">Fill the form to log in <br />System Billiard Billing</h4>
        </div>


        <div class="section mb-5 mt-5 p-2">

            <form method="POST" action="?login">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">Username</label>
                                <input type="text" class="form-control" id="f_username_email" name="f_username_email" placeholder="Your Username" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="f_password" name="f_password" autocomplete="off" placeholder="Your password" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-2">
                    
                    <!-- Ketika username dan password tidak ditemukan -->
                    <?php if(isset($_GET['gagal-login'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                        Incorrect Username or Password!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>

                    <!-- Peringatan ketika sudah logout -->
                    <?php 
                    if(isset($_GET['logout'])) {
                        session_destroy(); 
                    ?>
                    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                        Thank you, u're log out!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>
    
                    <!-- Peringatan ketika belum login -->
                    <?php if(isset($_GET['harus-login'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
                        Please log in first!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>
                    
                    
                </div>

                <div class="form-links mt-2">
                    <div>
                        <a href="contact-support.php">Forgot Password?</a>
                    </div>
                </div>

                <div class="form-button-group  transparent">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>


            </form>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- iOS Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet ios-add-to-home" id="ios-add-to-home-screen" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Home Screen</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1"><img src="public/assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>CR Billing System</strong> on your iPhone's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="share-outline"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * iOS Add to Home Action Sheet -->


    <!-- Android Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet android-add-to-home" id="android-add-to-home-screen" tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Home Screen</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1">
                            <img src="public/assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>CR Billing System</strong> on your Android's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="ellipsis-vertical"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Android Add to Home Action Sheet -->



    <div id="cookiesbox" class="offcanvas offcanvas-bottom cookies-box" tabindex="-1" data-bs-scroll="true"
        data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">We use cookies</h5>
        </div>
        <div class="offcanvas-body">
            <div>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non lacinia quam. Nulla facilisi.
                <a href="#" class="text-secondary"><u>Learn more</u></a>
            </div>
            <div class="buttons">
                <a href="#" class="btn btn-primary btn-block" data-bs-dismiss="offcanvas">I understand</a>
            </div>
        </div>
    </div>

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="<?php echo $baseurl; ?>public/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?php echo $baseurl; ?>public/assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="<?php echo $baseurl; ?>public/assets/js/base.js"></script>

    <script>
        // Add to Home with 2 seconds delay.
        AddtoHome("2000", "once");
    </script>

</body>

</html>


<?php
    if(isset($_GET['login'])) {
        $f_username  = $_POST['f_username_email'];
        $f_password  = $_POST['f_password'];
    
        $querylogin = mysqli_query($mysqli,"SELECT * FROM users WHERE username = '$f_username' AND is_timer IS NULL");

        $ceklogin = mysqli_num_rows($querylogin);
        $datalogin = mysqli_fetch_array($querylogin);
        $hash = $datalogin['password'];
    
        if (password_verify($f_password, $hash)) {
            if($ceklogin>0){
                $_SESSION['s_status'] = "login";
                $_SESSION['s_id_user'] = $datalogin['id'];
                $_SESSION['s_username'] = $datalogin['username'];
                
                $QueryShowConfig = mysqli_query($mysqli,"SELECT * FROM configs WHERE id='1'");
                $DataConfig = mysqli_fetch_array($QueryShowConfig);
                
                $_SESSION['s_client_name'] = $DataConfig['client_name'];
                $_SESSION['s_total_table'] = $DataConfig['total_table'];
                $_SESSION['s_client_id'] = $DataConfig['client_id'];
                
                $id_user = $datalogin['id'];
                $date_now = date('Y-m-d H:i:s');;
                
                $QueryUpdateDate = mysqli_query($mysqli,"UPDATE users SET update_at='$date_now' WHERE id='$id_user'");
                
                echo '<script>window.location.href = "dashboard.php";</script>';

            }else{
            echo '<script>window.location.href = "?gagal-login";</script>';
        }
    } else {
        echo '<script>window.location.href = "?gagal-login";</script>';
    }
}
?>