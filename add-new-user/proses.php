<?php
include "../secret/config.php";
include "../secret/database.php";
include "../secret/function.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Hash password menggunakan password_hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Simpan password yang di-hash ke dalam database
$QueryInsertNewUser = mysqli_query($mysqli, "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')");

if ($QueryInsertNewUser) {
    echo "Password berhasil disimpan ke dalam database.";
} else {
    echo "Gagal menyimpan password ke dalam database.";
}


?>