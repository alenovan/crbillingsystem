<?php
include "../secret/config.php";
include "../secret/database.php";
include "../secret/function.php";
date_default_timezone_set('Asia/Jakarta');
$DateNow = date('Y-m-d H:i:s');

session_start();

$f_client_name = $_SESSION['s_client_name'];
$f_client_id = $_SESSION['s_client_id'];

$start_date = isset($_GET['from']) ? mysqli_real_escape_string($mysqli, $_GET['from']) : '';
$end_date = isset($_GET['to']) ? mysqli_real_escape_string($mysqli, $_GET['to']) : '';
$type = isset($_GET['type']) ? mysqli_real_escape_string($mysqli, $_GET['type']) : '';
$status_data = isset($_GET['status']) ? mysqli_real_escape_string($mysqli, $_GET['status']) : '';

// Membuat kondisi untuk setiap parameter
$type_condition = !empty($type) ? "= '$type'" : "IS NOT NULL";
$status_data_condition = !empty($status_data) ? "= '$status_data'" : "IS NULL OR status_data IS NOT NULL";
$date_condition = (!empty($start_date) && !empty($end_date)) ? "BETWEEN '$start_date' AND '$end_date'" : "IS NOT NULL";

$QueryGenerateReport = mysqli_query($mysqli, "
    SELECT * FROM orders
    WHERE DATE(start_time) $date_condition
    AND status = 'STOP'
    AND type $type_condition
    AND (status_data $status_data_condition)
    ORDER BY id DESC
    ");
$TotalData = mysqli_num_rows($QueryGenerateReport);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Export to PDF <?php echo $f_client_name; ?> - <?php echo $DateNow; ?> - CR BILLING SYSTEM</title>
</head>
<body>
	<style type="text/css">
	@page {
    size: A4 potrait;
	}
	body{
		font-family: sans-serif;
	}
	table{
		margin: 10px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}

	table.table-informasi-checker{
		width: 95%;
	}

	table.table-informasi-checker td{
		border: 0px solid black;
	}

	.judul-form{
		padding: 20px;
		font-weight: bold;
	}


	table.table-detail-monitoring{
		width: 95%;
	}

	.text-center{
		text-align: center;
	}

	.logo{
		width: 130px;
	}
	</style>

	<table class="table-informasi-checker">
		<tr>
			<td class="judul-form-space" align="left"><img src="logo-report.png" class="logo"></td>
			<td class="judul-form" colspan="4" align="right">Report Billing Billiard - <?php echo $f_client_name; ?></td>
		</tr>
	</table>

	<table class="table-detail-monitoring">
	    <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID.</th>
                <th scope="col">Cust. Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Table</th>
                <th scope="col">Duration</th>
                <th scope="col">Type</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Real Minutes</th>
                <th scope="col">Status</th>
                <th scope="col">Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            while($DataReport = mysqli_fetch_array($QueryGenerateReport)) { 
            ?>
            <tr>
                <th scope="row"><?php echo $no; ?></th>
                <th>#<?php echo $f_client_id; ?><?php echo $DataReport['id']; ?></th>
                <th><?php echo titleCase($DataReport['name']); ?></th>
                <th><?php echo $DataReport['phone']; ?></th>
                <th>Table <?php echo $DataReport['id_rooms']; ?></th>
                <th>
                <?php
                $start = $DataReport['start_time'];
                $end = $DataReport['end_time'];
                
                echo calculateTimeDifference($start, $end);
                ?>
                </th>
                <th><?php echo $DataReport['type']; ?></th>
                <th><?php echo tgl_indo(date('Y-m-d', strtotime($DataReport['start_time']))); ?> - <?php echo date('H:i:s', strtotime($DataReport['start_time'])); ?></th>
                <th><?php echo tgl_indo(date('Y-m-d', strtotime($DataReport['end_time']))); ?> - <?php echo date('H:i:s', strtotime($DataReport['end_time'])); ?></th>
                <th>
                <?php
                
                $start = $DataReport['start_time'];
                $end = $DataReport['end_time'];
                
                $start_timestamp = strtotime($start);
                $end_timestamp = strtotime($end);
                
                $total_minutes = ($end_timestamp - $start_timestamp) / 60;
                
                // Membulatkan hasil ke bawah
                $total_minutes_rounded = floor($total_minutes);
                
                echo $total_minutes_rounded . " Minutes";
                ?>
                </th>
                <th><?php echo titleCase($DataReport['status_data']); ?></th>
                <th><?php echo $DataReport['notes']; ?></th>
                </tr>
            <?php $no++; } ?>
        </tbody>
	</table>

	<p>Dicetak Pada : <?php echo $DateNow; ?> | Total Data : <?php echo $TotalData; ?></p>
</body>
</html>

<script>
  window.onload = function() {
    // Auto print the document
    window.print();
  };
</script>