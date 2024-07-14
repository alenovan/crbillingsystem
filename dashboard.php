<?php
session_start();
if($_SESSION['s_status']=="login"){
?>

<?php include "includes/header.php"; ?>

<?php include "routes.php"; ?>

<?php include "includes/bottom-menu.php"; ?>

<?php include "includes/footer.php"; ?>


<?php
}else{
    echo '<script>window.location.href = "index.php?harus-login";</script>';
}
?>