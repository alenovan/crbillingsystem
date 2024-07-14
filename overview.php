<?php 
    $QueryShowRecentTransactions = mysqli_query($mysqli, "
        SELECT 
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
            orders.status = 'START'
        ORDER BY 
            orders.id DESC;
    ");
    
    $TotalActive = mysqli_num_rows($QueryShowRecentTransactions);
    
    
    $QueryCountCharts = mysqli_query($mysqli, "SELECT 
    DATE(start_time) AS order_date,
        COUNT(*) AS order_count
    FROM 
        orders
    WHERE 
        start_time >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        AND status_data = 'Done'
    GROUP BY 
        DATE(start_time)
    ORDER BY 
        order_date;");

    $dates = [];
    $order_counts = [];
    
    while($DataCountCharts = mysqli_fetch_array($QueryCountCharts)) {
        $dates[] = $DataCountCharts['order_date'];
        $order_counts[] = $DataCountCharts['order_count'];
    }
        
?>
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="public/assets/img/logo.png" alt="logo" class="logo">
        </div>
        <div class="right">
            <a href="?page=setting" class="headerButton">
                <img src="public/assets/img/logo-profil.jpg" alt="image" class="imaged w32">
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title">Welcome Back,</span>
                        <h5 class="total"><?php echo $f_client_name; ?></h5>
                    </div>
                </div>
                <!-- * Balance -->
            </div>
        </div>
        <!-- Wallet Card -->
        
        <div class="section mt-2 mb-3">
            <div class="section-title">Transaction Stats</div>
            <div class="card">
                <div class="card-body">
                    <div id="chart-line"></div>
                </div>
            </div>
        </div>
        

        <!-- Stats -->
        <div class="section">
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Total Table</div>
                        <div class="value"><?php echo $f_total_table; ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">Table Active</div>
                        <div class="value text-danger"><?php echo $TotalActive; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Stats -->

        <!-- Transactions -->
        <div class="section mt-4 mb-5">
            <div class="section-heading">
                <h2 class="title">Active Transactions</h2>
                <a href="?page=history" class="link"></a>
            </div>
            <div class="transactions">
                <?php while($DataShowRecentTransactions = mysqli_fetch_array($QueryShowRecentTransactions)) { ?>
                <!-- item -->
                <a href="detail-page.php?page=detail-transactions&id=<?php echo $DataShowRecentTransactions['id']; ?>" class="item">
                    <div class="detail">
                        <img src="<?php echo $baseurl; ?>public/assets/img/table-img.jpg" alt="img" class="image-block imaged w48">
                        <div>
                            <strong><?php echo titleCase($DataShowRecentTransactions['name']); ?></strong>
                            <p class="color-b"><?php echo $DataShowRecentTransactions['table_name']; ?></p>
                            <p><?php echo tgl_indo(date('Y-m-d', strtotime($DataShowRecentTransactions['created_at']))); ?></p>
                            <p>#<?php echo $f_client_id; ?><?php echo $DataShowRecentTransactions['id']; ?></p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-danger">
                            <?php
                            // Data yang diberikan
                            $start = $DataShowRecentTransactions['start_time'];
                            $end = $DataShowRecentTransactions['end_time'];

                            echo calculateTimeDifference2($start, $end);
                            ?>
                        </div>
                        <p clas="price"><?php echo $DataShowRecentTransactions['type']; ?></p>
                    </div>
                </a>
                <!-- item -->
                <?php } ?>
            </div>
        </div>
        <!-- * Transactions -->

        <?php if (mysqli_num_rows($QueryShowRecentTransactions) == 0) { ?>
        <!-- Stats -->
        <div class="section mt-2 mb-3">
            <div class="card">
                <p class="text-center mb-3 mt-3">
                    No Available Transactions Today!
                </p>
            </div>
        </div>
        <?php } ?>

        <!-- app footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © CR Billing System 2024. <br />All Rights Reserved.
            </div>
            www.crbillingsystem.com
        </div>
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->

    <!-- Apex Charts -->
    <script src="<?php echo $baseurl; ?>public/assets/js/plugins/apexcharts/apexcharts.min.js"></script>

    <script>
        // Ambil data dari PHP
        var orderDates = <?php echo json_encode($dates); ?>;
        var orderCounts = <?php echo json_encode($order_counts); ?>;

        // Chart Line
        var optionChartLine = {
            series: [{
                name: 'Total Orders',
                data: orderCounts
            }],
            chart: {
                type: 'area',
                width: '100%',
                height: 150,
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
            },
            colors: ['#6236FF'],
            labels: orderDates,
        };
        var chartLine = new ApexCharts(document.querySelector("#chart-line"), optionChartLine);
        chartLine.render();
    </script>

<?php include "includes/footer-dashboard.php"; ?>