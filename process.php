<?php
if (isset($_GET['action']) && $_GET['action'] == 'update-transaction') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status_data = $_POST['status_data'];
    $notes = $_POST['notes'];
    
    // echo $id;
    // echo $status_data;
    // echo $notes;
    $QueryUpdateTransactions = mysqli_query($mysqli, "UPDATE orders SET status_data='$status_data', notes='$notes' WHERE id='$id'");
    echo '<script>window.location.href = "detail-page.php?page=detail-transactions&id=' . $id . '";</script>';
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'update-password') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // echo $id . "<br />";
    // echo $new_password . "<br />";
    // echo $repeat_new_password . "<br />";
    
    $QueryUpdatePassword = mysqli_query($mysqli, "UPDATE users SET password='$new_hashed_password' WHERE id='$id'");
    echo '<script>window.location.href = "dashboard.php?page=setting";</script>';
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'update-price') {
    echo $_SERVER["REQUEST_METHOD"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST['price'];

  
    // echo $new_password . "<br />";
    // echo $repeat_new_password . "<br />";
    
    $QueryUpdatePassword = mysqli_query($mysqli, "UPDATE configs_times SET price='$price' WHERE id='1'");
    echo '<script>window.location.href = "dashboard.php?page=setting";</script>';
    }
}

?>