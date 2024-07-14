<style>
    .bg-temuan{
        background-color: #ff00002e !important;
    }
</style>

<?php
include "includes/header.php";

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$type = $_POST['type'];
$status_data = $_POST['status'];
$cashier = $_POST['cashier'];

$type_condition = !empty($type) ? "= '$type'" : "IS NOT NULL";
$status_data_condition = !empty($status_data) ? "= '$status_data'" : "IS NULL OR status_data IS NOT NULL OR status_data=''";
$cashier_condition = !empty($cashier) ? "= '$cashier'" : "IS NOT NULL";

$date_condition = (!empty($start_date) && !empty($end_date)) ? "BETWEEN '$start_date' AND '$end_date'" : "IS NOT NULL";

// $QueryGenerateReport = mysqli_query($mysqli, "
//     SELECT * FROM orders
//     WHERE DATE(start_time) $date_condition
//     AND status = 'STOP'
//     AND type $type_condition
//     AND (status_data $status_data_condition)
//     ORDER BY id DESC
//     ");
    
$QueryGenerateReport = mysqli_query($mysqli, "
    SELECT 
        orders.*, 
        rooms.name AS table_name,
        rooms.code AS table_code,
        rooms.status AS table_status,
        users.username AS user_name
    FROM 
        orders
    INNER JOIN 
        rooms 
    ON 
        orders.id_rooms = rooms.id
    INNER JOIN 
        users 
    ON 
        orders.id_users = users.id
    WHERE 
        DATE(orders.start_time) $date_condition
        AND orders.status = 'STOP'
        AND orders.type $type_condition
        AND (orders.status_data $status_data_condition)
        AND users.id $cashier_condition
    ORDER BY 
        orders.id DESC;
    ");
    
    
$TotalData = mysqli_num_rows($QueryGenerateReport);
?>
    
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Report Detail
        </div>
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#actionSheetShare">
                <ion-icon name="share-social-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Share Action Sheet -->
    <div class="modal fade action-sheet inset" id="actionSheetShare" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share to</h5>
                </div>
                <div class="modal-body">
                    <ul class="action-button-list">
                        <li>
                            <a href="<?php echo $baseurl; ?>export/excel.php?filter=0&from=<?php echo $start_date; ?>&to=<?php echo $end_date; ?>&type=<?php echo $type; ?>&status=<?php echo $status_data; ?>" class="btn btn-list">
                                <span>
                                    <ion-icon name="document-text"></ion-icon>
                                    Export Excel
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $baseurl; ?>export/pdf.php?filter=0&from=<?php echo $start_date; ?>&to=<?php echo $end_date; ?>&type=<?php echo $type; ?>&status=<?php echo $status_data; ?>" class="btn btn-list">
                                <span>
                                    <ion-icon name="document"></ion-icon>
                                    Export PDF
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- * Share Action Sheet -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
        <!-- Stats -->
        <div class="section mt-2 mb-3">
            <div class="card">
                <ul class="listview no-line transparent flush simple-listview">
                    
                    <?php if($start_date==''){ }else{ ?>
                    <li>
                        <div class="text-muted">From</div>
                        <strong><?php echo tgl_indo($start_date); ?></strong>
                    </li>
                    <?php } ?>
                    
                    <?php if($end_date==''){ }else{ ?>
                    <li>
                        <div class="text-muted">To</div>
                        <strong><?php echo tgl_indo($end_date); ?></strong>
                    </li>
                    <?php } ?>
                    
                    <?php if($type==''){ }else{ ?>
                    <li>
                        <div class="text-muted">Order Type</div>
                        <strong><?php echo $type; ?></strong>
                    </li>
                    <?php } ?>
                    
                    <?php if($status_data==''){ }else{ ?>
                    <li>
                        <div class="text-muted">Status</div>
                        <strong><?php echo $status_data; ?></strong>
                    </li>
                    <?php } ?>
                    
                    <li>
                        <div class="text-muted">Total Data</div>
                        <strong><?php echo $TotalData; ?> Data</strong>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Stats -->


        <!-- Stats -->
        <div class="section mt-2 mb-3">

            <div class="card">
                
                <?php if($TotalData=='0'){ ?>
                    <p class="text-center p-5">Sorry, no data available. Please change the Filters.</p>
                <?php }else{ ?>
                <div class="table-responsive">
                    <table class="table table-striped color-b">
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
                                <th scope="col">Cashier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            while($DataReport = mysqli_fetch_array($QueryGenerateReport)) { 
                            ?>
                            <tr>
                                <th scope="row"><?php echo $no; ?></th>
                                <th>#9036<?php echo $DataReport['id']; ?></th>
                                <th><?php echo titleCase($DataReport['name']); ?></th>
                                <th><?php echo $DataReport['phone']; ?></th>
                                <th><?php echo $DataReport['table_name']; ?></th>
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
                                <th><?php echo titleCase($DataReport['user_name']); ?></th>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Stats -->


<?php include "includes/footer.php"; ?>