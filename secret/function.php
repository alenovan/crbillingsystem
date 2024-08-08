<?php 

function rupiah($angka){	
	$hasil_rupiah = "Rp" . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function cleanurl($strawal){	
	$hasil_cleanurl = str_replace(" ", "-", $strawal);
	return $hasil_cleanurl;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
    
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function hari_indo($hari){
    $dayNames = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );
    return $dayNames[$hari];
}

function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}


function titleCase($string) {
    // Daftar kata-kata yang tidak dikapitalisasi kecuali di awal atau akhir
    $dontCapitalize = array('and', 'or', 'nor', 'but', 'a', 'an', 'the', 'as', 'at', 'by', 'for', 'in', 'of', 'on', 'to', 'up', 'with');

    // Mengubah seluruh string menjadi lowercase
    $string = strtolower($string);

    // Membagi string menjadi array kata-kata
    $words = explode(' ', $string);

    foreach ($words as $key => $word) {
        // Kapitalisasi kata pertama dan terakhir, atau kata-kata yang tidak ada dalam daftar
        if ($key == 0 || $key == count($words) - 1 || !in_array($word, $dontCapitalize)) {
            $words[$key] = ucfirst($word);
        }
    }

    // Menggabungkan kembali kata-kata menjadi string
    return implode(' ', $words);
}

function calculateTimeDifference($start, $end) {
    // Mengubah string tanggal dan waktu menjadi objek DateTime
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    
    // Menghitung selisih antara dua tanggal dan waktu
    $interval = $startDate->diff($endDate);
    
    // Mengambil jumlah jam dari selisih waktu
    $hours = $interval->h;
    $minutes = $interval->i;
    
    // Jika selisih lebih dari satu hari, tambahkan jumlah hari ke dalam jumlah jam
    $hours += ($interval->days * 24);
    
    // Bulatkan hasil dari menit
    if ($minutes >= 59) {
        $hours++; // Tambah satu jam jika menit lebih dari atau sama dengan 30
        $minutes = 0;
    }
    
    // Membuat string untuk hasil waktu
    $result = '';
    if($hours == 0 && $minutes > 0) {
        $result = "$minutes Minutes";
    } else if($hours > 0 && $minutes == 0) {
        $result = "$hours Hour";
        if($hours > 1) {
            $result .= 's'; // Menambah 's' jika jam lebih dari satu
        }
    } else if($hours > 0 && $minutes > 0) {
        $result = "$hours Hour $minutes Minutes";
    } else {
        $result = "< 1 Minutes";
    }
    
    return $result;
}

function calculateTimeDifference2($start, $end) {
    // Mengubah string tanggal dan waktu menjadi objek DateTime
    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    
    // Menghitung selisih antara dua tanggal dan waktu
    $interval = $startDate->diff($endDate);
    
    // Mengambil jumlah jam dari selisih waktu
    $hours = $interval->h;
    $minutes = $interval->i;
    
    // Jika selisih lebih dari satu hari, tambahkan jumlah hari ke dalam jumlah jam
    $hours += ($interval->days * 24);
    
    // Bulatkan hasil dari menit
    if ($minutes >= 59) {
        $hours++; // Tambah satu jam jika menit lebih dari atau sama dengan 30
        $minutes = 0;
    }
    
    // Membuat string untuk hasil waktu
    $result = '';
    if($hours == 0 && $minutes > 0) {
        $result = "$minutes Min";
    } else if($hours > 0 && $minutes == 0) {
        $result = "$hours Hour";
        if($hours > 1) {
            $result .= 's'; // Menambah 's' jika jam lebih dari satu
        }
    } else if($hours > 0 && $minutes > 0) {
        $result = "$hours,$minutes Hours";
    } else {
        $result = "1 Min";
    }
    
    return $result;
}


function calculateTimePrice($start, $end, $price, $formatIDR = false) {
    // Convert timestamps to DateTime objects
    $startTime = new DateTime($start);
    $endTime = new DateTime($end);

    // Calculate the difference
    $interval = $startTime->diff($endTime);

    // Convert the difference to minutes
    $minutes = $interval->days * 24 * 60; // Total minutes in days
    $minutes += $interval->h * 60; // Total minutes in hours
    $minutes += $interval->i; // Total minutes

    // Multiply by 1000
    $result = $minutes * $price;

    if ($formatIDR) {
        $result = 'Rp ' . number_format($result, 0, ',', '.');
    }
    return $result;
}


?>