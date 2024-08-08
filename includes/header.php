<?php
    
include "secret/config.php";
include "secret/database.php";
include "secret/function.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$f_id_user = $_SESSION['s_id_user'];
$f_client_name = $_SESSION['s_client_name'];
$f_total_table = $_SESSION['s_total_table'];
$f_client_id = $_SESSION['s_client_id'];

$queryPrice = mysqli_query($mysqli, "
    SELECT price from configs_times  where id = 1;
    ");
    
    
$queryFecthPrice = mysqli_fetch_array($queryPrice);

$priceperminute = $queryFecthPrice["price"];
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
    <title><?php echo $f_client_name; ?> - CR Billing System</title>
    <meta name="description" content="<?php echo $f_client_name; ?> - CR Billing System for Monitoring Lamp">
    <link rel="icon" type="image/png" href="public/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="public/assets/img/icon/192x192.png">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/custom.css">
    <link rel="manifest" href="__manifest.json">
</head>

<body>

<!-- loader -->
<div id="loader">
    <img src="public/assets/img/loading-icon.png" alt="icon" class="loading-icon">
</div>
<!-- * loader -->