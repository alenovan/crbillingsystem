<?php 
$f_id_user = $_SESSION['s_id_user'];
$QueryShowHistory = mysqli_query($mysqli, "SELECT 
    orders.*,
    rooms.name AS table_name,
    rooms.code AS table_code,
    rooms.status AS table_status
FROM 
    orders
INNER JOIN 
    rooms 
ON 
    orders.id_rooms = rooms.id
WHERE 
    orders.status = 'STOP'
ORDER BY 
    orders.created_at DESC
LIMIT 
    250;");
?>


    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton" onclick="window.location.reload(); return false;">
                <ion-icon name="refresh-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Transaction History</div>
        <div class="right">
<!--             <a href="#" class="headerButton toggle-searchbox">
                <ion-icon name="search-outline"></ion-icon>
            </a> -->
        </div>
    </div>
    <!-- * App Header -->

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form">
            <div class="form-group searchbox">
                <input type="text" class="form-control" placeholder="Search...">
                <i class="input-icon icon ion-ios-search"></i>
                <a href="#" class="ms-1 close toggle-searchbox"><i class="icon ion-ios-close-circle"></i></a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2 mb-2">
            
            <div class="transactions">
                <?php 
                $current_date = null;
                $today = date('M d, Y');  // Pastikan format ini sama dengan format $formatted_date
                while($DataShowHistory = mysqli_fetch_array($QueryShowHistory)) {
                    $formatted_date = date('M d, Y', strtotime($DataShowHistory['created_at']));
                    // Cek jika tanggal berubah, tampilkan header tanggal baru
                    if ($current_date !== $formatted_date) {
                        if ($current_date !== null) {
                            echo "</div>"; // Tutup div tanggal sebelumnya jika ada
                        }
                        // Jika tanggal sama dengan hari ini, tampilkan "Today"
                        $header_title = ($formatted_date == $today) ? 'Today' : $formatted_date;
                        echo "<div class='section-title mt-2'>$header_title</div><div>"; // Header tanggal
                        $current_date = $formatted_date;
                    }
                    ?>
                    <!-- item -->
                    <a href="detail-page.php?page=detail-transactions&id=<?php echo $DataShowHistory['id']; ?>" class="item">
                        <div class="detail">
                            <img src="<?php echo $baseurl; ?>public/assets/img/table-img.jpg" alt="img" class="image-block imaged w48">
                            <div>
                                <strong>#<?php echo $f_client_id; ?><?php echo $DataShowHistory['id']; ?></strong>
                                <p class="color-b">Cust : <?php echo titleCase($DataShowHistory['name']); ?></p>
                                <p><?php echo $DataShowHistory['table_name']; ?></p>
                                <p><?php echo $formatted_date; ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <div class="price text-primary">
                                <?php
                                $start = $DataShowHistory['start_time'];
                                $end = $DataShowHistory['end_time'];
                                echo calculateTimeDifference2($start, $end);
                                ?>
                            </div>
                            <p class="price color-g"><?php echo $DataShowHistory['type']; ?></p>
                            <?php if($DataShowHistory['status_data']=='Done'){ ?>
                                <div class="price chip chip-outline chip-success ms-05 mb-05">
                                    <span class="chip-label"><?php echo $DataShowHistory['status_data']; ?></span>
                                </div>
                            <?php } elseif($DataShowHistory['status_data']=='void'){ ?>
                                <div class="price chip chip-outline chip-danger ms-05 mb-05">
                                    <span class="chip-label">Void</span>
                                </div>
                            <?php } else { ?>
                                <div class="price chip chip-outline chip-warning ms-05 mb-05">
                                    <span class="chip-label">No Order</span>
                                </div>
                            <?php } ?>
                        </div>
                    </a>
                    <!-- item -->
                <?php 
                } 
                if ($current_date !== null) {
                    echo "</div>"; // Tutup div tanggal terakhir
                }
                ?>
            </div>

            
        <div class="section mt-2 mb-2">
            <a href="?page=report" class="btn btn-primary btn-block btn-lg">Load More</a>
        </div>

    </div>
    <!-- * App Capsule -->
