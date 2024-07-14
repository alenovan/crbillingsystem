<?php
// Data yang diberikan
$start = "2024-06-08 21:48:54";
$end = "2024-06-08 23:43:53";

// Mengubah string tanggal dan waktu menjadi objek DateTime
$startDate = new DateTime($start);
$endDate = new DateTime($end);

// Menghitung selisih antara dua tanggal dan waktu
$interval = $startDate->diff($endDate);

// Mengambil jumlah jam dan menit dari selisih waktu
$hours = $interval->h;
$minutes = $interval->i;

// Jika selisih lebih dari satu hari, tambahkan jumlah hari ke dalam jumlah jam
$hours += ($interval->days * 24);

// Menghitung total waktu dalam menit
$totalMinutes = ($hours * 60) + $minutes;

// Membulatkan hasil ke jam terdekat ke atas
$totalHoursRounded = ceil($totalMinutes / 60);

// Menampilkan hasil dalam jam yang sudah dibulatkan ke atas
echo "Jumlah jam: $totalHoursRounded jam";
?>
